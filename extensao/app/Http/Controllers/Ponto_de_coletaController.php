<?php

namespace App\Http\Controllers;

use App\Models\Ponto_de_coleta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ponto_de_coletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituicaoId = Auth::id();
        $agora = Carbon::now();

        // Lógica para buscar pontos ATIVOS
        $pontosAtivos = Ponto_de_coleta::where('id_instituicao', $instituicaoId)
            ->where(function ($query) use ($agora) {
                $query->whereNull('data_fim')
                    ->orWhere('data_fim', '>', $agora);
            })
            ->orderBy('data_inicio', 'desc')
            ->get();

        $pontosFinalizados = Ponto_de_coleta::where('id_instituicao', $instituicaoId)
            ->whereNotNull('data_fim')
            ->where('data_fim', '<=', $agora)
            ->orderBy('data_fim', 'desc')
            ->get();

        return view('areaDaInstituicao.pontoDeColeta', compact('pontosAtivos', 'pontosFinalizados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('areaDaInstituicao.pontoDeColetaCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'endereco' => 'required|string|max:200',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        $dados = $request->all();
        $dados['id_instituicao'] = Auth::id();

        Ponto_de_coleta::create($dados);

        return redirect()->route('areaDaInstituicao.pontoDeColeta.index')
            ->with('success', 'Novo ponto de coleta cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ponto = Ponto_de_coleta::findOrFail($id);

        if ($ponto->id_instituicao != Auth::id()) {
            return redirect()->route('areaDaInstituicao.pontoDeColeta.index')
                ->with('error', 'Acesso não autorizado.');
        }

        return view('areaDaInstituicao.pontoDeColetaEdit', compact('ponto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ponto = Ponto_de_coleta::findOrFail($id);

        if ($ponto->id_instituicao != Auth::id()) {
            return redirect()->route('areaDaInstituicao.pontoDeColeta.index')
                ->with('error', 'Acesso não autorizado.');
        }

        $request->validate([
            'endereco' => 'required|string|max:200',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);


        $ponto->update($request->all());

        return redirect()->route('areaDaInstituicao.pontoDeColeta.index')
            ->with('success', 'Ponto de coleta atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ponto = Ponto_de_coleta::findOrFail($id);

        if ($ponto->id_instituicao != Auth::id()) {
            return redirect()->back()->with('error', 'Ação não autorizada.');
        }

        $ponto->delete();

        return redirect()->route('areaDaInstituicao.pontoDeColeta.index')
            ->with('success', 'Ponto de coleta excluído com sucesso!');
    }
}
