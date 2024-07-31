<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentTeam;
use Illuminate\Http\JsonResponse;
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

    public function store(TournamentRequest $request): JsonResponse
    {
        $tournament = new Tournament();
        $tournament->name = $request->tournamentName;
        $tournament->save();

        $players = $request->selectedPlayers;
        shuffle($players);

        $pairs = array_chunk($players, 2);

        foreach ($pairs as $pair) {
            $team = Team::query()
                ->where(function ($query) use ($pair) {
                    $query->where('player1_id', $pair[0])
                        ->where('player2_id', $pair[1]);
                })
                ->orWhere(function ($query) use ($pair) {
                    $query->where('player1_id', $pair[1])
                        ->where('player2_id', $pair[0]);
                });

            if (!($team instanceof Team)) {
                $team = new Team();
                $team->player1_id = $pair[0];
                $team->player2_id = $pair[1];
                $team->save();
            }

            $tournamentTeam = new TournamentTeam();
            $tournamentTeam->tournament_id = $tournament->id;
            $tournamentTeam->team_id = $team->id;
            $tournamentTeam->save();
        }

        return new JsonResponse($tournament->toArray());
    }

    public function show(Tournament $tournament): Response
    {
        $games = Game::query()
            ->with([
                'team1.player1' => function ($query) {
                    $query->select('id', 'name', 'elo');
                },
                'team1.player2' => function ($query) {
                    $query->select('id', 'name', 'elo');
                },
                'team2.player1' => function ($query) {
                    $query->select('id', 'name', 'elo');
                },
                'team2.player2' => function ($query) {
                    $query->select('id', 'name', 'elo');
                },
                'team1' => function ($query) {
                    $query->select('id', 'player1_id', 'player2_id');
                },
                'team2' => function ($query) {
                    $query->select('id', 'player1_id', 'player2_id');
                }
            ])
            ->where('tournament_id', $tournament->id)
            ->get();


        return Inertia::render('TournamentDetails', [
            'games' => $games

        ]);
    }
}
