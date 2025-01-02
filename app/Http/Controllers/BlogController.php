<?php

namespace App\Http\Controllers;

use App\Mail\Newblog;
use App\Models\Blog;
use App\Models\Blogsubscriber;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['posts'] = Blog::all();

        return view('admin.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $data=Crypt::encrypt($request->all());
        $data = $request->validate(['title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required|in:draft,published']);

        if ($data) {
            $blog = new Blog;
            $blog->user_id=(auth()->user()->id);
            $blog->title = Crypt::encrypt($request->title);
            $blog->description = Crypt::encrypt($request->description);
            $blog->image = Crypt::encrypt($request->image);
            $blog->status =$request->status;
            // dd($blog);
            $blog->save();

            // code...
            $subscribers = Blogsubscriber::where('status', 'active')->get();
            foreach($subscribers as $subscriber){
                Mail::to($subscriber->email)->send(new Newblog($blog));

            }

            return redirect()->route('blogs.index')->with('success', 'Blog Saved!');
        } else {
            return redirect()->back()->with('fail', 'Blog Not Saved!');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id=Crypt::decrypt($id);
        $blog = Blog::with('users','comments')->findorFail($id);
        return view('admin.blog.show', compact('blog'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        // dd($id);
        $data['blog'] = Blog::findorFail($id);

        return view('admin.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blogId = Crypt::decrypt($id);

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|url',
            'status' => 'required|in:draft,published',
        ]);

        $blog = Blog::findOrFail($blogId);
        $blog->title = Crypt::encrypt($request->title);
        $blog->user_id=(auth()->user()->id);
        $blog->description = Crypt::encrypt($request->description);
        $blog->image = Crypt::encrypt($request->image);
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');


    }

    public function destroy($id){
        // $id=Crypt::decrypt($id);
        $blog = Blog::findorFail($id);
        $blog->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function users()
    {
        $publish=('published');
        $data['blogs']=Blog::where('status','=',$publish)->get();
        return view('users.blog.index',$data);
    }

    public function readblog($id){
        $id=Crypt::decrypt($id);
        // dd(session());
        // $urlHistory = url()->previous(2);
        // dd($urlHistory);

        $publish=('published');
        $data['blog'] = Blog::with('users','comments')->where('id', $id)->where('status', $publish)->firstOrFail();
        return view('users.blog.read',$data);
    }

    public function comment(Request $request){
        // dd($request->all());
        $request->validate([
            'comment'=>'required',
            'blog_id'=>'required',
            'name'=>'required',
            'email'=>'required|unique:comments,email'
        ],[
            'comment.required'=>'Please enter your comment',
            'blog_id.required'=>'Please select blog',
            'name.required'=>'Please enter your name',
            'email.required'=>'Please enter your email',
            'email.unique'=>'Email already exist'
        ]);
        $blog_id=$request->blog_id;
        $blog=Blog::findorFail($blog_id);
        if($blog){
            $comment=new Comments();
            $comment->comment=Crypt::encrypt($request->comment);
            $comment->blog_id=$blog_id;
            $comment->name=Crypt::encrypt($request->name);
            $comment->email=Crypt::encrypt($request->email);
            $comment->save();
            return redirect()->back()->with('success','Comment added successfully');
        }
        else{
            return redirect()->back()->with('fail','Blog not found');
        }


    }

    public function subscribe(Request $request){
        // dd($request->all());
        $request->validate([
            'gmail'=>'required|email|unique:subscribers',
            ],[
                'email.required'=>'Please enter your email',
                'email.email'=>'Please enter valid email',
                'email.unique'=>'Email already exists',
                ]);
                $email=$request->email;
                $subscriber=new Blogsubscriber();
                $subscriber->email=$email;
                $subscriber->status='active';
                $subscriber->save();
                return redirect()->back()->with('success','You have been subscribed successfully');

    }

    public function unsubscribe(Request $request)
    {
        // dd($request->all());
        // if ($request->isMethod('get')) {
        //     // Show the unsubscribe confirmation form
        //     return view('users.blog.unsubscribe');
        // }

        // if ($request->isMethod('post')) {
        //     // Handle the unsubscription logic (e.g., remove user from mailing list)
        //     $email = $request->input('email');

        //     dd($request->all());

        //     return redirect()->route('blog.index')->with('success', 'You have been successfully unsubscribed.');
        // }
        return "Function Works";
    }
}
