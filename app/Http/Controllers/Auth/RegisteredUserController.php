<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'in:individu,komunitas,unit_bisnis'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:10'],
            'full_address' => ['required', 'string'],
        ]);

        $user = DB::transaction(function () use ($request) {

            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $newUser->addresses()->create([
                'label' => 'Alamat Utama',
                'receiver_name' => $newUser->name,
                'phone_number' => $newUser->phone,
                'city' => $request->city,
                'district' => $request->district,
                'postal_code' => $request->postal_code,
                'full_address' => $request->full_address,
                'is_default' => true,
            ]);

            // if ($request->role === 'individu') {
            //     $newUser->individu()->create([]);
            // } elseif ($request->role === 'komunitas') {
            //     $newUser->komunitas()->create([]);
            // } elseif ($request->role === 'unit_bisnis') {
            //     $newUser->unitBisnis()->create([]);
            // }

            return $newUser;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
