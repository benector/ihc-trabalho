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
            'projetos' => ProjetoExtensao::with('areas')->get()
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
        $data = $request->validate([
            'titulo' => 'required|unique:projetos_extensao,titulo',
            'descricao' => 'required',
            'localidade' => 'required',
            'coordenador' => 'required',
            'data_inicio' => 'required|date',
            'area_id' => ['required', 'array'],
            'area_id.*' => ['exists:areas,id'],
        ]);

        // cria o projeto SEM as áreas
        $projeto = ProjetoExtensao::create(
            collect($data)->except('area_id')->toArray()
        );

        // associa as áreas (pivot)
        $projeto->areas()->attach($data['area_id']);

        return redirect()->route('admin.projetos.index');
    }

    public function edit(ProjetoExtensao $projeto)
    {
        return view('admin.projetos.edit', [
            'projeto' => $projeto->load('areas'),
            'areas' => Area::all()
        ]);
    }

    public function update(Request $request, ProjetoExtensao $projeto)
    {
        $data = $request->validate([
            'titulo' => 'required|unique:projetos_extensao,titulo,' . $projeto->id,
            'descricao' => 'required',
            'localidade' => 'required',
            'coordenador' => 'required',
            'area_id' => ['required', 'array'],
            'area_id.*' => ['exists:areas,id'],
        ]);

        // atualiza dados do projeto
        $projeto->update(
            collect($data)->except('area_id')->toArray()
        );

        // sincroniza áreas
        $projeto->areas()->sync($data['area_id']);

        return redirect()->route('admin.projetos.index');
    }

    public function destroy(ProjetoExtensao $projeto)
    {
        $projeto->areas()->detach();
        $projeto->delete();

        return redirect()->route('admin.projetos.index');
    }

    // =========================
    // 🌐 LISTAGEM PÚBLICA
    // =========================
    public function publicIndex(Request $request)
    {
        $areas = Area::all();

        // ✅ relação correta
        $query = ProjetoExtensao::with('areas');

        // 🔎 palavra-chave
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->q . '%')
                  ->orWhere('descricao', 'like', '%' . $request->q . '%');
            });
        }

        // 📍 localidade
        if ($request->filled('localidade')) {
            $query->where('localidade', 'like', '%' . $request->localidade . '%');
        }

        // 🧠 múltiplas áreas
        if ($request->filled('area_id')) {
            $query->whereHas('areas', function ($q) use ($request) {
                $q->whereIn('areas.id', (array) $request->area_id);
            });
        }

        $projetos = $query
            ->orderBy('titulo')
            ->paginate(10)
            ->withQueryString();

        return view('projetos_publicos.index', compact('projetos', 'areas'));
    }
}
