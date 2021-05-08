<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\Player;
use App\Models\Season;
use App\Models\Transfer;
use App\Repositories\PlayerRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransferController extends Controller
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function index(Request $request) {
        $season = $request->input('season_id');
        $window = $request->input('transfer_window');
        $loan = $request->input('loan');
        $transfers = $this->filters($season, $window, $loan);
        $players = Player::orderBy('name')->get();
        $seasons = Season::orderByDesc('year')->get();
        $clubs = Club::orderBy('name')->get();
        return view('transfers.index', [
            'transfers' => $transfers,
            'players' => $players,
            'seasons' => $seasons,
            'clubs' => $clubs,
            'playersAge' => $this->playerRepository->playersAge()
        ]);
    }

    public function show($id) {
        $transfer = Transfer::find($id);
        return view('transfers.show', [
            'transfer' => $transfer,
        ]);
    }

    public function store(Request $request)
    {
        $player = Player::find($request->input('player_id'));
        if (!$player) {
            return back()->withMessage('Request data is invalid');
        }
        $request->validate([
            'player_id' => ['required', Rule::exists('players', 'id')],
            'season_id' => ['required', Rule::exists('seasons', 'id')],
            'transfer_date' => ['required', 'date'],
            'transfer_window' => ['required', 'prohibited_unless:transfer_window,Winter,Summer'],
            'contract_expires' => ['required', 'date', 'after:transfer_date'],
            'joined_club_id' => ['required', Rule::exists('clubs', 'id')->whereNot('id', $player->club_id)],
            'fee' => ['required', 'numeric', 'min:0.00'],
            'loan' => ['required', 'prohibited_unless:loan,0,1']
        ]);
        $transfer = new Transfer();
        $transfer->player_id = $request->input('player_id');
        $transfer->season_id = $request->input('season_id');
        $transfer->transfer_date = $request->input('transfer_date');
        $transfer->transfer_window = $request->input('transfer_window');
        $transfer->contract_expires = $request->input('contract_expires');
        $transfer->left_club_id = $player->club_id;
        $transfer->joined_club_id = $request->input('joined_club_id');
        $transfer->fee = $request->input('fee');
        $transfer->loan = $request->input('loan');
        $transfer->save();
        return back()->withMessage('Transfer was added successfully');
    }

    public function edit($id) {
        $transfer = Transfer::find($id);
        $seasons = Season::orderByDesc('year')->get();
        $clubs = Club::orderBy('name')->get();
        return view('transfers.edit', [
            'transfer' => $transfer,
            'seasons' => $seasons,
            'clubs' => $clubs
        ]);
    }

    public function update($id, Request $request)
    {
        $transfer = Transfer::find($id);
        $player = Player::find($transfer->player_id);
        $request->validate([
            'season_id' => ['required', Rule::exists('seasons', 'id')],
            'transfer_date' => ['required', 'date'],
            'transfer_window' => ['required', 'prohibited_unless:transfer_window,Winter,Summer'],
            'contract_expires' => ['required', 'date', 'after:transfer_date'],
            'joined_club_id' => ['required', Rule::exists('clubs', 'id')->whereNot('id', $player->club_id)],
            'fee' => ['required', 'numeric', 'min:0.00'],
            'loan' => ['required', 'prohibited_unless:loan,0,1']
        ]);
        $transfer = Transfer::find($id);
        $transfer->season_id = $request->input('season_id');
        $transfer->transfer_date = $request->input('transfer_date');
        $transfer->transfer_window = $request->input('transfer_window');
        $transfer->contract_expires = $request->input('contract_expires');
        $transfer->joined_club_id = $request->input('joined_club_id');
        $transfer->fee = $request->input('fee');
        $transfer->loan = $request->input('loan');
        $transfer->save();
        return back()->withMessage('Transfer was updated successfully');
    }

    public function delete($id): RedirectResponse
    {
        $transfer = Transfer::find($id);
        $transfer->delete();
        return back()->withMessage('Transfer was deleted successfully');
    }

    public function filters($season = null, $window = null, $loan = null) {
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
            ])->orderByDesc('season_id')->get();
        } elseif ($season) {
            $transfers = Transfer::where('season_id', $season)->get();
        } elseif ($window) {
            $transfers = Transfer::where('transfer_window', $window)->orderByDesc('season_id')->get();
        } elseif ($loan) {
            $transfers = Transfer::where('loan', $loan)->orderByDesc('season_id')->get();
        }
        else {
            $transfers = Transfer::orderByDesc('season_id')->get();
        }
        return $transfers;
    }
}
