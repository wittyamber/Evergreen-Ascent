<?php

namespace App\Traits;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        // Trigger before update
        static::updating(function ($model) {
            if (Auth::check()) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'UPDATE',
                    'module' => class_basename($model),
                    'target_id' => $model->id,
                    'changes' => json_encode([
                        'old' => $model->getOriginal(),
                        'new' => $model->getDirty(),
                    ]),
                    'ip_address' => request()->ip(),
                ]);
            }
        });

        // Trigger after creation
        static::created(function ($model) {
            if (Auth::check()) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'CREATE',
                    'module' => class_basename($model),
                    'target_id' => $model->id,
                    'changes' => json_encode($model->getAttributes()),
                    'ip_address' => request()->ip(),
                ]);
            }
        });
        
        // Add deleted() method similarly...
    }
}