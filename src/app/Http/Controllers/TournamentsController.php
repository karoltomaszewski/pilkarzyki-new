<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TournamentsController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Tournaments', [
            'tournaments' => Tournament::all()
        ]);
    }
    public function newTournament(Request $request): Response
    {
        return Inertia::render('NewTournament', [
            'players' => Player::all()
        ]);
    }
}
