<?php

namespace Observers;

use ActividadesSistema;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserObserver
 * Observer para escuchar los eventos de actualización y edición de un usuario
 */
class UserObserver {
    /**
     * @var  Variable para guardar el modelo antes de realizar actualizaciones
     */
    private $vigenteBeforeUpdate;

    /**
     * Función para observar el evento created del modelo del usuario, este es el evento que
     * ocurre una vez que se ha creado el usuario
     *
     * @param $model
     * @return boolean
     */
    public function created($model){
        // Se crea un registro de usuario creado en la tabla de Actividades del sistema
        $activiadad = new ActividadesSistema;
        $activiadad->user_id = Auth::getUser()->id;
        $activiadad->modulo = 'User';
        $activiadad->actividad = 'Nuevo usuario';
        $activiadad->pk_afectada = $model->id;
        if( !$activiadad->save() ){
            return false;
        }
        return true;
    }
    /**
     * Función para observar el evento update del modelo del usuario, este evento
     * ocurre cuando se ha actualizado un usuario
     *
     * @param $model
     */
    public function updated($model){
        // Se crea un registro de usuario actualizado en la tabla de Actividades del sistema
        $activiadad = new ActividadesSistema;
        $activiadad->user_id = Auth::getUser()->id;
        $activiadad->modulo = 'User';
        $activiadad->pk_afectada = $model->id;
        $activiadad->actividad = 'Modificación de usuario';
        if( !$activiadad->save() ){
            return false;
        }
        return true;
    }
}