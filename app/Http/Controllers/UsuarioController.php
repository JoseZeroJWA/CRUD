<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Muestra el contenido de la base de datos
        $users = Usuario::get();

        return view('crud')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // crea un nuevo usuario para el crud.
        $request->validate([
            'nombre' => 'required|min:4|max:150',
        ]);

        try {
            Usuario::create([
                'nombre' => $request->nombre
            ]);

            return redirect()->back()->with('message', 'Operation Successful !');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Edita un usuario de la tabla
        $request->validate([
            'nombre' => 'required|min:4|max:150',
        ]);

        try {
            Usuario::where('id', $id)->update([
                'nombre' => $request->nombre
            ]);
            return redirect()->back()->with('message', 'Operation Successful !');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Elimina un registro de la tabla
        try {
            Usuario::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Operation Successful !');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
