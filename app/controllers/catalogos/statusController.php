<?php

class catalogos_statusController extends \BaseController
{
    
    /**
     * Instancia del status
     * @var status
     */
    protected $status;
    
    public function __construct(status $status) 
    {
        $this->status = $status;
    }
    /**
     * Mostrar una lista de los recursos.
     * GET /catalagos.status
     *
     * @param string $format
     * @return Response
     */
    public function index($format = 'html')
    {   
        $status = $this->status;
        
        $title = 'Administracion de catalogo de status de ejecucion predial';
        
        //Titulo de seccion:
        $title_section = "Catalogo de Estatus de Ejecución";
        
        //Subtitulo de seccion:
        $subtitle_section = "";
        
        //Todos los status creados actulmente
        $statuss = $this->status->select('id_status as id','cve_status','descrip','dias_vigencia','orden','notificacion','dias_habiles')->orderBy('orden', 'asc')->get();
            
        return ($format == 'json') ? $statuss : View::make('catalogos.status.index',
            compact('title', 'title_section', 'subtitle_section', 'status', 'statuss'));
    }
    /**
     * Mostrar el formulario para la creación de un nuevo recurso.
     * GET /catalagos.status/create
     * 
     * @return Response
     */
    public function create()
    {
        $status = $this->status;
        
        $title = 'Adminstración de catalagos de status';
        
        //Titulo de seccion:
        $title_section = "Crear nuevo status.";
        
        //subtitulo de seccion:
        $subtitle_section = "";
        
        //Todos los status creados actualmente
        $statuss = $this->status->all();
        
        return View::make('catalogos.status.create', 
                compact('title', 'title_section','subtitle_section', 'status', 'statuss'));
    }
    
    /**
     * Guarde un recurso recién creado en el almacenamiento.
     * POST /catalagos.status
     * 
     * @param string $format
     * @return Response
     */
    public function store($format = 'html')
    {
        $inputs = Input::All();
        $notificacion=Input::get('notificacion');
        $this->status->cve_status   =   Input::get('cve_status');
        $this->status->descrip      =   Input::get('descrip');
        $this->status->fecha_alta   =   date('Y-m-d');
        $this->status->usuario_alta =   Auth::user()->id;
        $this->status->dias_vigencia =  Input::get('dias_vigencia');       
        $this->status->notificacion =   Input::get('notificacion');
        $this->status->dias_habiles =   Input::get('dias_habiles');
        $this->status->orden        =   status::all()->count()+1;



        //si no es posible guardar la instancia mandamos errores
        if (!$this->status->save()){
            if ($format == 'json'){
                return array (
                    'status' => 'error',
                    'msg' => 'Datos incorrectos',
                    'data' => array ('idx' => Input::get('idx'), 'errors' => $this->status->errors())
                );
            }
            return Redirect::back()->withErrors($this->status->errors());
        }
        if ($format == 'json'){
            return array(
                'status' => 'success',
                'msg' => 'Satus guardados',
                'data' => array('id' => $this->status->id_status, 'idx' => Input::get('idx'))
            );
        }
        //Se han guardado los valores, expresamos al usuario nuestra felicidad al respecto.
        return Redirect::to('catalogos/status/create')->with('success',
            '¡Se ha creado correctamente el status: ' . $this->status->cve_status . " !");
    }
    /**
     * Actualizar el recurso especificado en el almacenamiento.
     * PUT /catalagos.status/{id}
     *
     * @param  int $id
     * @param string $format
     * @return Response
     */
    public function update($id, $format = 'html')
    {   
        $this->status = status::find($id);
        $this->status->cve_status = Input::get('cve_status');
        $this->status->descrip = Input::get('descrip');
        $this->status->notificacion =   Input::get('notificacion');
        $this->status->dias_vigencia =  Input::get('dias_vigencia');
        $this->status->dias_habiles =   Input::get('dias_habiles');
        
        
        //si no es posible guardar la instancia mandamos errores
        if (!$this->status->save()){
            if ($format == 'json'){
                return array (
                    'status' => 'success',
                    'msg' => 'Status incorrecto',
                    'data' => array ('idx' => Input::get('idx'), 'errors' => $this->status->errors())
                );
            }
            return Redirect::back()->withErrors($this->status->errors());
        }   
        // Get validation errors (see Ardent package)
        if ($format == 'json') {
                return array(
                    'status' => 'success',
                    'msg' => 'Satuts actualizado',
                    'data' => array('id' => $this->status->id, 'idx' => Input::get('idx'))
                );
            }
            return Redirect::to('catalogos/status/'.$this->status-> id.'/edit')->with('success','¡Se ha actualizado correctamente el status: '. $this->status->cve_status . " !");
        
        
    }
    /**
     * Retire el recurso especificado de almacenamiento.
          * DELETE /adminstus/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $status = status::find($id);
        $status->delete();
        return array('status' => 'success', 'msg' => 'Status eliminado');
    }


    public function ordenStatus()
    {
        if(Request::ajax())
        {
           
        $orden = Input::get('orden');
        $id = Input::get('id');

        for($i=1;$i<count($id);$i++)
        {
            $status = status::find($id[$i]);
            $status->orden = $orden[$i];
            $status->save();
       }

        return Response::json(array(
                'prueba' => $orden,
                'prueba2'=> $id));
        }
    }
}
