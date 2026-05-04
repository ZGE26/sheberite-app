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
use Illuminate\Validation\Rule;

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
            'phone' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'city' => ['required_unless:role,unit_bisnis', 'string', 'max:255', 'nullable'],
            'district' => ['required_unless:role,unit_bisnis', 'string', 'max:255', 'nullable'],
            'postal_code' => ['required_unless:role,unit_bisnis', 'string', 'max:10', 'nullable'],
            'full_address' => ['required_unless:role,unit_bisnis', 'string', 'nullable'],


            'community_name' => ['required_if:role,komunitas', 'string', 'max:255', 'nullable'],
            'bio_community' => ['nullable', 'string'],

            'business_name' => ['required_if:role,unit_bisnis', 'string', 'max:255', 'nullable'],
            'category' => ['required_if:role,unit_bisnis', 'string', 'nullable'],
            'nib_file' => ['required_if:role,unit_bisnis', 'file', 'mimes:pdf', 'max:5120', 'nullable'],
        ]);

        $user = DB::transaction(function () use ($request) {

            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            if ($request->role !== 'unit_bisnis') {
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
            }

            // Simpan Detail Komunitas
            if ($request->role === 'komunitas') {
                $newUser->communityDetails()->create([
                    'community_name' => $request->community_name,
                    'bio_community' => $request->bio_community,
                ]);
            } elseif ($request->role === 'unit_bisnis') {
                $filePath = null;

                if ($request->hasFile('nib_file')) {
                    $filePath = $request->file('nib_file')->store('documents/nib', 'public');
                }

                $newUser->businessDetail()->create([
                    'business_name' => $request->business_name,
                    'category' => $request->category,
                    'nib_file' => $filePath,
                    'is_activate' => false,
                ]);
            }

            return $newUser;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
