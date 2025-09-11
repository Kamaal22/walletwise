<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        // default color palette
        $colors = [
            '#0EA5A4', '#2563EB', '#7C3AED', '#FB923C', '#F97316',
            '#EF4444', '#10B981', '#06B6D4', '#F43F5E', '#8B5CF6'
        ];

        return view('settings.edit', compact('user', 'colors'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'preferences.primary_color' => 'nullable|string',
            'preferences.dark_mode' => 'nullable|boolean',
            'preferences.language' => 'nullable|string',
            'preferences.export' => 'nullable|array',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $prefs = $user->preferences ?? [];
        $prefs = array_merge($prefs, $request->input('preferences', []));
        $user->preferences = $prefs;
        $user->save();

        return redirect()->route('settings.edit')->with('success', 'Settings updated.');
    }
}
