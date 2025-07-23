<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public $messages = [
        'rut.required' => 'El RUT es obligatorio.',
        'rut.unique' => 'Este RUT ya está registrado.',
        'rut.regex' => 'El RUT debe tener el formato 12.345.678-9.',
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Debe ingresar un correo válido.',
        'email.unique' => 'Este correo ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
    ];    

    public function showFormRegistro()
    {
        if (Auth::check()) {
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para crear una nueva.');
        }

        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];
        
        return view('backoffice/users/registro', $datos);
    }

    public function guardarNuevo(Request $request)
    {
        $request->validate([
            'rut' => ['required','string','max:12','unique:' . User::class,'regex:/^\d{1,2}\.\d{3}\.\d{3}-[\dkK]$/'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], $this->messages);        

        $user = User::create([
            'rut' => $request->rut,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'common',
        ]);

        // event(new Registered($user));

        return redirect()->route('/')->with('success', 'Usuario creado, debe iniciar sesión.');
    }

    public function showFormLogin()
    {
        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        if (Auth::check()) {
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para iniciar una nueva.');
        }

        return view('backoffice/users/login', $datos);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'rut' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return redirect()->route('user.perfil')->with('success', "Bienvenido {$user->name}, sesión iniciada exitosamente.");
        }

        return back()->withErrors([
            'rut' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('rut');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/')->with('success', 'Sesión cerrada exitosamente.');
    }
    public function verPerfil()
    {
        $usuario = Auth::user();

        $datos = [
            'usuario' => $usuario,
            'dev' => [
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'textos' => [
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC'
            ]
        ];

        return view('backoffice.users.perfil', $datos);
    }

    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
        ];

        // Si el usuario escribió nueva contraseña, añadimos reglas
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Password::min(8)];
        }

        $validated = $request->validate($rules, [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.unique' => 'Este correo ya está registrado por otro usuario.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);

        // Actualización condicional
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];

        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        return back()->with('success', 'Perfil actualizado exitosamente.');
    }
}
