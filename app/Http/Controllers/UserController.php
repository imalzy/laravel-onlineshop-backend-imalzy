<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Get all users;
    public function index(Request $request)
    {
        // Get all users;
        $users = DB::table('users')->when(
            $request->input('name'),
            function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')->orWhere('email', 'like', '%' . $name . '%');
            }
        )->select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->orderBy('id', 'desc')->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    public function show($id)
    {
        return view('pages.users.index');
    }


    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'User successfully created');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:ADMIN,USER,GUEST',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'User successfully updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted');
    }
}
