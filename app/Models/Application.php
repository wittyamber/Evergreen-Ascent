<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_posting_id',
        'resume_path',
        'cover_letter',
        'status',
    ];

    /**
     * Get the user (applicant) that owns the application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job posting that the application is for.
     */
    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    /**
     * Get the interviews for the application.
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    /**
     * Get the notes for the application.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(ApplicationNote::class); // Simplified this for you
    }
    
    /**
     * Get the messages for the application.
     */
    public function messages(): HasMany 
    {
        return $this->hasMany(ApplicationMessage::class);
    }
}