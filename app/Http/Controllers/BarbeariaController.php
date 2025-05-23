<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barbearia;

class BarbeariaController extends Controller
{
    public function buscarPorNome($nome)
    {
        $barbearia = Barbearia::with(['barbeiros.agendamentos' => function ($query) {
            $query->onlyTrashed();
        }])
        ->where('slug', $nome)
        ->first();
    
        if (!$barbearia) {
            return response()->json(['error' => 'Barbearia não encontrada'], 404);
        }

        // Extrair apenas os dados dos agendamentos
        $agendamentos = $barbearia->barbeiros->flatMap(function ($barbeiro) {
            return $barbeiro->agendamentos->filter(function ($agendamento) {
                return $agendamento->trashed();
            });
        });

        return response()->json($agendamentos);
    }
}
