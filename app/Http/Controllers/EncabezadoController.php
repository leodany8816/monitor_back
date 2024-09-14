<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Exception;

class EncabezadoController extends Controller
{
    protected $empresa;

    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $idEmpresa = $user->id_empresa;

            $empresa = Empresa::get()->where('id_empresa', '=', $idEmpresa);
            $jsonEmpresas = [
                'exito' => 'true',
                'empresa' => $empresa
            ];

            return response()->json(
                $jsonEmpresas
            );
            
            // return response()->json(
            //     $empresa
            // );
        } catch (Exception $e) {
            $jsonError = [
                'existo' => 'false',
                'mensaje' => $e->getMessage()
            ];

            return response()->json(
                $jsonError
            );
        }
    }
}
