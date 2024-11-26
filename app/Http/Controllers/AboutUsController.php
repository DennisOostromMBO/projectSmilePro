<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Toon de About Us-pagina.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('aboutus.index');
    }
}
