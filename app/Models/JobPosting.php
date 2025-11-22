<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Import this
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'location',
        'type',
        'description',
        'status', // We might want to update this later, so it's good to have it here
    ];


    /**
     * Get the user (HR) that created the job posting.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the applications for the job posting.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}