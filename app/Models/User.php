<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function nfts()
    {
        return $this->hasMany(Nft::class);
    }

    public function bids()
    {
        return $this->belongsToMany(Nft::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAll()
    {
        return User::paginate(5);
    }

    public static function createUser($name, $email, $password, $balance)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make($password), //TODO: review
            'balance' => $balance
        ]);
    }

    public static function updateAfterCreate($user, $request)
    {
        //if($request->balance){
        //TODO: poner un if porque si no meto valores peta
        $user->balance = $request->balance;


        $user->img_url = $request->img_url;
        $user->save();
    }

    public static function deleteUser($user)
    {
        $user->delete();
    }


    public static function updateName($newUser, $request)
    {
        if (\Hash::check($request->current_password_name, $newUser->password)) {
            $newUser->name = $request->name_update_profile;
            session()->flash('msg', 'Name updated correctly!');
            $newUser->update();
        } else {
            session()->flash('errorMsg', 'Invalid password!');
        }
    }

    public static function updatePassword($newUser, $request)
    {
        if (\Hash::check($request->current_password_password, $newUser->password)) {
            $newUser->password = \Hash::make($request['password_update_profile']);
            $newUser->update();
            session()->flash('msg', 'Password updated correctly!');
        } else {
            session()->flash('errorMsg', 'Invalid current password!');
        }
    }


    public static function updateUser($newUser, $updates)
    {
        if ($updates['name_update']) {
            $newUser->name = $updates['name_update'];
        }
        if ($updates['password_update']) {
            $newUser->password = $updates['password_update'];
        }
        if ($updates['email_update']) {
            $newUser->email = $updates['email_update'];
        }
        if ($updates['img_url_update']) {
            $newUser->img_url = $updates['img_url_update'];
            session()->flash('msg', 'Image updated correctly!');
        }
        if ($updates['balance_update']) {
            $newUser->balance = $updates['balance_update'];
        }

        $newUser->update();
    }


    public static function sortingBy($field, $order)
    {
        if ($order == 0) {
            return User::orderBy($field, 'DESC')->paginate(5);
        } elseif ($order == 1) {
            return User::orderBy($field, 'ASC')->paginate(5);
        } else {
            return User::getAll();
        }
    }
}
