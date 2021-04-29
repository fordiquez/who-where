<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use App\Models\Player;
use App\Models\Season;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request) {
        $season = $request->season_id;
        $window = $request->transfer_window;
        $loan = $request->loan;
        if ($season && $window && $loan) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['transfer_window', $window],
                ['loan', $loan]
            ])->get();
        } elseif ($season && $window) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['transfer_window', $window]
            ])->get();
        } elseif ($season && $loan) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['loan', $loan]
            ])->get();
        } elseif ($window && $loan) {
            $transfers = Transfer::where([
                ['transfer_window', $window],
                ['loan', $loan]
            ])->get();
        } elseif ($season) {
            $transfers = Transfer::where('season_id', $season)->get();
        } elseif ($window) {
            $transfers = Transfer::where('transfer_window', $window)->get();
        } elseif ($loan) {
            $transfers = Transfer::where('loan', $loan)->get();
        }
        else {
            $transfers = Transfer::all();
        }
        $countries = Country::all();
        $players = Player::all();
        $seasons = Season::all();
        $clubs = Club::all();
        return view('home', [
            'countries' => $countries,
            'players' => $players,
            'transfers' => $transfers,
            'seasons' => $seasons,
            'clubs' => $clubs,
            'playersAge' => $this->playersAge()
        ]);
    }

    public function players(Request $request) {
        dump($request->country);
        $country = $request->country;
        $club = $request->club;
        dump($request->club);
        if ($request->club && $request->country) {
            $players = Player::where([
                ['citizenship_country_id', '=', $country],
                ['current_club_id', '=', $club],
            ])->get();
        } elseif ($request->country) {
            $players = Player::where('citizenship_country_id', $country)->get();
        } elseif ($request->club) {
            $players = Player::where('current_club_id', $club)->get();
        } else {
            $players = Player::all();
        }
        dump($players);
        return view('players.index', [
            'players' => $players,
        ]);
    }

    public function playersAge(): array
    {
        return DB::select('select id, dbo.getPlayersAge(birth_date) age from players');
    }
}
