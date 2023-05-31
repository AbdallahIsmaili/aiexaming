<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuestionController extends Controller
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
            'subject_name' => 'integer',
            'exam_title' => 'integer',
            'question_text' => 'required|string|max:255',
            'difficulty_level' => 'required|string|in:easy,normal,hard,insane',
            'attachment_url' => 'file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,wav,mp3|max:2048',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Create a new Question instance and set its properties
        $question = new Question();
        $question->subject_id = $validatedData['subject_name'];
        $question->exam_id = $validatedData['exam_title'];
        $question->question_text = $validatedData['question_text'];
        $question->difficulty_level = $validatedData['difficulty_level'];

        // Associate the question with the authenticated user
        $question->user_id = $userId;

        // Save the question to the database
        $question->save();

        // Handle file upload and storage
        if ($request->hasFile('attachment_url')) {
            $file = $request->file('attachment_url');
            $fileName = date('YmdHis') . '_' . Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/files', $fileName);
            $question->url = Storage::url($filePath);
            $question->save();
        }

        return redirect()->route('exam.question.create', $question->exam_id)->with('success', 'The new question "' . $question->question_text . '" was created successfully!');
    }


    /**
     * Display the specified resource.
     */

    public function show($exam_id, $question_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $question = Question::findOrFail($question_id);

        $options = Option::where('question_id', $question->id)->get();
        return view('questions.question', compact('question','options'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $question = Question::findOrFail($id);
        return view('admin.managements.edit-question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string|max:255',
            'difficulty_level' => 'required|string|in:easy,normal,hard,insane',
            'attachment_url' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,wav,mp3|max:2048',
        ]);

        $question = Question::findOrFail($id);
        $question->question_text = $validatedData['question_text'];
        $question->difficulty_level = $validatedData['difficulty_level'];

        // Handle file upload and storage
        if ($request->hasFile('attachment_url')) {
            $file = $request->file('attachment_url');
            $fileName = date('YmdHis') . '_' . Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/files', $fileName);
            $question->url = Storage::url($filePath);
        }

        $question->save();

        return redirect()->route('exam.question.create', $question->exam_id)->with('success', 'The question "' . $question->question_text . '" was updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('exam.question.create', $question->exam_id)->with('success', 'The question "' . $question->question_text . '" was deleted successfully!');
    }

    /**
     * Create an option to that exam.
     */
    public function createOption($id)
    {
        $question = Question::findOrFail($id);
        $options = Option::where('question_id', $question->id)->get();
        return view('admin.managements.create-option', compact('question', 'options'));
    }
}
