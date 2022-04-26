<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function get(User $user)
    {
        return view('users.details')->with('user', $user);
    }

    public function getAll()
    {
        $users = User::paginate(2);
        return view('users.list')->with('users', $users);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:users,email',
            'password' => 'required|max:50',
            'balance' => 'required|gte:0|numeric|digits_between:1,20',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password'));
        if($request->balance != null){
            $user->balance = $request->balance;
        }
        else{
            $user->balance = 0.0;
        }
        if($request->img_url != null){
            $user->img_url = $request->img_url;
        }
        else{
            $user->img_url = 'default.jpg';
        }
        $user->save();
        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:users,id'
        ]);
        $collection = User::find($request->iddelete);
        $collection->delete();
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required|exists:users,id',
        ]);

        $newUser = User::find($request->id_update);
        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'max:50'
            ]);
            $newUser->name = $request->name_update;
        }
        if ($request->filled('password_update')) {
            $request->validate(['password_update' => 'max:50']);
            $newUser->password = $request->password_update;
        }
        if ($request->filled('email_update')) {
            $request->validate(['email_update' => 'email|unique:users,email|max:50']);
            $newUser->email = $request->email_update;
        }
        if ($request->filled('img_url_update')) {
            $request->validate(['img_url_update' => 'max:50']);
            $newUser->img_url = $request->img_url_update;
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric|gte:0'
            ]);
            $newUser->balance = $request->balance_update;
        }
        $newUser->save();
        return back();
    }

    public function sortByBalance(Request $request)
    {
        if ($request->sortByBalance == 0) {
            $users = User::orderBy('balance', 'ASC')->paginate(2);
        } elseif ($request->sortByBalance == 1) {
            $users = User::orderBy('balance', 'DESC')->paginate(2);
        } else {
            $users = User::paginate(2);
        }

        return view('users.list')->with('users', $users);
    }

    public function sortByName(Request $request)
    {
        if ($request->sortByName == 0) {
            $users = User::orderBy('name', 'ASC')->paginate(2);
        } elseif ($request->sortByName == 1) {
            $users = User::orderBy('name', 'DESC')->paginate(2);
        } else {
            $users = User::paginate(2);
        }

        return view('users.list')->with('users', $users);
    }
}
