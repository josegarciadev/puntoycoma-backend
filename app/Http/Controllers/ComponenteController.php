<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentes=DB::table('componentes')
                    ->join('ordenes', 'componentes.id_orden', '=', 'ordenes.id_orden')
                    ->select('componentes.*', 'ordenes.*')
                    ->orderBy('id_componente','DESC')
                    ->get();
        if ($componentes && !$componentes->isEmpty()) {
            return \Response::json($componentes,200);
        }
        return \Response::json(['errors'=>true],404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $componentes=DB::table('componentes')
                    ->where('id_orden', '=', $id)
                    ->get();
        if ($componentes && !$componentes->isEmpty()) {
            return \Response::json($componentes,200);
        }
        return \Response::json(['errors'=>true],404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
