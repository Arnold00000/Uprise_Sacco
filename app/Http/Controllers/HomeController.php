<?php

/*
namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 /*   public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
  /*  public function index()
    {
        return view('dashboard');
    }
}
*/

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Assuming $pageSlug represents the current page's slug or identifier
        $pageSlug = 'dashboard';

        // Other data or logic for the dashboard page can be included here

        return view('dashboard', compact('pageSlug'));
    }
}
