<?php

Route::group(['before' => 'Complementarios'], function() {

    //instalaciones especiales
    Route::get("complementarios/{id?}", "complementarios_ComplementariosController@index");
    Route::get("compleme/{id?}", "complementarios_ComplementariosController@index");
    //Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getPredio");
    Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getInstalacion");
    Route::post("guardar-predios", "complementarios_ComplementariosController@postPredio");

    Route::get("cargar-complementos-editar/{id?}", "complementarios_ComplementariosController@getCargar");
    Route::post("cargar-complementos-editar/{id?}", "complementarios_ComplementariosController@getEditar");
    Route::get("cargar-complementose/{id?}", "complementarios_ComplementariosController@getEliminar");
    Route::get("agregar/{id?}", "complementarios_ComplementariosController@getAgregar");
    Route::post("/agregar", "complementarios_ComplementariosController@post_agregar");
    Route::post("eliminar-inst", "complementarios_ComplementariosController@eliminar_instalacion");
    //construcciones
    Route::post("guardar-construccion", "complementarios_ComplementariosController@postConstruccion");
    Route::get("cargar-construccion", "complementarios_ComplementariosController@getConstruccion");
    Route::post("eliminar-construccion", "complementarios_ComplementariosController@eliminarConstruccion");
    Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getConstruccion");
    Route::get('/complementos-editar/{id?}', "complementarios_ComplementariosController@getCargarconstruccion");
    Route::post('/complementos-editar/{id?}', "complementarios_ComplementariosController@getEditarConstruccionConstruccion");
    Route::get('/cargar-complementos-eliminar/{id?}', "complementarios_ComplementariosController@getEliminarConstruccion");
    Route::get('/agregar-construccion/{id?}', "complementarios_ComplementariosController@getAgregarConstruccion");
    Route::post('/agregar-construccion/{id?}', "complementarios_ComplementariosController@post_AgregarAgregarConstruccion");
    //techos
    Route::get('/cargar-complementos/agregar-techos/{id?}', "complementarios_ComplementariosController@getAgregarTechos");
    Route::post('/cargar-complementos/agregar-techos/{id?}', "complementarios_ComplementariosController@postAgregarTechos");
    Route::get('/cargar-complementos/eliminar-techos/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarTechos");
    //muros
    Route::get('/cargar-complementos/agregar-muros/{id?}', "complementarios_ComplementariosController@getAgregarMuros");
    Route::post('/cargar-complementos/agregar-muros/{id?}', "complementarios_ComplementariosController@postAgregarMuros");
    Route::get('/cargar-complementos/eliminar-muros/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarMuros");
    //clase construccion
    Route::get('/cargar-complementos/agregar-clase-construccion/{id?}', "complementarios_ComplementariosController@getAgregarClaseConstruccion");
    Route::post('/cargar-complementos/agregar-clase-construccion/{id?}', "complementarios_ComplementariosController@postAgregarClaseConstruccion");
    Route::get('/cargar-complementos/eliminar-clase-construccion/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarClases");
    //ventanas
    Route::get('/cargar-complementos/agregar-ventanas/{id?}', "complementarios_ComplementariosController@getAgregarVentanas");
    Route::post('/cargar-complementos/agregar-ventanas/{id?}', "complementarios_ComplementariosController@postAgregarVentanas");
    Route::get('/cargar-complementos/eliminar-ventanas/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarVentanas");
    //condominios
    Route::get('/cargar-complementos/{id?}', "complementarios_ComplementariosController@getInstalacion");
    Route::get('/agregar-condominio/{id?}', "complementarios_ComplementariosController@getAgregarCondominio");
    Route::post('/agregar-condominio/{id?}', "complementarios_ComplementariosController@post_addcondominio");
    Route::post('/cargar-condominio-destroy/{id?}', 'complementarios_ComplementariosController@getEliminarCondominio');
    Route::post('/cargar-condominio/{id_condominio?}', 'complementarios_ComplementariosController@getEditarCondominio');
    Route::post('/cargar-condominio-editar/{id?}', 'complementarios_ComplementariosController@getCondominio');
    //servicio
    Route::get('/agregar-servicios/{id?}', 'complementarios_ComplementariosController@get_servicios');
    Route::post('/cargar-servicios/{id?}', 'complementarios_ComplementariosController@post_agregarservicio');

    //Giros
    Route::get('/cargar-complementos/agregar-giros/{id?}', 'complementarios_ComplementariosController@get_giros');
    Route::post('/cargar-complementos/guardar-giros/{id?}', 'complementarios_ComplementariosController@post_agregargiros');
    //Puertas
    Route::get('/cargar-complementos/agregar-puertas/{id?}', "complementarios_ComplementariosController@getMostrarPuertas");
    Route::post('/cargar-complementos/agregar-puertas/{id?}', "complementarios_ComplementariosController@postAgregarPuertas");
    Route::get('/cargar-complementos/eliminar-puertas/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarPuertas");
    //Pisos
    Route::get('/cargar-complementos/agregar-pisos/{id?}', "complementarios_ComplementariosController@getMostrarPisos");
    Route::post('/cargar-complementos/agregar-pisos/{id?}', "complementarios_ComplementariosController@postAgregarPisos");
    Route::get('/cargar-complementos/eliminar-pisos/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarPisos");

    //Cargado de archivos
    Route::get('/cargarArchivo', 'complementarios_CargarController@index');
    Route::post('/guardar-anexo', 'complementarios_ComplementariosController@guardar_anexo');
    Route::delete('/eliminar-anexo/{id}', 'complementarios_ComplementariosController@eliminar_anexo');
    
    
    //Persona entrevistada
    Route::get('personas', 'complementarios_ComplementariosController@personasEntrevistada');
    Route::get('autocomplete', 'complementarios_ComplementariosController@autocomplete');
    //
    Route::get('personas/p', 'complementarios_ComplementariosController@getPersonas');
    Route::post('personas/p', "complementarios_ComplementariosController@postPersonas");
    
    Route::get('personas/p2', 'complementarios_ComplementariosController@getPersonas2');
    Route::post('personas/p2', "complementarios_ComplementariosController@postPersonas");
    
    
    Route::post("guardar-entrevista", "complementarios_ComplementariosController@postEntrevista");
    Route::post("guardar-personas", "complementarios_ComplementariosController@postPersonas");
    //tomasAguat
     Route::post("guardar-agua", "complementarios_ComplementariosController@postAgua");
});

 Route::filter('Complementarios', function () {

    if (! ( Entrust::hasRole('Complementarios') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});