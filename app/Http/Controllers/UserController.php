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
        $users = User::getAll();
        return view('users.list')->with('users', $users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:users,email',
            'password' => 'required|max:50',
        ]);

        $user = User::createUser($request->name, $request->email, $request->password);

        if ($request->balance != null) {
            $request->validate(['balance' => 'numeric|gte:0|digits_between:1,20']);
        } else {
            $request->balance = 0.0;
        }
        if ($request->img_url != null) {
            $request->validate([
                'img_url' => 'max:50',
            ]);
        } else {
            $request->img_url = 'default.jpg';
        }

        User::updateAfterCreate($user, $request);

        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:users,id'
        ]);
        $user = User::find($request->iddelete);

        /*
        If we delete in ADMIN view we must be in user.list. Otherwise it means is the same user the one auto-deleting his account, 
        due to this reason; if it's not the admin it musy go to home page!!!
        */
        if (\Auth::user()->is_admin) {
            User::deleteUser($user);
            return back();
        } else {
            User::deleteUser($user);
            return redirect('login');
        }
    }

    public function updateProfileName(Request $request)
    {
        $request->validate([
            'id_update' => 'required|exists:users,id',
        ]);
        $newUser = User::find($request->id_update);
        // User NAME PROFILE SETTINGS
        $request->validate([
            'name_update_profile' => 'required|max:50',
            'passwordName' => 'required',
            'current_password_name' => 'required|same:passwordName',
        ]);

        User::updateName($newUser, $request);

        return back();
    }

    public function updateProfilePassword(Request $request)
    {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newUser = User::find($request->id_update);
        $request->validate([
            'password_update_profile' => 'required|max:50',
            'password_password' => 'required',
            'current_password_password' => 'required|same:password_password',
        ]);

        User::updatePassword($newUser, $request);

        return back();
    }

    public function update(Request $request)
    {
        $updates = ['name_update' => false, 'password_update' => false, 'email_update' => false, 'img_url_update' => false, 'balance_update' => false];

        $request->validate([
            'id_update' => 'required'
        ]);

        $newUser = User::find($request->id_update);

        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'max:50',
            ]);
            $updates['name_update'] = $request->name_update;
        }
        if ($request->filled('password_update')) {
            $request->validate(['password_update' => 'max:50']);
            $updates['password_update'] = \Hash::make($request->password_update);
        }
        if ($request->filled('email_update')) {
            $request->validate(['email_update' => 'email|unique:users,email|max:50']);
            $updates['email_update'] = $request->email_update;
        }
        if ($request->filled('img_url_update')) {
            $request->validate(['img_url_update' => 'max:50']);
            $updates['img_url_update'] = $request->img_url_update;
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric|gte:0'
            ]);
            $updates['balance_update'] = $request->balance_update;
        }
        User::updateUser($newUser, $updates);
        return back();
    }

    public function addBalance(Request $request)
    {
        $request->validate([
            'addBalance' => 'required|numeric|gte:0|max:1000000000'
        ]);
        $user = User::find($request->userId);
        User::updateAddBalance($user, $request);
        return back();
    }

    public function sortByBalance(Request $request)
    {
        $users = User::sortingBy('balance', $request->sortByBalance);
        return view('users.list')->with('users', $users);
    }

    public function sortByName(Request $request)
    {
        $users = User::sortingBy('name', $request->sortByName);
        return view('users.list')->with('users', $users);
    }
}
