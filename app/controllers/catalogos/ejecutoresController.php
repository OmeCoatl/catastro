<?php

class catalogos_ejecutoresController extends \BaseController {

    /**
     * Instancia del status
     * @var ejecutores
     * @var personas
     */
    protected $ejecutores;
    protected $personas;

    public function __construct(ejecutores $ejecutores, personas $personas) {
        $this->ejecutores = $ejecutores;
        $this->personas = $personas;
    }
    /*
     * INDEX DE EJECUTORES
     */
    public function index($format = 'html', $id = null) 
    {
        $ejecutores = $this->ejecutores;
        
        $title = 'Administracion de catalogo del personal de ejecuci&oacute;n fiscal';

        //Titulo de seccion:
        $title_section = "Administracion del personal de ejecuci&oacute;n fiscal";

        //Subtitulo de seccion:
        $subtitle_section = "Crear, modificar y eliminar de ejeci&oacute;n fiscal";

        //Todos los status creados actulmente
        
        
        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'id_ejecutor', 'personas.nombrec', 'cargo', 'titulo', 'f_nombramiento', 'p.nombrec as nombre')
                ->get();
        
        return ($format == 'json') ? $ejecutoress : View::make('catalogos.ejecutores.index', 
            compact('title', 'title_section', 'subtitle_section', 'ejecutores', 'ejecutoress'));
    }
    /*
     * CONTROLADOR DONDE CREA UN NUEVO EJECUTOR
     */
    public function create()
    {
    $ejecutores = $this->ejecutores;
        
        $title = 'Adminstraci�n de catalago del personal de ejecuci&oacute;n fiscal';
        
        //Titulo de seccion:
        $title_section = "Crear nuevo personal de ejecuci&oacute;n fiscal.";
        
        //subtitulo de seccion:
        $subtitle_section = "";
        
        //Todos los status creados actualmente
        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'id_ejecutor', 'personas.nombrec', 'cargo', 'titulo', 'f_nombramiento', 'p.nombrec as nombre')
                ->get();
        
         //$personas = personas::take(43000)->skip(43000)->get();
        //print_r($personas);
        return View::make('catalogos.ejecutores.create', 
            compact('title', 'title_section','subtitle_section', 'ejecutores', 'ejecutoress','personas'));    
    }
    /*
     * CONTROLADRO DONDE GURADA A LOS EJECUTORES
     */
    public function store($format = 'html')
    {  
      $inputs = Input::All();
      //Reglas
      $reglas = array(
          'id_p' => 'required',
          'cargo' => 'required',
          'titulo'=>'required',
          'f_nombramiento'=>'required',
          'id_p_otorga_nombramiento'=>'required',
      );
      //Mensaje
      $mensajes = array(
            "required" => "Campo requerido",
      );
      //valida
      $validar = Validator::make($inputs, $reglas, $mensajes);
      //en caso no pase la validacion
      if ($validar->fails()) {
          return Redirect::back()->withErrors($validar);
          } else {
              $n = new ejecutores;
              $n-> id_p = $inputs["id_p"];
              $n-> cargo = $inputs["cargo"];
              $n-> titulo = $inputs["titulo"];
              $n-> f_nombramiento = $inputs["f_nombramiento"];
              $n-> id_p_otorga_nombramiento = $inputs["id_p_otorga_nombramiento"];
              $n->save();
              //Se han guardado los valores
              return Redirect::to('catalogos/ejecutores/create')->with('success',
            '¡Se ha creado correctamente el ejecutor' . " !");
        }
    }
    /*
     * CONTROLADOR PARA EDITAR LOS EJECUTORES
     */
    public function edit($id)
    {
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $ejecutores = ejecutores::find($id);

        $this->ejecutores = $ejecutores;

        $title = 'Administración de catálogo de ejecutores';

        //Título de sección:
        $title_section = "Editar ejecutor: ";

        //Subtítulo de sección:
        $subtitle_section = $this->ejecutores->ejecutores;

        // Todos los permisos creados actualmente
        $ejecutoress = $this->ejecutores->join('personas', 'personas.id_p', '=', 'ejecutores.id_p')
                ->join('personas as p', 'p.id_p', '=', 'ejecutores.id_p_otorga_nombramiento')
                ->select('id_ejecutor', 'id_ejecutor', 'personas.nombrec', 'cargo', 'titulo', 'f_nombramiento', 'p.nombrec as nombre')
                ->get();
        //ID del permiso
        $id = $ejecutores->id;
        return View::make('catalogos.ejecutores.edit',
            compact('title', 'title_section', 'subtitle_section', 'ejecutores', 'ejecutoress', 'id'));

    }
    /*
     * CONTROLADOR DONDE SE ACTUALIZA LOS EJECUTORES
     */
     public function update($id, $format = 'html')
    {
         $inputs = Input::All();
         $n = ejecutores::find($id);
         $n-> id_p = $inputs["id_p"];
         $n-> cargo = $inputs["cargo"];
         $n-> titulo = $inputs["titulo"];
         $n-> f_nombramiento = $inputs["f_nombramiento"];
         $n-> id_p_otorga_nombramiento = $inputs["id_p_otorga_nombramiento"];
         $mostrar=$inputs["id_p"];
         $n->save();
         //Se han actualizado los valores expresamos la felicidad que se logro Wiiiii....
         return Redirect::to('catalogos/ejecutores/' . $id . '/edit')->with('success',
            '¡Se ha actualizado correctamente el ejecutor: ' . $mostrar . " !");
    }
    /*
     * DONDE ELIMINA LOS EJECUTORES
     */
    public function destroy($id = null)
    {
        $ejecutores = ejecutores::find($id);
        $ejecutores -> delete();
        return Redirect::to('catalogos/ejecutores')->with('success',
            '¡Se ha eliminado correctamente el ejecutor'." !");
    }
    /*
     * AUTOCOMPLETAR DE LA TABLA PERSONAS 
     */
    public function autocomplete() 
    {
        $term = Input::get('term');
        //ARRAY DONDE CARGA LOS DATOS
        $results = array();
        //CONSULTA A LA TABLA PERSONAS
        $queries = DB::table('personas')
                        ->where('nombres', 'LIKE', '%' . $term . '%')
                        ->orWhere('apellido_paterno', 'LIKE', '%' . $term . '%')
                        ->orWhere('apellido_materno', 'LIKE', '%' . $term . '%')
                        ->take(5)->get();
        //DONDE LLAMA LOS DATOS Y LOS PASA A LAS VARIABLES CORRESPONDIENTES
        foreach ($queries as $query) 
        {
            //ARRAY DONDE CARGA LOS DATOS
            $results[] = [ 'id_p' => $query->id_p, 'value' => $query->nombres . ' ' . $query->apellido_paterno . ' ' . $query->apellido_materno];
        }
        if ($results) 
        {
            //SI EXITE LA PERSONA
            return Response::json($results);
        } 
        else 
        {
            //SI NO EXITE LA PAERSONA
            $mensaje[] = ['value' => ('No exite la persona')];
            return Response::json($mensaje);
        }
    }

}