<?php

namespace App\Http\Controllers;

use App\Models\Club;
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
        $is_loan = $request->input('is_loan');
        $transfers = $this->filters($season, $window, $is_loan);
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
        $request->validate([
            'player_id' => ['required', Rule::exists('players', 'id')],
            'season_id' => ['required', Rule::exists('seasons', 'id'),
                Rule::unique('transfers', 'season_id')
                    ->where('player_id', $request->input('player_id'))],
            'transfer_date' => ['required', 'date'],
            'transfer_window' => ['required', 'prohibited_unless:transfer_window,Winter,Summer'],
            'contract_expires' => ['required', 'date', 'after:transfer_date'],
            'left_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:joined_club_id,' . $request->input('left_club_id')],
            'joined_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:left_club_id,' . $request->input('joined_club_id')],
            'fee' => ['required', 'numeric', 'min:0.00'],
            'is_loan' => ['required', 'prohibited_unless:is_loan,0,1']
        ]);
        $transfer = new Transfer();
        $transfer->player_id = $request->input('player_id');
        $transfer->season_id = $request->input('season_id');
        $transfer->transfer_date = $request->input('transfer_date');
        $transfer->transfer_window = $request->input('transfer_window');
        $transfer->contract_expires = $request->input('contract_expires');
        $transfer->left_club_id = $request->input('left_club_id');
        $transfer->joined_club_id = $request->input('joined_club_id');
        $transfer->fee = $request->input('fee');
        $transfer->is_loan = $request->input('is_loan');
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
        $request->validate([
            'season_id' => ['required', Rule::exists('seasons', 'id'), Rule::unique('transfers')
                    ->where('season_id', $request->input('season_id'))
                    ->where('player_id', $transfer->player_id)->ignore($transfer->id)
            ],
            'transfer_date' => ['required', 'date'],
            'transfer_window' => ['required', 'prohibited_unless:transfer_window,Winter,Summer'],
            'contract_expires' => ['required', 'date', 'after:transfer_date'],
            'left_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:joined_club_id,' . $request->input('left_club_id')
            ],
            'joined_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:left_club_id,' . $request->input('joined_club_id')
            ],
            'fee' => ['required', 'numeric', 'min:0.00'],
            'is_loan' => ['required', 'prohibited_unless:is_loan,0,1']
        ]);
        $transfer = Transfer::find($id);
        $transfer->season_id = $request->input('season_id');
        $transfer->transfer_date = $request->input('transfer_date');
        $transfer->transfer_window = $request->input('transfer_window');
        $transfer->contract_expires = $request->input('contract_expires');
        $transfer->left_club_id = $request->input('left_club_id');
        $transfer->joined_club_id = $request->input('joined_club_id');
        $transfer->fee = $request->input('fee');
        $transfer->is_loan = $request->input('is_loan');
        $transfer->save();
        return back()->withMessage('Transfer was updated successfully');
    }

    public function delete($id): RedirectResponse
    {
        $transfer = Transfer::find($id);
        $transfer->delete();
        return back()->withMessage('Transfer was deleted successfully');
    }

    public function filters($season = null, $window = null, $is_loan = null) {
        if ($season && $window && $is_loan) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['transfer_window', $window],
                ['is_loan', $is_loan]
            ])->get();
        } elseif ($season && $window) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['transfer_window', $window]
            ])->get();
        } elseif ($season && $is_loan) {
            $transfers = Transfer::where([
                ['season_id', $season],
                ['is_loan', $is_loan]
            ])->get();
        } elseif ($window && $is_loan) {
            $transfers = Transfer::where([
                ['transfer_window', $window],
                ['is_loan', $is_loan]
            ])->orderByDesc('season_id')->get();
        } elseif ($season) {
            $transfers = Transfer::where('season_id', $season)->get();
        } elseif ($window) {
            $transfers = Transfer::where('transfer_window', $window)->orderByDesc('season_id')->get();
        } elseif ($is_loan) {
            $transfers = Transfer::where('is_loan', $is_loan)->orderByDesc('season_id')->get();
        }
        else {
            $transfers = Transfer::orderByDesc('season_id')->get();
        }
        return $transfers;
    }
}
