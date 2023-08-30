<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        dd($request->all()); 
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Additional logic or actions after registration

        return redirect('/dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'string', Rule::in(['admin', 'regular'])],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    // Assign role based on user_type
    if ($data['user_type'] === 'admin') {
        $role = Role::where('name', 'admin')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }
    } else {
        $role = Role::where('name', 'regular')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }
    }

    // Validate the registration data
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'user_type' => ($data['user_type'] === 'admin') ? 'admin' : 'regular',
        'sacco_code' => ($data['user_type'] === 'admin') ? $data['sacco_code'] : null,
    ]);


        
        event(new Registered($user));

        // Log in the user after registration
        Auth::login($user);
    
        return $user;
    }
}
