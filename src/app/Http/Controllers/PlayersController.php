<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PlayerRequest;
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

    public function ranking(Request $request): Response
    {
        return Inertia::render('Ranking', [
            'players' => Player::query()->orderByDesc('elo')->get()
        ]);
    }

    public function show(Request $request, Player $player): Response
    {
        return Inertia::render('Player', [
            'id' => $player->id,
            'name' => $player->name,
            'elo' => $player->elo,
        ]);
    }

    public function store(PlayerRequest $request): JsonResponse
    {
        $player = new Player();
        $player->name = $request->name;
        $player->elo = 1000;
        $player->save();

        return new JsonResponse([
            'id' => $player->id,
            'name' => $player->name,
            'elo' => $player->elo,
        ], 201);
    }

    public function destroy(Player $player): JsonResponse
    {
        $player->delete();

        return new JsonResponse([], 204);
    }
}
