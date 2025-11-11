<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;


class MaterialController extends Controller
{
    
    public function index()
    {
        $materiais = Material::orderBy('name', 'asc')->get(); 

        return view('areaDaInstituicao.material', compact('materiais'));
    }

    public function create()
    {
        $materiais = Material::orderBy('name')->get();

        return view('material.create', [
            'materiais' => $materiais
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255',
        ]);

        foreach ($validated['name'] as $nome) {
            Material::create([
                'name' => $nome,
            ]);
        }

        return redirect()->back()->with('success', 'Materiais cadastrados com sucesso!');
    }

    public function destroy($id)
    {
        $material = \App\Models\Material::findOrFail($id);
        $material->delete();

        return redirect()->route('areaDaInstituicao.material')
            ->with('success', 'Material excluído com sucesso!');
    }

    public function edit($id)
    {
        $material = \App\Models\Material::findOrFail($id);
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $material = \App\Models\Material::findOrFail($id);
        $material->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('areaDaInstituicao.material')
            ->with('success', 'Material atualizado com sucesso!');
    }
}
