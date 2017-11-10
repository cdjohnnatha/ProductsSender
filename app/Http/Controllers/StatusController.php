<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    //TODO: controlador misturado? se for pra retornar JSON, as rotas não são WEB e sim API
    public function showStatus(){
        return response()->json([
            'status' => Status::all()
        ]);
    }

    public function warehouseStatus(){
        return response()->json([
            'statuswarehouse' => Status::where('status', 'like', 'WAREHOUSE%')->get()
        ]);
    }

    public function update(Response $response, $id){
        $status = Status::findOrFail($id);
        $status->status = $response->input('status');
        $status->save();

        return Response('Updated successfully', 200);
    }

    public function destroy($id){
        $status = Status::findOrFail($id)->delete();
    }
}
