<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
 public function index()
    {
        $users = DB::table('users')->get();
        return view('users', compact('users'));
    }

    public function create(Request $request)
    {
            $validated = $request->validate([
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => FacadesHash::make($request->password)
        ]);

        return redirect('/users');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return redirect('/users');
    }

    public function edit($id)
    {
        $user = User::find($id);

        $users = User::all();

        return view('users', compact('users', 'user'));
    }

    public function update(Request $request)
    {
            $validated = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email'
    ]);
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != null){
            $user->password = FacadesHash::make($request->password);
        }

        $user->save();

        return redirect('/users');
    }
}
