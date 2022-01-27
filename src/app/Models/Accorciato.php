<?php

namespace App\Models;

use App\Http\Controllers\IpController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class Accorciato extends Model
{
    use HasFactory;

    const STATO_ATTIVO = 1;
    const STATO_INATTIVO = 0;

    protected $fillable = [
        'id',
        'url',
        'cognaome',
        'ip',
        'visita',
        'stato',
        'create_at',
        'updated_at'
    ];


    /**
     * @param $url
     * @return bool
     */
    public function encontreAccorciato($url): bool
    {
        $accorciato = Accorciato::query()->where('url', $url)->first();
        if ($accorciato) {
            return true;
        }
        return false;
    }

    /**
     * @return Accorciato[]|Collection
     */
    public function mostraTuttoliAccorciato()
    {
        return Accorciato::all();
    }

    /**
     * @param $cogname
     * @return bool|Builder[]|Collection
     */
    public function mostraAccorciatoCogname($cogname)
    {
        $accorciato = Accorciato::query()->where('cognaome', $cogname)->get();
        if (!$accorciato) {
            return false;
        }
        return $accorciato;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function creaAccorciato(Request $request): JsonResponse
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $accorciatoEsistere = self::encontreAccorciato($request->url);
        if ($accorciatoEsistere != false) {
            return response()->json('Questo URL esiste già.', 401);
        }

        $accorciato = [
            'url' => $request->url,
            'cognaome' => substr(md5(uniqid(rand(), true)),0,6),
            'stato' => Accorciato::STATO_ATTIVO,
            'ip' => "0",
            'crate_at' => date('Y-m-d H:i:s')
        ];

        $accorciato = Accorciato::query()->create($accorciato)['cognaome'];

        return response()->json(["Accorciato:" => env("URI_ENCURTADA")."/".$accorciato]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function mostraAccorciato($id): JsonResponse
    {
        $accorciato = Accorciato::query()->find($id);
        if ($accorciato) {
            return response()->json($accorciato);
        }
        return response()->json('Accorciato non trovato.', 404);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function eliminaAccorciato($id): JsonResponse
    {
        $accorciato = Accorciato::query()->find($id);
        if ($accorciato) {
            $accorciatoStato = $this->mostraAccorciato($id);
            if ($accorciatoStato->getData()->stato == Accorciato::STATO_ATTIVO) {
                $accorciato->stato = Accorciato::STATO_INATTIVO;
                $accorciato->save();
                return response()->json('Accorciato eliminato.', 200);
            }
        }
        return response()->json('Accorciato non trovato.', 404);
    }

}
