<?php

// app/Http/Controllers/PasswordResetController.php
// app/Http/Controllers/PasswordResetController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Elimina cualquier token existente para este correo electrónico
        DB::table('password_resets')->where('email', $request->email)->delete();

        $email = $request->email;

            $existe = DB::table('users')
                ->where('email', $email)
                ->exists();

            if ($existe === true) {

            } else {
                return redirect()->back()->withErrors(['Error' => 'El correo no está registrado']);
            }


        // Genera un nuevo token y lo inserta en la base de datos
        $token = Str::random(6);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        // // Envía el correo electrónico con el token
        // Mail::raw("Su Código de Restablecimiento es: $token. Copialo y úsalo en el formulario de restablecimiento de contraseña para recuperar el acceso a tu cuenta. ¡Te deseamos un feliz regreso a tu cuenta!" , function ($message) use ($request) {
        //     $message->to($request->email)
        //         ->subject('Restablecer su Contraseña');

        //     });

        Mail::send([], [], function ($message) use ($email, $token) {
        $message->to($email)
            ->subject('Código de Restablecimiento de Contraseña')
            ->html("
                <div style='font-family: Arial, sans-serif; padding: 20px; color: #333;'>
                    <h2>Restablecimiento de Contraseña</h2>
                    <p>Su código de restablecimiento es: <strong style='font-size: 20px; color: #0d6efd;'>{$token}</strong></p>
                    <p>Copie este código y úselo en el formulario para recuperar el acceso a su cuenta.</p>
                </div>
            ");
        });

        // return back()->with('message', '¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!');
        $email =  $request->email;
        return view('auth.reset-password-confirm', compact('email', 'token'))->with('message', '¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!');
    }


    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'token' => 'required|size:6',
    //         'password' => 'required|min:4|confirmed',
    //     ]);

    //     $email = DB::table('password_resets')
    //         ->where('token', $request->token)
    //         ->value('email');

    //     if (!$email || $email != $request->email) {
    //         return back()->withErrors(['email' => 'Este token no es válido.']);
    //     }

    //     DB::table('users')
    //         ->where('email', $email)
    //         ->update(['password' => bcrypt($request->password)]);

    //     DB::table('password_resets')->where('email', $email)->delete();

    //     return redirect('/')->with('message', '¡Tu contraseña ha sido restablecida Exitosamente!');
    // }

    public function reset(Request $request)
    {
        // 1. Validar la entrada del formulario
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|size:6',
            'password' => 'required|min:4|confirmed',
        ]);

        // 2. Verificar si el token y el correo existen en la tabla password_resets
        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'El código o el correo electrónico no son válidos.']);
        }

        // 3. Actualizar la contraseña del usuario en la tabla users
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        // 4. Eliminar el token usado para que no se pueda reutilizar
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        // 5. Redirigir al login con mensaje de éxito
        return redirect()->route('login')->with('message', '¡Su contraseña ha sido restablecida exitosamente!');
    }
}
