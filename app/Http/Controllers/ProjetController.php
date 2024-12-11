<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    /**
     * Afficher la liste des projets.
     */
    public function index()
    {
        $projets = Projet::all();
        return response()->json($projets);
    }

    /**
     * Enregistrer un nouveau projet.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lien' => 'nullable|url',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $projet = Projet::create($data);
        return response()->json($projet, 201);
    }

    /**
     * Afficher un projet spécifique.
     */
    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        return response()->json($projet);
    }

    /**
     * Mettre à jour un projet existant.
     */
    public function update(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);

        $data = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'lien' => 'nullable|url',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $projet->update($data);
        return response()->json($projet);
    }

    /**
     * Supprimer un projet.
     */
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();
        return response()->json(['message' => 'Projet supprimé avec succès.']);
    }
}
