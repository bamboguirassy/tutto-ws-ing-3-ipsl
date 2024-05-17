<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Etudiant extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    protected $hidden = [
        'situation_matrimoniale',
        'nombre_enfants',
        'boursier',
        'handicap',
        'is_chronique',
        'casier_judiciaire',
        'nom_complet_mere',
        'nom_complet_pere',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function($etudiant) {
            $etudiant->matricule = 'P'.random_int(1000000000,9999999999);
            $etudiant->uid = Str::uuid();
        });

        static::created(function($etudiant) {
            // envoyer un mail à l'étudiant
        });
    }
}
