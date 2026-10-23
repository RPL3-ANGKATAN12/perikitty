<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'address' => ['required', 'string', 'max:500'],
        ], [
            'phone.regex' => 'Nomor HP tidak valid. Contoh: 081234567890.',
        ]);

        $request->user()->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => 'Batam',
            'province' => 'Kepulauan Riau',
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}