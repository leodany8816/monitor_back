<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use app\Models\Usuario;
use App\Models\Empresa;

class CfdiController extends Controller
{
    protected $cfdi;
    protected $usuario;

    public function index(Request $request)
    {
        //$usuario = Usuario::orderBy('id_usuario')->get();
        $user = $request->user();
        $idEmpresa = $user->id_empresa;

        //$facturas = Factura::with(['empresa', 'conceptos','retenciones','traslados'])->where('id_empresa', '=', $idEmpresa)->get();
        $cfdis = Factura::orderBy('id_factura', 'desc')->where('id_empresa', '=', $idEmpresa)->get();
        $numCfdis = count($cfdis);
        if (count($cfdis) > 0) {
            $facturas = $cfdis->map(function ($cfdi) {
                return [
                    'id_factura' => $cfdi->id_factura,
                    'emisor' => $cfdi->emisor_Nombre,
                    'emisorRfc' => $cfdi->emisor_Rfc,
                    'serie' => $cfdi->comprobante_serie,
                    'folio' => $cfdi->comprobante_folio,
                    'receptor' => $cfdi->receptor_Nombre,
                    'receptorRfc' => $cfdi->receptor_Rfc,
                    'fechaEmision' => $cfdi->comprobante_fecha,
                    'tipoComprobante' => $cfdi->comprobante_TipoDeComprobante,
                    'subtotal' => $cfdi->comprobante_SubTotal,
                    'traslado' => $cfdi->impuesto_trasladado,
                    'retencion' => $cfdi->impuesto_retenido,
                    'total' => $cfdi->comprobante_Total,
                    'nombreXml' => $cfdi->nombre_xml,
                    'nombrePdf' => $cfdi->nombre_pdf,
                ];
            });

            $cfdis = [
                'exito' => 'true',
                'cfdis' => $facturas
            ];

            return response()->json(
                $cfdis
            );
        } else {
            $jsonError =[
               'exito' => 'false',
                'message' => "No existen CFDIS"
            ];

            return response()->json(
                $jsonError
            );
        }
    }
}
