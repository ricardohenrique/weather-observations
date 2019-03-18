<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObservationModel extends Model
{
    protected $table = 'observations';

    protected $fillable = [
        'timestamp',
        'location',
        'temperature',
        'observatory'
    ];
}
