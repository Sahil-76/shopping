<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RecoverPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class AuthuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function forgot()
    {
        return view('guests.auth.forgot');
    }

    public function forgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'token' => $token,
                    'created_at' => now(),
                ]
            );

            $data = [
                'user' => $user,
                'token' => $token,
            ];
            Mail::to($request->email)->send(new RecoverPassword($data));

            return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
        } else {
            return redirect()->back()->with('fail', 'User Not found');
        }
    }

    public function resetpassword(Request $request, $token)
    {
        $email = $request->query('email');

        return view('guests.auth.changepassword', compact('token', 'email'));
    }

    public function passwordreset(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $email = $request->email;
        $token = $request->token;
        $user = User::where('email', $email)->first();
        // dd($user);
        if ($user) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return redirect()->route('login')->with('success', 'Password reset successfully');
        }

        return redirect()->back()->with('fail', 'User Not found');

    }

    public function logins()
    {
        return view('guests.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please Enter Email',
            'password.required' => 'Please Enter Password',
        ]);

        // Prepare the credentials array
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Attempt to login
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role_id == '1') {
                $data['products'] = Product::get()->count();


                // dd($data);
                return redirect()->route('admin.dashboard', $data);
            } else {
                return redirect()->route('users.dashboard');
            }
        } else {
            return redirect()->back()->with('fail', 'User Not Found');

        }
    }

    public function registers()
    {
        return view('guests.auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.min' => 'Password Length is 8 ',
        ]);
        $role_id = '2';
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role_id,
        ]);
        Log::info('New user registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function admindashboard()
    {
        $data['totalProducts'] = Product::get()->count();
        $data['totalUsers'] = User::where('role_id', '=', '2')->count();
        $data['inactiveproducts'] = Product::where('products_status','=','inactive')->count();
        $data['activeproducts'] = Product::where('products_status','=','active')->count();
        // dd($data);
        return view('admin.dashboard', $data);
    }

    public function dashboard()
    {
        $data['products'] = Product::get();

        return view('users.dashboar', $data);
    }

    public function profile($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::with('address')->findorFail($id);

        return view('users.profile', compact('user'));
    }

    public function editprofile($id)
    {
        // dd($id);
        $id = Crypt::decrypt($id);
        $user = User::with('address')->findorFail($id);
        $states = State::get();

        return view('users.editprofile', compact('user', 'states'));
    }

    // update profile function
    public function updatepro(Request $request, $id)
    {
        // dd($id);
        $id = Crypt::decrypt($id);
        // dd($request->all());
        $user = User::findOrFail($id);

        $user->update(request()->validate([
            'name' => 'required|string|max:255',
            'role_id' => '2',
            'email' => 'required|email',
            'password',
        ]));

        return redirect()->route('profile', Crypt::encrypt($user->id))->with('success', 'Profile updated successfully!');
    }

    // update address
    public function updateadd(Request $request, $id)
    {
        $id = Crypt::decrypt($request->id);
        // dd($request->all());
        $data = UserAddress::where('user_id', $id)->first();
        if ($data) {
            $data->house_no = $request->house_no;
            $data->city = $request->city;
            $data->pin_code = $request->pin_code;
            $data->state = $request->state;
            $data->save();

            return redirect()->back()->with('success', 'Address Updated Successfully!');
        } else {
            UserAddress::create([
                'user_id' => auth()->user()->id,
                'house_no' => $request->house_no,
                'city' => $request->city,
                'pin_code' => $request->pin_code,
                'state' => $request->state,
            ]);

            return redirect()->back()->with('success', 'Address Added Successfully!');
        }

    }
}
