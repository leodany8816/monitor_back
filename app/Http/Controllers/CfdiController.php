<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use App\Models\Factura;
use app\Models\Usuario;
use App\Models\Empresa;
use Exception;
use Illuminate\Support\Facades\Date;

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
                $newDate = explode("-", $date[0]);
                $fecha = $newDate[2] . "-" . $newDate[1] . "-" . $newDate[0];

                /**
                 * en el tipo de comprobante si es "E" es Egreso si es "I" es ingreso
                 */
                if ($cfdi->comprobante_TipoDeComprobante == 'E')
                    $tipoCom = "Egreso";
                else
                    $tipoCom = "Ingreso";

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
                    'subtotal' => "$" . number_format($cfdi->comprobante_SubTotal, 2),
                    'traslado' => "$" . number_format($cfdi->impuesto_trasladado, 2),
                    'retencion' => "$" . number_format($cfdi->impuesto_retenido, 2),
                    'total' => "$" . number_format($cfdi->comprobante_Total, 2),
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
            $jsonError = [
                'exito' => 'false',
                'message' => "No existen CFDIS"
            ];

            return response()->json(
                $jsonError
            );
        }
    }

    public function downloadzip(Request $request)
    {
        // echo "metodo para descargar los zips";
        // echo "<br>" . $request->cfdis;
        $dataFiles = explode(',', $request->cfdis);
        // echo "<br> tamanio " . count($dataFiles);

        //Ruta donde se encuentran los archivos a buscar
        $folderPath = storage_path('/app/public/cfdis/');

        // Verificar si la carpeta existe
        if (!File::exists($folderPath)) {
            return response()->json(['message' => 'Folder not found'], 404);
        }

        // Crear un archivo ZIP temporal
        // $zipFileName = 'cfdis->' . date('Ymd:Hms') . '.zip';
        $zipFileName = 'cfdis_' . date('Ymd_His') . '.zip';
        $zipPath = storage_path('/app/public/temp/' . $zipFileName);
        $zip = new ZipArchive;

        try {
            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                foreach ($dataFiles as $file) {
                    $cfdi = Factura::findOrFail($file);
                    $id_factura = $cfdi->id_factura;
                    $fileXml = $cfdi->nombre_xml;
                    $filePdf = $cfdi->nombre_pdf;
                    // echo $id_factura . "|" . $fileXml . "|" . $filePdf;
                    // echo "<br/>";
                    // echo "listo";
                    $filePathXml = $folderPath . $fileXml;
                    $filePathPdf = $folderPath . $filePdf;
                    if (file_exists($filePathXml) || file_exists($filePathPdf)) {
                        // Agregar archivo al ZIP
                        $zip->addFile($filePathXml, $fileXml);
                        $zip->addFile($filePathPdf, $filePdf);

                        // Cerrar el archivo ZIP
                    } else {
                        return response()->json([
                            'exito' => false,
                            'error' => "El archivo {$fileXml} {$filePdf} no se encontró."
                        ], 404);
                    }
                }
                $zip->close();
            } else {
                return response()->json([
                    'exito' => false,
                    'error' => 'No se pudo crear el archivo ZIP.'
                ], 500);
            }
        } catch (Exception $error) {
            return response()->json([
                'exito' => false,
                'error' => 'Error al crear el archivo ZIP.'
            ], 500);
        }

        // Leer el archivo ZIP y codificarlo en base64
        $zipContent = file_get_contents($zipPath);
        $zipBase64 = base64_encode($zipContent);

        // Eliminar el archivo ZIP después de codificarlo
        File::delete($zipPath);

        // Enviar la respuesta en formato JSON con el archivo ZIP codificado en base64
        return response()->json([
            'exito' => true,
            'nombreZip' => $zipFileName,
            'file_base64' => $zipBase64
        ], 200);
    }
}
