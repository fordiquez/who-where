<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\Player;
use App\Models\Position;
use App\Repositories\PlayerRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function index() {
        $countries = Country::orderBy('name')->paginate(10);
        return view('home', [
            'countries' => $countries,
        ]);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $players = Player::where('name', 'LIKE', "%$query%")->get();
        $countries = Country::all();
        $positions = Position::all();
        $clubs = Club::orderBy('name')->get();
        return view('players.index', [
            'players' => $players,
            'countries' => $countries,
            'positions' => $positions,
            'clubs' => $clubs,
            'playersAge' => $this->playerRepository->playersAge()
        ]);
    }
}
