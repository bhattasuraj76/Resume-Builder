<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->pageTitle = "Home";
    }

    public function index()
    {
        $pageTitle = $this->pageTitle;
        return view('frontend.pages.home', compact('pageTitle'));
    }
}
