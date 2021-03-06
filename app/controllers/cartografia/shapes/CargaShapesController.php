<?php
/**
 * Created by PhpStorm.
 */

use \shpUploader;

class CargaShapesController extends BaseController
{

    /**
     * Muestra la pantalla principal para la carga de shapes
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Title
        $title = "Actualización Cartográfica";
        // Title
        $title_section = "Actualización Cartográfica";

        //municipios
        $result = DB::select('SELECT municipio, nombre_municipio from municipios order by municipio');
        
        $municipios = array();

        foreach($result as $registro){
            $municipios[$registro->municipio] = $registro->nombre_municipio;
        }       
           
        //$view = View::make('cartografia.consultas.form') ;

        return View::make('admin.cargashapes.upload-shape', compact('title', 'title_section', 'municipios'));
    }

    /**
     * Procesa la carga cartografica
     * @return mixed
     */
    public function upload()
    {
        // Se valida que exista un archivo
        if(Input::file('shape')) {

            // Se valida el directorio para subir shapes
            $dir = storage_path('shapes');
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }

            // Se valida la extensión del archivo
            error_log(Input::file('shape')->getClientMimeType());
            if(in_array(strtolower(Input::file('shape')->getClientMimeType()), array('application/zip', 'application/octet-stream')))
            {
                $manzana = Input::get('manzana');
                $municipio= Input::get('municipio');
                $sufijo = date("dmyHis");
                if(strcmp($manzana, substr(Input::file('shape')->getClientOriginalName(),0,8)) != 0){
                    return Redirect::to('admin/carga-shapes')->with('error',"El archivo ".Input::file('shape')->getClientOriginalName()." no coincide con la manzana ".$manzana);
                }

                $zipfile = $municipio."-".$manzana."-".$sufijo.".zip";
                Input::file('shape')->move($dir, $zipfile);
                $dirzip = storage_path('shapes/');
                $dirtmp = "/tmp/";


                $upload = new shpUploader();

                $Respuesta = $upload->uploadShape($municipio, $manzana, $dirzip, $dirtmp, $zipfile);
                $logHead = $Respuesta[0];
                $logErr = $Respuesta[1];
                $logWar = $Respuesta[2];

                //return Redirect::to('admin/carga-shapes')->with('success',
                 //   '¡Se guardo correctamente el archivo: '. Input::file('shape')->getClientOriginalName() .'!');

                return Redirect::to('admin/carga-shapes')->with('logHead', nl2br($logHead))->with('logErr', nl2br($logErr))->with('logWar', nl2br($logWar));

            }

            return Redirect::to('admin/carga-shapes')->with('error',
                'Extensión de archivo invalida en "'.Input::file('shape')->getClientOriginalName().'", Solamente se permite subir archivos con formato ZIP');

        }

        return Redirect::to('admin/carga-shapes')->with('notice',
            'Es necesario seleccionar un archivo');
    }
}