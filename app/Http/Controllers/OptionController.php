<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
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
        // Validate the form inputs
        $validatedData = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'correct' => 'required|string|max:255',
            'wrong_one' => 'required|string|max:255',
            'wrong_two' => 'required|string|max:255',
            'wrong_three' => 'required|string|max:255',
        ]);

        // Create options using the validated data
        Option::create([
            'question_id' => $validatedData['question_id'],
            'option_text' => $validatedData['correct'],
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $validatedData['question_id'],
            'option_text' => $validatedData['wrong_one'],
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $validatedData['question_id'],
            'option_text' => $validatedData['wrong_two'],
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $validatedData['question_id'],
            'option_text' => $validatedData['wrong_three'],
            'is_correct' => false,
        ]);

        $question = $request->input('question_id');

        // Redirect or perform any other actions after saving the options

        return redirect()->route('question.show', compact('question'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }
}
