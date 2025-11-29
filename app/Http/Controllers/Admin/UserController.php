<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rutina;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rutina')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    public function show(User $usuario)
    {
        $usuario->load('rutina.dias.ejercicios.ejercicio');
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        $rutinas = Rutina::all();
        return view('admin.usuarios.edit', compact('usuario', 'rutinas'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'nivel_experiencia' => 'nullable|string|max:255',
            'rutina_id' => 'nullable|exists:rutinas,id',
        ]);

        $usuario->update($request->only('name', 'email', 'nivel_experiencia', 'rutina_id'));

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
