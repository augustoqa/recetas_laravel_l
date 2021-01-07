<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        return view('perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // Ejecutar el Policy
        $this->authorize('update', $perfil);

        $data = $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        if ($request->imagen) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request->imagen->store('upload-perfiles', 'public');

            // resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            $array_imagen = ['imagen' => $ruta_imagen];
        }

        // Asignar nombre y URL
        $user = auth()->user();
        $user->url = $data['url'];
        $user->name = $data['nombre'];
        $user->save();

        unset($data['url']);
        unset($data['nombre']);

        // Asignar biografía e imagen
        $user->perfil()->update(array_merge(
            $data,
            $array_imagen ?? []
        ));

        // Si el usuario sube una imagen
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
