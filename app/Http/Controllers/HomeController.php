<?php

namespace App\Http\Controllers;

use App\Models\Country;

class HomeController extends Controller
{
    public function index() {
        $countries = Country::orderBy('name')->get();
        return view('home', [
            'countries' => $countries,
        ]);
    }
}
