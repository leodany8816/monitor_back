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
            $empresa = [];
            $empresas = Empresa::get()->where('id_empresa', '=', $idEmpresa);
            foreach($empresas as $empresa){
                return [
                    "exito" => true,
                    "id_empresa" => $empresa->id_empresa,
                    "nombre" => $empresa->nombre,
                    "rfc" => $empresa->rfc,
                    "logo" => $empresa->logo
                ];
            }
            // $empresa  = $empresas->map(function ($empresa) {
            //     return [
            //         "id_empresa" => $empresa->id_empresa,
            //         "nombre" => $empresa->nombre,
            //         "rfc" => $empresa->rfc,
            //         "logo" => $empresa->logo
            //     ];
            // });
            // $jsonEmpresas = [
            //     'exito' => 'true',
            //     'empresa' =>[ $empresa ]
            // ];

            $empresas = [
                'empresa' => $empresa
            ];

            return response()->json(
                $empresas
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

//https://github.com/Logicainformatica18/certificaciones
