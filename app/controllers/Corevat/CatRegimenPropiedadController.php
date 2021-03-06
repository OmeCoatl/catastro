<?php

class corevat_CatRegimenPropiedadController extends \BaseController {

	protected $catalogo;

	/**
	 * Instancia del catalogo de aplanados [COREVAT]
	 * @var Catalogo de aplanados [COREVAT]
	 */
	public function __construct(CatRegimenPropiedad $catalogo) {
		$this->catalogo = $catalogo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($format = 'html') {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Regimen Propiedad';
		$titleGrid = 'Catálogo de Regimen Propiedad';
		$row = $this->catalogo;
		$rows = CatRegimenPropiedad::orderBy('regimen_propiedad')->get();
		return ($format == 'json') ? $rows : View::make('CorevatCatalogos.CatRegimenPropiedad.index', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Regimen Propiedad';
		$titleGrid = 'Catálogo de Regimen Propiedad';
		$row = $this->catalogo;
		$row->status_regimen_propiedad = 1;
		$rows = CatRegimenPropiedad::orderBy('regimen_propiedad')->get();
		return View::make('CorevatCatalogos.CatRegimenPropiedad.create', compact('title', 'title_section', 'row', 'rows', 'titleGrid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($format = 'html') {
		$id=Input::get('id');
		$inputs = Input::All();
		$rules = array(
			'regimen_propiedad' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		}  else {
			$row = new CatRegimenPropiedad;
			$row->regimen_propiedad = $inputs["regimen_propiedad"];
			$row->status_regimen_propiedad = isset($inputs["status_regimen_propiedad"]) ? $inputs["status_regimen_propiedad"] : 0;
			$row->idemp = 1;
			$row->ip = $_SERVER['REMOTE_ADDR'];
			$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
			$row->creado_por = 1;
			$row->creado_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatRegimenPropiedad/create')->with('success', '¡Se ha creado correctamente el registro!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$title = 'COREVAT';
		$title_section = 'Catálogo de Regimen Propiedad';
		$titleGrid = 'Catálogo de Regimen Propiedad';
		$row = CatRegimenPropiedad::find($id);
		$rows = CatRegimenPropiedad::orderBy('regimen_propiedad')->get();
		$id = $row->idregimenpropiedad;
		return View::make('CorevatCatalogos.CatRegimenPropiedad.edit', compact('title', 'title_section', 'row', 'rows', 'id', 'titleGrid'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $format = 'html') {
		$inputs = Input::All();
		$row = CatRegimenPropiedad::find($id);
		$rules = array(
			'regimen_propiedad' => 'required',
		);
		$messages = array(
			'required' => 'El campo es requerido',
		);
		$validate = Validator::make($inputs, $rules, $messages);
		if ($validate->fails()) {
			return Redirect::back()->withInput()->withErrors($validate);
		} else {
			$row->regimen_propiedad = $inputs["regimen_propiedad"];
			$row->status_regimen_propiedad = isset($inputs["status_regimen_propiedad"]) ? $inputs["status_regimen_propiedad"] : 0;
			$row->modi_por = 1;
			$row->modi_el = date('Y-m-d H:i:s');
			$row->save();
			return Redirect::to('corevat/CatRegimenPropiedad/' . $id . '/edit')->with('success', '¡La modificación se efectuo correctamente!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null) {
        $row = CatRegimenPropiedad::findOrFail($id);
		try {
	        $row->delete($id);
			return Redirect::to('corevat/CatRegimenPropiedad')->with('success', '¡La eliminación se efectuo correctamente!');
		} catch (\Illuminate\Database\QueryException $ex) {
			return Redirect::back()->with('error', $ex->getMessage());
		}
        
	}

}
