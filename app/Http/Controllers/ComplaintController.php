<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $complaints = Complaint::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('complaints.index', compact('complaints'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ], [
            'subject.required' => 'Judul pengaduan wajib diisi.',
            'message.required' => 'Isi pengaduan wajib diisi.',
        ]);

        Complaint::create([
            'user_id' => $request->user()->id,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Pengaduanmu sudah terkirim. Kami akan segera membalas.');
    }
}