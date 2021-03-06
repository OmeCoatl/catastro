<?php

class AefConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_construcciones';
	protected $primaryKey = 'idaefconstruccion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefConstruccionesByFk($idavaluoenfoquefisico) {
		return AefConstrucciones::select('*')
						->leftjoin('cat_tipo', 'aef_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefconstruccion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefConstrucciones($inputs, &$total_metros_construccion, &$valor_construccion, &$total_valor_fisico) {
		$rowAefConstrucciones = new AefConstrucciones();
		$rowAefConstrucciones->idavaluoenfoquefisico = $inputs["idavaluoenfoquefisico2"];
		$rowAefConstrucciones->created_at = $inputs["created_at"];

		AefConstrucciones::setAefConstrucciones($rowAefConstrucciones, $inputs);
		$rowAefConstrucciones->save();
		$rowAef = AvaluosFisico::find($rowAefConstrucciones->idavaluoenfoquefisico);
		$total_metros_construccion = $rowAef->total_metros_construccion;
		$valor_construccion = $rowAef->valor_construccion;
		$total_valor_fisico = $rowAef->total_valor_fisico;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefConstrucciones($inputs, &$total_metros_construccion, &$valor_construccion, &$total_valor_fisico) {
		$rowAefConstrucciones = AefConstrucciones::find($inputs["idaefconstruccion"]);
		$rowAefConstrucciones->updated_at = $inputs["updated_at"];
		AefConstrucciones::setAefConstrucciones($rowAefConstrucciones, $inputs);
		$rowAefConstrucciones->save();
		$rowAef = AvaluosFisico::find($rowAefConstrucciones->idavaluoenfoquefisico);
		$total_metros_construccion = $rowAef->total_metros_construccion;
		$valor_construccion = $rowAef->valor_construccion;
		$total_valor_fisico = $rowAef->total_valor_fisico;
		
	}
	
	public static function setAefConstrucciones(&$rowAefConstrucciones, $inputs) {
		$rowAefConstrucciones->idtipo = $inputs["idtipo"];
		$rowAefConstrucciones->edad = $inputs["edad_construcciones"];
		$rowAefConstrucciones->valor_nuevo = $inputs["valor_nuevo_construcciones"];
		$rowAefConstrucciones->factor_edad = $inputs["factor_edad_construcciones"];
		$rowAefConstrucciones->fk_conservacion = $inputs["idfactorconservacion"];
		$rowAefConstrucciones->factor_conservacion = $inputs["factor_conservacion_construcciones"];
	}

	public static function getAjaxAefConstruccionesByFk($fk) {
		$pato = array();
		$rows = AefConstrucciones::select(
		'aef_construcciones.idaefconstruccion', 
		'cat_tipo.tipo',
		'aef_construcciones.edad',
		'aef_construcciones.superficie_m2',
		'aef_construcciones.valor_nuevo',
		'aef_construcciones.factor_edad',
		'aef_construcciones.factor_conservacion',
		'aef_construcciones.factor_resultante',
		'aef_construcciones.valor_neto',
		'aef_construcciones.valor_parcial_construccion')
						->leftJoin('cat_tipo', 'aef_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('aef_construcciones.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_construcciones.idaefconstruccion')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefconstruccion'], 
				$row['tipo'], 
				$row['edad'], 
				$row['superficie_m2'], 
				$row['valor_nuevo'], 
				$row['factor_edad'], 
				$row['factor_conservacion'], 
				$row['factor_resultante'], 
				$row['valor_neto'], 
				$row['valor_parcial_construccion'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefConstrucciones('.$row['idaefconstruccion'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefConstrucciones('.$row['idaefconstruccion'].');"><i class="glyphicon glyphicon-remove"></i></a>');
		 }
		$res = array(
			"draw" => 1,
			"recordsTotal" => $count,
			"recordsFiltered" => $count,
			"data" => $pato
		);
		return $res;
	}

}
