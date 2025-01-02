<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.aboutus.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index1()
    {
        return view('admin.aboutus.index1');

    }


}
