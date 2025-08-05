<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'voter_id',
        'submission_id',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
