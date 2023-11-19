<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackRequest;
use App\Service\FeedbackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }
    public function store(CreateFeedbackRequest $request, FeedbackService $feedbackService): RedirectResponse
    {
        $data = $request->validated();
        $feedbackService->createFeedback($data);
        return back();
    }
}
