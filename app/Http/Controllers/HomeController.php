<?php

namespace App\Http\Controllers;

use App\Models\Country;

class HomeController extends Controller
{
    public function index() {
        $countries = Country::all();
        return view('home', [
            'countries' => $countries,
        ]);
    }
}
