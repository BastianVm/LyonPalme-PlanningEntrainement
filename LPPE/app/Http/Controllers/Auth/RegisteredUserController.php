<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LPPE_Entraineurs;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
          // Découpe le nom pour remplir nom/prenom
         $parts = explode(' ', $request->name, 2);
        $prenom = $parts[0];
         $nom = $parts[1] ?? '';

        // Crée l'entraîneur
    $entraineur = LPPE_Entraineurs::create([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'identifiant' => $request->email,
        'mdp' => Hash::make($request->password),
        'rôle' => 'user',
    ]);

        // Crée l'utilisateur lié à l'entraîneur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_entraineur' => $entraineur->id_entraineur,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
