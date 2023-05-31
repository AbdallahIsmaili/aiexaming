<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\UserResponse;
use Illuminate\Http\Request;

class UserResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'selected_option_id' => 'required',
            'user_exam_id' => 'required',
            'question_id' => 'required',
            'exam_id' => 'required',
        ]);

        $user_exam_id = $validatedData['user_exam_id'];
        $question_id = $validatedData['question_id'];
        $exam_id = $validatedData['exam_id'];

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Check if the user has already passed the submitted question
        $userPassedQuestion = UserResponse::where('user_exam_id', $user_exam_id)
            ->where('question_id', $question_id)
            ->exists();

        if (!$userPassedQuestion) {
            // Create a new UserResponse instance and set its properties
            $userResponse = new UserResponse();
            $userResponse->user_exam_id = $user_exam_id;
            $userResponse->question_id = $question_id;
            $userResponse->selected_option_id = $validatedData['selected_option_id'];

            // Save the user response to the database
            $userResponse->save();
        }

        // Get the next non-passed question for the user
        $nextQuestion = Question::whereHas('exam', function ($query) use ($exam_id) {
                $query->where('id', $exam_id);
            })
            ->whereDoesntHave('userResponses', function ($query) use ($user_exam_id) {
                $query->where('user_exam_id', $user_exam_id);
            })
            ->where('id', '!=', $question_id)
            ->first();

        if ($nextQuestion) {
            // Redirect to the next non-passed question
            return redirect()->route('question.show', [$exam_id, $nextQuestion->id])->with('user_exam_id', $user_exam_id);
        } else {
            // Redirect to the result page as all questions have been passed
            return redirect()->route('result', $exam_id);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(UserResponse $userResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserResponse $userResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserResponse $userResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserResponse $userResponse)
    {
        //
    }
}
