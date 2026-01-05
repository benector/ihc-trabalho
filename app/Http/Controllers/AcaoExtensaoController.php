<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcaoExtensaoController extends Controller
{
    public function index(Request $request)
    {
        $query = AcaoExtensao::with('area');

        if ($request->area) {
            $query->where('area_id', $request->area);
        }

        if ($request->busca) {
            $query->where(function ($q) use ($request) {
                $q->where('titulo', 'like', "%{$request->busca}%")
                  ->orWhere('responsavel', 'like', "%{$request->busca}%")
                  ->orWhere('local', 'like', "%{$request->busca}%");
            });
        }

        $acoes = $query->get();
        $areas = Area::all();

        return view('acoes.index', compact('acoes', 'areas'));
    }

    public function show($id)
    {
        $acao = AcaoExtensao::with('area')->findOrFail($id);
        return view('acoes.show', compact('acao'));
    }
}

