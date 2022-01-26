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
        'crate_at',
        'updated_at'
    ];


    /**
     * @param $url
     * @return bool|Builder|Model|object
     */
    public function encontreAccorciato($url)
    {
        $accorciato = Accorciato::query()->where('url', $url)->first();
        if ($accorciato) {
            $accorciato->visita = $accorciato->visita + 1;
            $accorciato->save();
            return $accorciato;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function creaAccorciato(Request $request): JsonResponse
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $accorciatoEsistere = Accorciato::encontreAccorciato($request->url)->first();
        if ($accorciatoEsistere) {
            return response()->json('Questo URL esiste già.', 401);
        }

        $accorciato = Accorciato::query()->create([
            'url' => $request->url,
            'cognome' => substr(md5(uniqid(rand(), true)),0,6),
            'ip' => (new IpController())->getIp(),
            'visita' => 0,
            'stato' => Accorciato::STATO_ATTIVO,
            'crate_at' => date('Y-m-d H:i:s')
        ])['cognome'];

        return response()->json(["Accorciato:" => "https://".env("URI_ENCURTADA")."/".$accorciato]);
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
