<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(20);
        return view('admin.admins.index', compact('admins'));
    }

    public function create(){ return view('admin.admins.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return redirect()->route('admin.admins.index')->with('success','Administrador creado.');
    }

    public function edit(Admin $admin){ return view('admin.admins.edit', compact('admin')); }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>['required','email', Rule::unique('admins','email')->ignore($admin->id)],
            'password'=>'nullable|min:6|confirmed',
        ]);
        if(!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        else unset($data['password']);
        $admin->update($data);
        return back()->with('success','Administrador actualizado.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success','Administrador eliminado.');
    }
}
