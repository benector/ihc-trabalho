<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjetoExtensao;
use App\Models\Area;
use Illuminate\Http\Request;

class ProjetoExtensaoController extends Controller
{
    public function index()
    {
        return view('admin.projetos.index', [
            'projetos' => ProjetoExtensao::with('area')->get()
        ]);
    }

    public function create()
    {
        return view('admin.projetos.create', [
            'areas' => Area::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|unique:projetos_extensao,titulo',
            'descricao' => 'required',
            'localidade' => 'required',
            'area_id' => 'required|exists:areas,id',
            'coordenador' => 'required',
            'data_inicio' => 'required|date'
        ]);

        ProjetoExtensao::create($request->all());
        return redirect()->route('admin.projetos.index');
    }

    public function edit(ProjetoExtensao $projeto)
    {
        return view('admin.projetos.edit', [
            'projeto' => $projeto,
            'areas' => Area::all()
        ]);
    }

    public function update(Request $request, ProjetoExtensao $projeto)
    {
        $request->validate([
            'titulo' => 'required|unique:projetos_extensao,titulo',
            'descricao' => 'required',
            'localidade' => 'required',
            'area_id' => 'required',
            'coordenador' => 'required'
        ]);

        $projeto->update($request->all());
        return redirect()->route('admin.projetos.index');
    }

    public function destroy(ProjetoExtensao $projeto)
    {
        $projeto->delete();
        return redirect()->route('admin.projetos.index');
    }

   public function publicIndex(Request $request)
{
    $areas = Area::orderBy('nome')->get();

    $query = ProjetoExtensao::with('area');

    // 🔎 busca por palavra-chave (título ou descrição)
    if ($request->filled('q')) {
        $query->where(function ($q) use ($request) {
            $q->where('titulo', 'like', '%' . $request->q . '%')
              ->orWhere('descricao', 'like', '%' . $request->q . '%');
        });
    }

    // 📍 filtro por localidade (parcial ou completa)
    if ($request->filled('localidade')) {
        $query->where('localidade', 'like', '%' . $request->localidade . '%');
    }

    // 🧠 filtro por área de conhecimento
  // 🧠 filtro por múltiplas áreas de conhecimento
if ($request->filled('area_id')) {
    $query->whereIn('area_id', (array) $request->area_id);
}

    $projetos = $query
        ->orderBy('titulo')
        ->paginate(10)
        ->withQueryString();

    return view('projetos_publicos.index', compact('projetos', 'areas'));
}
}
