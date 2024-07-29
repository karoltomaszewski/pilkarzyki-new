<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $player1_id
 * @property int $player2_id
 */
class Team extends Model
{
    use SoftDeletes;
}
