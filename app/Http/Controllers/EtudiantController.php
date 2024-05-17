<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Throwable;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::paginate(10);
        // cacher des champs supplémentaires
        // $etudiants->makeHidden([
        //     'email',
        //     'tekephone',
        // ]);
        return response()->json($etudiants, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = validator($request->all(), [
            // 'matricule' => 'required|unique:etudiants,matricule',
            'prenom' => 'required',
            'nom' => 'required',
            'date_naissance' => 'required|date|before:today',
            'lieu_naissance' => 'required',
            'sexe' => 'required|in:masculin,feminin',
            'email' => 'required|unique:etudiants,email|email',
            'telephone' => 'required|unique:etudiants|starts_with:+,00',
            'situation_matrimoniale' => 'required|in:celibataire,marie,divorce,veuf',
            'region_naissance' => 'required',
            'adresse' => 'required',
            'nationalite' => 'required',
            'nom_complet_mere' => 'required',
            'nom_complet_pere' => 'required',
        ]);
        if($validators->fails()) {
            return response()->json($validators->errors(), 400);
        }
        try {
            DB::beginTransaction();
            $etudiant = new Etudiant($request->all());
            $etudiant->saveOrFail();
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), 500);
        }

        return response()->json($etudiant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        $executed = RateLimiter::attempt(
            'show-user',
            $perMinute = 5,
            function() {
                // Send message...
            }
        );
         
        if (! $executed) {
          return 'Too many messages sent!';
        }
        return response()->json($etudiant, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validators = validator($request->all(), [
            'prenom' => 'required',
            'nom' => 'required',
            'date_naissance' => 'required|date|before:today',
            'lieu_naissance' => 'required',
            'sexe' => 'required|in:masculin,feminin',
            'email' => 'required|email',
            'telephone' => 'required|starts_with:+,00',
            'situation_matrimoniale' => 'required|in:celibataire,marie,divorce,veuf',
            'region_naissance' => 'required',
            'adresse' => 'required',
            'nationalite' => 'required',
            'nom_complet_mere' => 'required',
            'nom_complet_pere' => 'required',
        ]);
        if($validators->fails()) {
            return response()->json($validators->errors(), 400);
        }
        try {
            DB::beginTransaction();
            $etudiant->updateOrFail($request->all());
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), 500);
        }

        return response()->json($etudiant, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        try {
            DB::beginTransaction();
            $etudiant->deleteOrFail();
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), 500);
        }

        return response()->json(null, 204);
    }


    public function search(Request $request)
    {
        $etudiants = Etudiant::where('nom', 'like', '%'.$request->search.'%')
            ->orWhere('prenom', 'like', '%'.$request->search.'%')
            ->paginate(10);
        return response()->json($etudiants, 200);
    }
}
