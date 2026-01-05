<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
           return view('admin.users.create', [
            'areas' => User::all()
        ]);
    }

    public function store(Request $request)
    {
       $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'cpf'   => 'required', 
        'password' => [
            'required',
            Password::min(8)
                ->letters()      // Pelo menos uma letra
                ->mixedCase()    // Maiúsculas e minúsculas
                ->numbers()      // Pelo menos um número
                ->symbols(),     // Pelo menos um caractere especial (!, @, #, etc)
        ],
    ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
       $request->validate([
        'name' => 'required|string|max:255',
        // O segredo está aqui: unique:tabela,coluna,id_para_ignorar
        'email' => 'required|email|unique:users,email,' . $user->id,
        'cpf' => 'required',
        'password' => [
            'nullable', // Senha não é obrigatória na edição
            \Illuminate\Validation\Rules\Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->is_admin = $request->has('is_admin');

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success');
    }
}
