<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\ValidationException;

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

    const MAX_BALANCE = 1000000000;

    public static function getAll()
    {
        return User::paginate(5);
    }

    public static function createUser($name, $email, $password)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make($password)
        ]);
    }

    public static function updateAfterCreate($user, $request)
    {
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

    public static function updateAddBalance($newUser, $request)
    {

        $newBalance = $newUser->balance + $request->addBalance;
        if ($newBalance > self::MAX_BALANCE) {
            $newBalance = self::MAX_BALANCE;
            return throw ValidationException::withMessages([
                'addBalance' => 'Maximum balance overloaded. You can own a maximum of 1000M of ETH in your account.'
            ]);
        }
        $newUser->balance = $newBalance;
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
