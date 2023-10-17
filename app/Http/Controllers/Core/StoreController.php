<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Store::all();

        return response()->json(['msg' => 'Resultados da busca', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $data = $request->header('empresa');
        $data = $request->all();
        Store::create($data);
        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Store::find($id);

        if(!$data){
            return response()->json(['msg' => 'registro não encontrado'], 404);
        }

        return response()->json(['data' => $data],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataRequest = $request->all();
        $data = Store::findOrfail($id);
        $data->update($dataRequest);

        return response()->json(['msg' => 'Dados Atualizaddos com sucesso.', 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Store::find($id);
        $data->delete();
        return response()->json(['msg' => 'Registro excluído com sucesso']);
    }
}
