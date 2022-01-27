<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Reindirizzamento extends Model
{
    use HasFactory;

    protected $table = 'reindirizzamenti';

    protected $fillable = [
        'ip',
        'ospite',
        'utente',
        'created_at',
        'updated_at'
    ];

    public function nuovoReindirizzamento($id): bool
    {
        $httpRequest = new Request();
        try {
            self::query()
                ->insert([
                    'accorciato_id' => $id,
                    'ip' => $httpRequest->getClientIp(),
                    'ospite' => $httpRequest->getHost(),
                    'utente' => $httpRequest->userAgent(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function getReindirizzamenti($id): array
    {
        return self::query()
            ->where('accorciato_id', $id)
            ->get()
            ->toArray();
    }




}
