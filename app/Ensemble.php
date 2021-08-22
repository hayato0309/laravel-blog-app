<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Ensemble extends Model
{
    protected $fillable = [
        'user_id', 'headline', 'introduction', 'piece', 'composer', 'music_sheet',

        'violin', 'viola', 'cello', 'contrabass',
        'flute', 'oboe', 'clarinet', 'bassoon', 'saxophone',
        'trumpet', 'horn', 'trombone', 'tuba',
        'piano', 'harp', 'timpani', 'snare_drum', 'bass_drum', 'tambourine', 'triangle',

        'deadline', 'notes', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
