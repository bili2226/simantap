<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZakatController extends Controller
{
    /**
     * Display the Zakat Calculator page.
     */
    public function index()
    {
        return view('layouts.zakat');
    }
}
