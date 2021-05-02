<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index($countryId = null) {
        if ($countryId) {
            $leagues = League::where('country_id', $countryId)->get();
        } else {
            $leagues = League::all();
        }
        $countries = Country::all();
        return view('leagues.index', [
            'leagues' => $leagues,
            'countries' => $countries
        ]);
    }

    public function show($id) {
        $league = League::find($id);
        $clubs = Club::where('league_id', $id)->get();
        return view('leagues.show', [
            'league' => $league,
            'clubs' => $clubs
        ]);
    }

    public function edit($id) {
        $league = League::find($id);
        $countries = Country::all();
        return view('leagues.edit', [
            'league' => $league,
            'countries' => $countries
        ]);
    }

    public function update($id, Request $request) {

    }
}
