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

    public function store(Request $request)
    {

        //TODO: Si pongo en el update 99999999999999999 peta
        //TODO: Si pongo en el create 99999999999999999 peta
        //TODO: Si de input metes una string muy larga peta todo
        //TODO: Si repites email da : SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'masd@gmail.com' for key 'users.users_email_unique' (SQL: insert into `users` (`name`, `email`, `password`, `updated_at`, `created_at`) values (alcarmar, masd@gmail.com, 1, 2022-04-07 21:10:37, 2022-04-07 21:10:37))

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'balance' => 'required|numeric|gte:0',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'balance' => $request->balance,
            'img_url' => $request->img_url,
            'password' => $request->password
        ]);
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
            $newUser->name = $request->name_update;
        }
        if ($request->filled('password_update')) {
            $newUser->password = $request->password_update;
        }
        if ($request->filled('email_update')) {
            $request->validate([ 'email_update' => 'email|unique:users,email' ]);
            $newUser->email = $request->email_update;
        }
        if ($request->filled('img_url_update')) {
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
