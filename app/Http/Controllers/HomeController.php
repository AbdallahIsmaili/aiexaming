<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::orderByDesc('created_at')->get();
        return view('index', compact('exams'));
    }


    public function getUsers()
    {
        $users = User::all();
        return view('admin.users.index-users', compact('users'));
    }

    public function getTeachers()
    {
        $users = User::all();
        return view('admin.users.index-teachers', compact('users'));
    }


    public function banUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->rank = 'banned';
        $user->save();

        $users = User::all();
        return redirect()->route('dashboard.users', ['users' => $users]);
        // return view('admin.users.index-users', compact('users'));
    }

    public function unbanUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->rank = 'user';
        $user->save();

        $users = User::all();
        return redirect()->route('dashboard.users', ['users' => $users]);
        // return view('admin.users.index-users', compact('users'));
    }

    public function riseUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->rank = 'teacher';
        $user->save();

        $users = User::all();
        return redirect()->route('dashboard.teachers', ['users' => $users]);
        // return view('admin.users.index-teachers', compact('users'));
    }

    public function downgradeTeacher($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->rank = 'user';
        $user->save();

        $users = User::all();
        return redirect()->route('dashboard.users', ['users' => $users]);
        // return view('admin.users.index-users')->with('users');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
