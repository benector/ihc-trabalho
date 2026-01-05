<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcaoExtensao;
use App\Models\Area;
use Illuminate\Http\Request;

class AcaoController extends Controller
{
    /**
     * Lista todas as ações
     */
    public function index()
    {
        $acoes = AcaoExtensao::with('area')->get();
        return view('admin.acoes.index', compact('acoes'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $areas = Area::all();
        return view('admin.acoes.create', compact('areas'));
    }

    /**
     * Salva nova ação
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required',
            'area_id' => 'required|exists:areas,id',
            'local' => 'required|string|max:255',
            'responsavel' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        AcaoExtensao::create($request->all());

        return redirect()
            ->route('admin.acoes.index')
            ->with('success', 'Ação cadastrada com sucesso!');
    }

    /**
     * Formulário de edição
     */
   public function edit(AcaoExtensao $aco)
{
    $areas = Area::all();
    return view('admin.acoes.edit', compact('aco', 'areas'));
}

public function update(Request $request, AcaoExtensao $aco)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descricao' => 'required',
        'area_id' => 'required|exists:areas,id',
        'local' => 'required|string|max:255',
        'responsavel' => 'required|string|max:255',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date|after_or_equal:data_inicio',
    ]);

    $acao->update($request->all());

    return redirect()
        ->route('admin.acoes.index')
        ->with('success', 'Ação atualizada com sucesso!');
}

public function destroy(AcaoExtensao $aco)
{
    $acao->delete();

    return redirect()
        ->route('admin.acoes.index')
        ->with('success', 'Ação removida com sucesso!');
}

}
