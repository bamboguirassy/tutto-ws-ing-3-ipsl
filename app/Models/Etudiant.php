<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    // protected $hidden = [
    //     'situation_matrimoniale',
    //     'nombre_enfants',
    //     'boursier',
    //     'handicap',
    //     'is_chronique',
    //     'casier_judiciaire',
    //     'nom_complet_mere',
    //     'nom_complet_pere',
    // ];

    public static function boot() {
        parent::boot();
        static::creating(function($etudiant) {
            $etudiant->matricule = 'P'.time();
        });

        static::created(function($etudiant) {
            // envoyer un mail à l'étudiant
        });
    }
}
