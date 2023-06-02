<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Option;
use App\Models\UserExam;
use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($user_exam_id)
    {
        $user = Auth::user();
        $userExam = UserExam::findOrFail($user_exam_id);
        $exam = Exam::findOrFail($userExam->exam_id);
        $userID = $userExam->user_id;

        $userResponses = UserResponse::where('user_exam_id', $user_exam_id)->get();

        $correctAnswers = 0;
        foreach ($userResponses as $response) {
            if ($response->selected_option_id) {
                $option = Option::findOrFail($response->selected_option_id);
                if ($option->is_correct) {
                    $correctAnswers++;
                }
            }
        }

        $score = ($correctAnswers / count($userResponses)) * 100;

        $userExam->score = $score;
        $userExam->submitted_at = now();
        $userExam->save();

        return view('exams.result', compact('exam', 'score', 'userID'));
    }


    public function usersExams()
    {
        // $usersExams = UserExam::whereNotNull('score')
        //     ->whereNotNull('submitted_at')
        //     ->paginate(10);

        $usersExams = UserExam::whereNotNull('score')
            ->whereNotNull('submitted_at')
            ->paginate(10);

        return view('admin.users.notes', compact('usersExams'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserExam $userExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserExam $userExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserExam $userExam)
    {
        //
    }
}
