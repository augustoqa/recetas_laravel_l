<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
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
        $data = $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        // Asignar nombre y URL
        $user = auth()->user();
        $user->url = $data['url'];
        $user->name = $data['nombre'];
        $user->save();

        unset($data['url']);
        unset($data['nombre']);

        // Asignar biografía e imagen
        $user->perfil()->update($data);

        // Si el usuario sube una imagen
        return "actualizando";
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
