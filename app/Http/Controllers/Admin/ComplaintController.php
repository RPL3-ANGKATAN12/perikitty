<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(): View
    {
        $complaints = Complaint::query()
            ->with('user')
            ->latest()
            ->get();

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load('user');

        return view('admin.complaints.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'admin_reply' => ['required', 'string', 'max:1000'],
        ], [
            'admin_reply.required' => 'Balasan wajib diisi.',
        ]);

        $complaint->update([
            'admin_reply' => $validated['admin_reply'],
            'replied_at' => now(),
            'status' => 'replied',
        ]);

        return redirect()
            ->route('admin.complaints.show', $complaint)
            ->with('success', 'Balasan berhasil dikirim.');
    }
}