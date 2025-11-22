<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemSettingsController extends Controller
{
    public function index()
    {
        // Fetch all settings and map them to a key-value array for the view
        $settings = SystemSetting::all()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // 1. Save Text Inputs (Site Name, etc.)
        $inputs = $request->except(['_token', 'site_logo']);
        foreach ($inputs as $key => $value) {
            SystemSetting::set($key, $value);
        }

        // 2. Handle Logo Upload (The Robust Way)
        if ($request->hasFile('site_logo')) {
            
            // Validate
            $request->validate([
                'site_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Delete old logo if it exists (Cleanup to save space)
            $oldLogo = SystemSetting::get('site_logo');
            if ($oldLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldLogo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldLogo);
            }

            // Upload New Logo
            // This saves to 'storage/app/public/branding'
            // And returns the path like: "branding/randomname.png"
            $path = $request->file('site_logo')->store('branding', 'public');

            // Save that clean path to DB
            SystemSetting::set('site_logo', $path);
        }

        return back()->with('success', 'System settings updated successfully.');
    }
}
