<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $round
 * @property int $tournament_id
 * @property int $team1
 * @property int $points_team1
 * @property int $points_team2
 * @property int $team2
 * @property string $stage
 * @property float $elo_change
 * @property float $elo_change_2
 */
class Game extends Model
{
    use SoftDeletes;
}
