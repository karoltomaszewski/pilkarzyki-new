<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlayersController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('PlayerList', [
            'players' => Player::all()
        ]);
    }
}
