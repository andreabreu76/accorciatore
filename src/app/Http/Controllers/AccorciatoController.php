<?php

namespace App\Http\Controllers;

use App\Models\Accorciato;
use Illuminate\Http\Request;

class AccorciatoController extends Controller
{
    /**
     * @var Accorciato
     */
    private $modelAccorciato;

    private function __construct()
    {
      $this->modelAccorciato = new Accorciato();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function reindirizzare(Request $request)
    {

    }

}
