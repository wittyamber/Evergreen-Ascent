<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hr_count' => \App\Models\User::where('role', 'hr')->count(),
            'applicant_count' => \App\Models\User::where('role', 'applicant')->count(), // Assuming you have applicants
            'log_count' => AuditLog::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
    
    public function logs()
    {
        $logs = AuditLog::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(20);

        return view('admin.audit-logs', compact('logs')); 
    }
}