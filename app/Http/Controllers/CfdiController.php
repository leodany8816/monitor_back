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
                /**
                 * Formateamos la fecha a dd/mm/yy
                 */
                $date = explode("T", $cfdi->comprobante_fecha);
                $newDate = explode("-",$date[0]);
                $fecha = $newDate[2]."-".$newDate[1]."-".$newDate[0];

                /**
                 * en el tipo de comprobante si es "E" es Egreso si es "I" es ingreso
                 */
                if($cfdi->comprobante_TipoDeComprobante == 'E')
                    $tipoCom="Egreso";
                else
                    $tipoCom="Ingreso";

                return [
                    'id_factura' => $cfdi->id_factura,
                    'emisor' => $cfdi->emisor_Nombre,
                    'emisorRfc' => $cfdi->emisor_Rfc,
                    'serie' => $cfdi->comprobante_serie,
                    'folio' => $cfdi->comprobante_folio,
                    'receptor' => $cfdi->receptor_Nombre,
                    'receptorRfc' => $cfdi->receptor_Rfc,
                    'fechaEmision' => $fecha,
                    'tipoComprobante' => $tipoCom,
                    'subtotal' => "$".number_format($cfdi->comprobante_SubTotal,2),
                    'traslado' => "$".number_format($cfdi->impuesto_trasladado,2),
                    'retencion' => "$".number_format($cfdi->impuesto_retenido,2),
                    'total' => "$".number_format($cfdi->comprobante_Total,2),
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
