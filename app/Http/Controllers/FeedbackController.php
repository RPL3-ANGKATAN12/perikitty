<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $feedbacks = Feedback::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'message.required' => 'Isi saran wajib diisi.',
        ]);

        Feedback::create([
            'user_id' => $request->user()->id,
            'name' => $validated['name'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Terima kasih, saranmu sudah terkirim.');
    }
}