<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      
        'action',       
        'module',       
        'target_id',    
        'changes',      
        'ip_address'
    ];

    protected $casts = [
        'changes' => 'array', 
    ];
    
    // Relationship to the actor
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
