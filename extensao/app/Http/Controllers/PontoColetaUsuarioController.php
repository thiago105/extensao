<?php

namespace App\Http\Controllers;

use App\Models\Ponto_de_coleta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PontoColetaUsuarioController extends Controller
{
    /**
     * */
    public function index(Request $request)
    {
        $query = Ponto_de_coleta::with('instituicao');


        if ($request->filled('filtro_nome')) {
            $query->whereHas('instituicao', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filtro_nome . '%');
            });
        }


        if ($request->filled('filtro_data')) {
            $dataFiltro = Carbon::parse($request->filtro_data)->toDateString();

            $query->where('data_inicio', '<=', $dataFiltro)
                ->where(function ($q) use ($dataFiltro) {
                    $q->whereNull('data_fim')
                        ->orWhere('data_fim', '>=', $dataFiltro);
                });
        }

        $agora = Carbon::now();
        $query->where(function ($q) use ($agora) {
            $q->whereNull('data_fim')
                ->orWhere('data_fim', '>=', $agora);
        });


        $pontosDeColeta = $query->orderBy('data_inicio', 'desc')->paginate(10);


        return view('areaDoUsuario.pontoDeColeta', [
            'pontosDeColeta' => $pontosDeColeta,
            'filtros' => $request->only('filtro_nome', 'filtro_data')
        ]);
    }
}