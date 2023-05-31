<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        return view('admin.managements.index-exams', compact('exams', 'subjects'));
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
        // Validate the form data
        $validatedData = $request->validate([
            'exam_title' => 'required|string|max:255',
            'subject_name' => 'required|integer',
            'exam_desc' => 'required|string',
            'duration' => 'required|date_format:H:i',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after:starting_date',
            'difficulty_level' => 'required|string|in:easy,normal,hard,insane',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Create a new Exam instance and set its properties
        $exam = new Exam();
        $exam->title = $validatedData['exam_title'];
        $exam->subject_id = $validatedData['subject_name'];
        $exam->description = $validatedData['exam_desc'];
        $exam->duration = $validatedData['duration'];
        $exam->starting_date = $validatedData['starting_date'];
        $exam->ending_date = $validatedData['ending_date'];
        $exam->difficulty_level = $validatedData['difficulty_level'];

        // Associate the exam with the authenticated user
        $exam->user_id = $userId;

        // Save the exam to the database
        $exam->save();

        return redirect()->route('exam.index')->with('success', 'Cool the new exam ' . $exam->title . ' created successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = Question::all();
        $options = Question::all();

        return view('exams.exam', compact('exam', 'questions', 'options'))->with('started', 'You have started the exam!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $subjects = Subject::all();

        return view('admin.managements.edit-exam', compact('exam', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->title = $request->input('exam_title');
        $exam->subject_id = $request->input('subject_name');
        $exam->description = $request->input('exam_desc');
        $exam->duration = $request->input('duration');
        $exam->starting_date = $request->input('starting_date');
        $exam->ending_date = $request->input('ending_date');
        $exam->difficulty_level = $request->input('difficulty_level');
        $exam->save();

        return redirect()->route('exam.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('exam.index')->with('success', 'deleted successfully!');
    }

    /**
     * Create a question to that exam.
     */
    public function createQuestion($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = Question::all();
        return view('admin.managements.create-question', compact('exam', 'questions'));
    }


    public function testExam($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = Question::all();
        return view('admin.managements.test-exam', compact('exam', 'questions'));
    }

    public function startExam($id)
    {
        $exam = Exam::findOrFail($id);
        $randomQuestion = $exam->questions()->inRandomOrder()->first(); // Get the first random question for the exam

        $userExam = new UserExam();
        $userExam->user_id = auth()->id();
        $userExam->exam_id = $exam->id;
        $userExam->started_at = now();
        $userExam->save();

        $user_exam_id = $userExam->id;

        return redirect()->route('question.show', [$exam->id, $randomQuestion->id])->with('user_exam_id', $user_exam_id)->with('started', 'You have started the exam!');

    }



}
