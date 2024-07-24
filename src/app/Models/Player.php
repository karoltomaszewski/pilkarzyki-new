<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $elo
 */
class Player extends Model
{
    public $timestamps = false;
}
