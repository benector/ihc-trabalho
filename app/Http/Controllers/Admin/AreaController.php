<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.areas.index', [
            'areas' => Area::all()
        ]);
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required']);
        Area::create($request->all());
        return redirect()->route('admin.areas.index');
    }

    public function edit(Area $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate(['nome' => 'required']);
        $area->update($request->all());
        return redirect()->route('admin.areas.index');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.areas.index');
    }
}
