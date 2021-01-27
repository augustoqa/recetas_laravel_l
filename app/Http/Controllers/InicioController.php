<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Obtener las recetas recientes
        $nuevas = Receta::latest()->take(5)->get();

        $categorias = CategoriaReceta::all();
        
        // Agrupar las recetas por categoria
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[ Str::slug($categoria->nombre) ][] = 
                Receta::where('categoria_id', $categoria->id)
                    ->take(3)
                    ->get();
        }

        return $recetas;

        // Recetas por categoría
        $mexicana = Receta::where('categoria_id', 1)->get();

        return view('inicio.index', \compact('nuevas'));
    }
}
