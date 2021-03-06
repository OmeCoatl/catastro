<?php

//Declaramos un grupo para aplicar las mismas reglas filtro 'admin'
//@see app/filters.php
Route::group(array('before' => 'admin'), function () {

    // Rutas para el administrador de usuarios
    Route::post('admin/user.{format}',
        array('as' => 'storeUser', 'uses' => 'AdminUserController@store'));
    Route::get('admin/user.{format}',
        array('as' => 'indexUser', 'uses' => 'AdminUserController@index'));
    Route::get('admin/users',
        array('as' => 'getUsers', 'uses' => 'AdminUserController@all'));
    Route::put('admin/user/{user}.{format}',
        array('as' => 'updateUser', 'uses' => 'AdminUserController@update'));
    Route::put('admin/user/{user}/active',
        array('as' => 'activeUseer', 'uses' => 'AdminUserController@active'));
    Route::resource('admin/user', 'AdminUserController');

    // Rutas para el administrador de permisos del sistema
    Route::post('admin/permission.{format}',
        array('as' => 'storePermission', 'uses' => 'AdminPermissionsController@store'));
    Route::get('admin/permission.{format}',
        array('as' => 'indexPermission', 'uses' => 'AdminPermissionsController@index'));
    Route::put('admin/permission/{permission}.{format}',
        array('as' => 'updatePermission', 'uses' => 'AdminPermissionsController@update'));
    Route::resource('admin/permission', 'AdminPermissionsController');

    // Rutas para el administrador de roles del sistema
    Route::resource('admin/role', 'AdminRolesController');

});