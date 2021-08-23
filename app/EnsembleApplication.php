<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ensemble;
use App\User;

class EnsembleApplication extends Model
{
    protected $fillable = [
        'user_id', 'ensemble_id', 'instrument', 'recording_url', 'notes',
    ];

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
