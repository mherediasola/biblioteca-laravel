<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EjemplaresController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ApiController;

Route::get('/', [IndexController::class, 'inicio']);

//LOGGIN Y REGISTRARSE
Route::get('/login', [SesionController::class, 'mostrar'])->name('login');
Route::post('/login', [SesionController::class, 'iniciarSesion']);
Route::get('/registro', [SesionController::class, 'mostrarRegistro'])->name('formularioRegistro');
Route::post('/registro', [SesionController::class, 'registro']);

//Acceso SIN LOGIN
Route::get('/ejemplares', [EjemplaresController::class,'mostrar'])->name("ejemplares");
Route::get('/ejemplares/listar', [EjemplaresController::class,'listar'])->name("ejemplaresListar");
Route::get('/ejemplares/{id}', [EjemplaresController::class,'buscar'])->where(array('id' => '[0-9]*'))->name("buscarEjemplar");

//Acceso CON LOGIN
Route::middleware('auth')->group(function() {
    //API
    Route::get('/api/ejemplares', [ApiController::class,'mostrarEjemplares'])->name("apiEjemplares");
    Route::get('/api/ejemplares/{id}', [ApiController::class,'buscarEjemplar'])->where(array('id' => '[0-9]*'));
    //CERRAR SESIÓN
    Route::get('/logout', [SesionController::class, 'cerrarSesion'])->name('logout');
});

//ROL: ADMINISTRADOR
Route::middleware(['auth', 'role:Administrador'])->group(function (){
    //ROLES
    Route::get('/roles', [RolesController::class, 'mostrar'])->name("roles");
    Route::get('/roles/listar', [RolesController::class, 'listar'])->name("rolesListar");
    Route::get('/roles/{id}', [RolesController::class, 'buscar'])->where(array('id' => '[0-9]*'))->name("buscarRol");
    Route::get('/roles/insertar', [RolesController::class, 'formularioInsertar'])->name("insertarRoles");
    Route::post('/roles/insertar', [RolesController::class, 'insertar'])->name("crearRoles");
    Route::get('/roles/editar/{id}', [RolesController::class, 'mostrarEditar'])->where(array('id' => '[0-9]*'))->name("mostrarEditarRoles");
    Route::post('/roles/editar/{id}', [RolesController::class, 'editar'])->where(array('id' => '[0-9]*'));
    Route::delete('/roles/eliminar/{id}', [RolesController::class, 'eliminar'])->where(array('id' => '[0-9]*'))->name("eliminarRoles");

    //USUARIOS
    Route::get('/usuarios', [UsuariosController::class,'mostrar'])->name("usuarios");
    Route::get('/usuarios/listar', [UsuariosController::class,'listar'])->name("usuariosListar");
    Route::get('/usuarios/{id}', [UsuariosController::class,'buscar'])->where(array('id' => '[0-9]*'))->name("buscarUsuario");
    Route::get('/usuarios/insertar', [UsuariosController::class, 'formularioInsertar'])->name("insertarUsuarios");
    Route::post('/usuarios/insertar', [UsuariosController::class, 'insertar'])->name("crearUsuarios");
    Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'mostrarEditar'])->where(array('id' => '[0-9]*'))->name("mostrarEditarUsuarios");
    Route::post('/usuarios/editar/{id}', [UsuariosController::class, 'editar'])->where(array('id' => '[0-9]*'));
    Route::delete('/usuarios/eliminar/{id}', [UsuariosController::class, 'eliminar'])->where(array('id' => '[0-9]*'))->name("eliminarUsuarios");

    //DASHBOARD
    Route::get('/dashboard', [prestamosController::class, 'dashboard'])->name('dashboard');
});

//ROL:ESTUDIANTE E INVESTIGADOR
Route::middleware(['auth', 'role:Estudiante,Investigador'])->group(function (){
    Route::get('/prestamos/misprestamos/', [PrestamosController::class,'mostrarMisPrestamos'])->name('misPrestamos');
});

Route::middleware(['auth', 'role:Bibliotecario,Administrador'])->group(function (){    
    //EJEMPLARES
    Route::get('/ejemplares/insertar', [EjemplaresController::class, 'formularioInsertar'])->name("insertarEjemplares");
    Route::post('/ejemplares/insertar', [EjemplaresController::class, 'insertar'])->name("crearEjemplares");
    Route::get('/ejemplares/editar/{id}', [EjemplaresController::class, 'mostrarEditar'])->where(array('id' => '[0-9]*'))->name("mostrarEditarEjemplares");
    Route::post('/ejemplares/editar/{id}', [EjemplaresController::class, 'editar'])->where(array('id' => '[0-9]*'));
    Route::delete('/ejemplares/eliminar/{id}', [EjemplaresController::class, 'eliminar'])->where(array('id' => '[0-9]*'))->name("eliminarEjemplares");

    //PRÉSTAMOS
    Route::get('/prestamos', [PrestamosController::class,'mostrar'])->name("prestamos");
    Route::get('/prestamos/listar', [PrestamosController::class,'listar'])->name("prestamosListar");
    //muestra los préstamos según el id del préstamo:
    Route::get('/prestamos/{id}', [PrestamosController::class,'buscarPrestamoId'])->where(array('id' => '[0-9]*'))->name("buscarPrestamo");
    //muestra los préstamos según el id del usuario:
    Route::get('/prestamos/usuario/{id}', [PrestamosController::class,'buscarPrestamoIdUsuario'])->where(array('id' => '[0-9]*'))->name("buscarPrestamoUsuario");
    Route::get('/prestamos/insertar', [PrestamosController::class, 'formularioInsertar'])->name("insertarPrestamos");
    Route::post('/prestamos/insertar', [PrestamosController::class, 'insertar'])->name("crearPrestamos");
    Route::get('/prestamos/editar/{id}', [PrestamosController::class, 'mostrarEditar'])->where(array('id' => '[0-9]*'))->name("mostrarEditarPrestamos");
    Route::post('/prestamos/editar/{id}', [PrestamosController::class, 'editar'])->where(array('id' => '[0-9]*'));
    Route::delete('/prestamos/eliminar/{id}', [PrestamosController::class, 'eliminar'])->where(array('id' => '[0-9]*'))->name("eliminarPrestamos");

    //API
    Route::get('/api/prestamos', [ApiController::class,'mostrarPrestamos'])->name("apiPrestamos");
    //muestra los préstamos según el id del préstamo:
    Route::get('/api/prestamos/{id}', [ApiController::class,'buscarPrestamoId'])->where(array('id' => '[0-9]*'));
    //muestra los préstamos según el id del usuario:
    Route::get('/api/prestamos/usuario/{id}', [ApiController::class,'buscarPrestamoIdUsuario'])->where(array('id' => '[0-9]*'));
});

