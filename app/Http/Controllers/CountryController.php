<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\League;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index() {
        $countries = Country::all();
        $leagues = League::all();
        return view('countries.index', [
            'countries' => $countries,
            'leagues' => $leagues
        ]);
    }

    public function show($id) {
        $country = Country::find($id);
        return view('countries.show', [
            'country' => $country
        ]);
    }

    public function store(Request $request) {
        dump($request);
        die;
        $photo = $request->file('photo');
//        dd($photo);
        $name = $photo->getClientOriginalName();
        dump($name);
//        dd($request->file('photo'));
        if ($photo->isValid()) {
            $extension = $photo->extension();
            $path = $request->photo->storeAs('', $name);
            echo $extension . '<br>';
            echo $path;
        }
    }
}
