<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\Orden;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=DB::table('ordenes')
                    ->join('categoria', 'ordenes.id_categoria', '=', 'categoria.id_categoria')
                    ->join('clientes', 'ordenes.id_cliente', '=', 'clientes.id_cliente')
                    ->join('tecnicos', 'tecnicos.id_tecnico', '=', 'tecnicos.id_tecnico')
                    ->select('ordenes.*', 'categoria.nombre_categoria', 'clientes.*','tecnicos.nombre_tec')
                    ->orderBy('id_orden','DESC')
                    ->get();
        return $productos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orden= Orden::create($request->all());

        if ($request->probando) {
            $orden->componentes()->sync($request->probando);
            //$neworden->componentes()->sync(array(1,2,3,4));
        }
        return $orden;
        //tipo_comp,modelo_comp,serial_comp,cap_comp
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
