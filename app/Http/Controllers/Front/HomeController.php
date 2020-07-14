<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->pagePath = 'front.pages.';
        $this->pageTitle = "Home";
    }

    public function index()
    {
        $pageTitle = $this->pageTitle;
        return view($this->pagePath.'home', compact('pageTitle'));
    }
}
