<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'description',
        'reference_image_path',
        'submission_deadline',
        'voting_deadline',
        'is_active',
        'voting_notification_sent',
    ];

    protected $casts = [
        'submission_deadline' => 'datetime',
        'voting_deadline' => 'datetime',
        'voting_notification_sent' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function isSubmissionOpen()
    {
        return now()->lt($this->submission_deadline);
    }

    public function isVotingOpen()
    {
        return $this->voting_deadline && 
               now()->gte($this->submission_deadline) && 
               now()->lt($this->voting_deadline);
    }

    public function isClosed()
    {
        return $this->voting_deadline && now()->gte($this->voting_deadline);
    }
}
