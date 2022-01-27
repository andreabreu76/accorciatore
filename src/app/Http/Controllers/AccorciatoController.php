<?php

namespace App\Http\Controllers;

use App\Models\Accorciato;
use App\Models\Reindirizzamento;
use http\Env\Response;
use http\Header;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccorciatoController extends Controller
{
    /**
     * @var Accorciato
     * @var Reindirizzamento
     * @var ReindirizzamentoController
     */
    private $modelAccorciato;
    private $modelReindirizzare;

    private function __construct()
    {
      $this->modelAccorciato = new Accorciato();
      $this->modelReindirizzare = new Reindirizzamento();

    }

    /**
     * @param $cognaome
     * @return JsonResponse|void
     */
    public function reindirizzare($cognaome)
    {

        $accorciato = $this->modelAccorciato->mostraAccorciatoCogname($cognaome);
        if ($accorciato == null) {
            return response()->json(['error' => 'Cognome non trovato'], 404);
        }



        $this->modelReindirizzare->nuovoReindirizzamento($accorciato->id);

        $url = $accorciato->url;

        header("Location: $url", true, 301);
    }
}
