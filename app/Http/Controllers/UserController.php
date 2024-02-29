<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Log in a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Intentar autenticar al usuario utilizando las credenciales proporcionadas
            if (Auth::attempt($request->only('email', 'password'))) {
                // Autenticación exitosa, obtener el usuario autenticado
                $user = Auth::user();

                // Generar token de acceso
                $token = $user->createToken('auth_token')->plainTextToken;
                unset($user['id'], $user['created_at'], $user['updated_at']);

                // Devolver el token y la información del usuario como respuesta
                return response()->json(['user' => $user, 'token' => $token], 200);
            } else {
                // Si las credenciales son inválidas, devolver un error de autenticación
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to log in: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|unique:users,phone',
                'address' => 'required|string|unique:users,address',
                'password' => 'required|string|min:8',
            ]);

            // Crear un nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to register user: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Edit user information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $request->user()->id,
                'phone' => 'required|string|unique:users,phone,' . $request->user()->id,
                'address' => 'required|string|unique:users,address,' . $request->user()->id,
            ]);

            // Actualizar la información del usuario
            $user = $request->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'User information updated successfully'], 200);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to update user information: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Forgot password functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // Generar un token de reinicio de contraseña
            $token = uniqid();

            // Actualizar el token de reinicio de contraseña en la base de datos
            User::where('email', $request->email)->update(['password_reset_token' => $token]);

            // Enviar un correo electrónico al usuario con el enlace para restablecer la contraseña

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Password reset token generated successfully'], 200);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to generate password reset token: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Change user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'password' => 'required|string|min:8',
            ]);

            // Actualizar la contraseña del usuario
            $user = $request->user();
            $user->password = Hash::make($request->password);
            $user->save();

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver una respuesta de error
            return response()->json(['error' => 'Failed to change password: ' . $e->getMessage()], 500);
        }
    }
}
