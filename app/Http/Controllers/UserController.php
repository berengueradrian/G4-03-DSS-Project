<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function get(User $user){
        return response()->json(['user' => $user]);
    }

    public function getAll(){
        $users = User::all();
        return response()->json(['user' => $users]);
    }

    public function create(Request $data){
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => password_hash($data->password, PASSWORD_BCRYPT) //TODO: añadir el BCRYPT este
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function delete(User $user){
        if(User::whereId($user->id)->count()){
            $user->delete();
            return response()->json(['success' => true, 'user' => $user]);
        }
        return response()->json(['success' => false]);
    }

    public function update(){
        //TODO:
    }

}
