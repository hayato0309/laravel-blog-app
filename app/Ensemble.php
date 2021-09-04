<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\EnsembleApplication;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Comment;

class Ensemble extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'headline', 'introduction', 'piece', 'composer', 'music_sheet',

        'violin', 'viola', 'cello', 'contrabass',
        'flute', 'oboe', 'clarinet', 'bassoon', 'saxophone',
        'trumpet', 'horn', 'trombone', 'tuba',
        'piano', 'harp', 'timpani', 'snare_drum', 'bass_drum', 'tambourine', 'triangle',

        'deadline', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function ensembleApplications()
    {
        return $this->hasMany(EnsembleApplication::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
