<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Auth;

class ArtistAuthController extends Controller
{
    public function showLoginForm() {
        if(Auth::guard('custom')->check()) {
            return redirect()->route('mainPage');
        }
        else{
            return view('artists.login');
        }
    }

    public function login(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required',
        ]);

        if(auth()->guard('custom')->attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            $user = auth()->user();

            return redirect()->intended(url('/'));
        } else {
            return redirect()->back()->withError('Credentials doesn\'t match.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('custom')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login/artists');
    }

    public function showRegistrationForm() {
        return view('artists.register');
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('custom');
    }

    public function registered(Request $request, $user){}

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:artists,name'],
            'password' => ['required', 'string', 'confirmed'], //TODO: , 'min:8' delete for testing easier
        ]);
    }

    protected function create(array $data)
    {
        return Artist::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'balance' => 0,
            'volume_sold' => 0,
        ]);
    }
}
