<?php

namespace App\Http\Controllers;

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
        dump($leagues);
        return view('leagues.index', [
            'leagues' => $leagues
        ]);
    }

    public function show($id) {
        $league = League::find($id);
        return view('leagues.show', [
            'league' => $league
        ]);
    }
}
