<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        $feedbacks = Feedback::query()
            ->with('user')
            ->latest()
            ->get();

        return view('admin.feedback.index', compact('feedbacks'));
    }
}