<?php

namespace App\Http\Controllers;

use App\Models\Reindirizzamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReindirizzamentoController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reindirizzamenti = Reindirizzamento::all();
        return response()->json($reindirizzamenti, 200);
    }

    public function getCount($accorciato): JsonResponse
    {
        $reindirizzamenti = Reindirizzamento::query();
        $reindirizzamenti->where('accorciatos_id', $accorciato);
        $reindirizzamenti->count();

        return response()->json($reindirizzamenti, 200);

    }

}
