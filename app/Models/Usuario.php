<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'usuarios';
    

    public function roles()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function hasRole($role) {
        return $this->roles && $this->roles->tipo == $role;
    }

    static public function getUsuarios(){
        return self::select('usuarios.*', 'roles.tipo')
        ->join('roles', 'roles.id', '=', 'usuarios.id_rol')
        ->get();
    }

    static public function getUsuario($id) {
        return self::select('usuarios.*')
        ->where('usuarios.id', '=', $id)
        ->get();
    }
}
