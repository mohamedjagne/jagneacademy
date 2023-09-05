<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;

class InstructorsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $instructors = User::latest()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->where('role_id', 4)
            ->get();

        return Inertia::render('Instructors/InstructorsView', [
            'instructors' => $instructors,
            'search' => $search
        ]);
    }

    public function storeForm()
    {
        return Inertia::render('Instructors/CreateInstructorView');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required',
        ]);

        $validatedData['role_id'] = 4;
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['name'] = ucwords($validatedData['name']);

        User::create($validatedData);

        return redirect()->route('instructors');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('instructors');
    }

    public function updateForm(User $user)
    {
        return Inertia::render('Instructors/UpdateInstructorView', [
            'instructor' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', 'unique:users,email, ' . $user->id],
            'password' => 'required',
        ]);

        $validatedData['role_id'] = 4;
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['name'] = ucwords($validatedData['name']);

        $user->update($validatedData);

        return redirect()->route('instructors');
    }
}
