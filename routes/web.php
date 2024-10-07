<?php

use App\Exports\reporteResultadosExcel;
use App\Http\Controllers\categoriasController;
use App\Http\Controllers\detalleGastosController;
use App\Http\Controllers\detalleIngresosController;
use App\Http\Controllers\empresaDatosController;
use App\Http\Controllers\escuelasController;
use App\Http\Controllers\examenConfiguracionesController;
use App\Http\Controllers\examenesController;
use App\Http\Controllers\examenVisual;
use App\Http\Controllers\expedientesController;
use App\Http\Controllers\facturasController;
use App\Http\Controllers\flujoEfectivoController;
use App\Http\Controllers\gastosController;
use App\Http\Controllers\ingresosController;
use App\Http\Controllers\licenciaTiposController;
use App\Http\Controllers\pizarraController;
use App\Http\Controllers\practicoCategoriaController;
use App\Http\Controllers\practicoPreguntasController;
use App\Http\Controllers\preguntasController;
use App\Http\Controllers\pruebaPracticaController;
use App\Http\Controllers\reporteDiarioController;
use App\Http\Controllers\reporteResultadosController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\respuestasController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\tramiteClasesController;
use App\Http\Controllers\usuariosController;
use App\Livewire\ExamenForm;
use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use App\Models\expediente;
use App\Models\ingreso;
use App\Models\practicoCategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::resource('usuarios', usuariosController::class)->middleware('auth')->middleware('rol');
Route::resource('roles', rolesController::class)->middleware('auth')->middleware('rol');
Route::resource('tramite-clases', tramiteClasesController::class)->middleware('auth')->middleware('rol');
Route::resource('licencia-tipos', licenciaTiposController::class)->middleware('auth')->middleware('rol');
Route::resource('categorias', categoriasController::class)->middleware('auth')->middleware('rol');
Route::resource('preguntas', preguntasController::class)->middleware('auth')->middleware('rol');
Route::resource('expedientes', expedientesController::class)->middleware('auth')->middleware('exp');
Route::get('expediente/{id_expediente}/show-pdf', [expedientesController::class, 'imprimirShow'])->name('expedientes.show-pdf')->middleware('auth')->middleware('exp');
Route::get('expediente/{id_expediente}/pdf', [expedientesController::class, 'generarExpedientePdf'])->name('expedientes.pdf')->middleware('auth')->middleware('exp');
Route::get('expediente/{id_expediente}/factura', [expedientesController::class, 'generarFacturaPdf'])->name('expedientes.factura')->middleware('auth')->middleware('exp');
Route::get('expediente/{id_expediente}/credito-fiscal', [expedientesController::class, 'generarCreditoFiscal'])->name('expedientes.credito-fiscal')->middleware('auth')->middleware('exp');
Route::post('expediente-usuarios/store', [expedientesController::class, 'crearUsuario'])->name('expediente-usuarios.store')->middleware('auth')->middleware('rol');
Route::resource('examenes', examenesController::class)->middleware('auth');
Route::get('examenes/{id_examen}/detallePDF', [examenesController::class, 'generarDetallePDF'])->name('examenes.detallePDF')->middleware('auth');
Route::resource('examen-configuraciones', examenConfiguracionesController::class)->middleware('auth')->middleware('rol');
Route::resource('prueba-practica', pruebaPracticaController::class)->middleware('auth')->middleware('nocliente');
Route::get('prueba-practica/{id_examen}/detallePDF', [pruebaPracticaController::class, 'generarDetallePDF'])->name('prueba-practica.detallePDF')->middleware('auth');
Route::get('/', [examenesController::class, 'dashboard'])->name('Inicio')->middleware('auth');
Route::get('examen-formulario/', [examenesController::class, 'examenForm'])->name('examenes.form')->middleware('auth');
Route::resource('empresa-datos', empresaDatosController::class)->middleware('auth')->middleware('rol');
Route::post('buscar', [examenesController::class, 'buscar'])->name('Buscar')->middleware('auth')->middleware('rol');
Route::resource('facturas', facturasController::class)->middleware('auth')->middleware('rol');
Route::resource('visuales',  examenVisual::class)->middleware('auth')->middleware('nocliente');
Route::resource('gastos', gastosController::class)->middleware('auth')->middleware('rol');
Route::resource('detalle-gastos', detalleGastosController::class)->middleware('auth')->middleware('rol');
Route::resource('reporte-diario' , reporteDiarioController::class)->middleware('auth')->middleware('rol');
Route::post('reporte-diario/buscar' , [reporteDiarioController::class , 'buscarReporte'])->middleware('auth')->middleware('rol')->name('reporte-diario/buscar');
Route::get('reporte-diario/{fecha_inicio}/{fecha_fin}/reporteExcel', [reporteDiarioController::class, 'reporteExcel'])->name('reporte-diario.reporteExcel')->middleware('auth');
Route::resource('flujo-efectivo', flujoEfectivoController::class)->middleware('auth')->middleware('rol');
Route::post('flujo-efectivo/buscar', [flujoEfectivoController::class , 'flujoEfectivo'])->name('flujo-efectivo/buscar')->middleware('auth')->middleware('rol');
Route::get('flujo-efectivo/{fecha}/reporteExcel', [flujoEfectivoController::class, 'reporteExcel'])->name('reportes-excel.flujo-efectivo')->middleware('auth');
Route::get('detalle-gastos/{fecha}/reporteExcel', [reportesController::class, 'detalleGastosExcel'])->name('reportes-excel.detalle-gastos')->middleware('auth');
Route::get('detalle-ingresos/{fecha}/{escuela}/reporteExcel', [reportesController::class, 'detalleIngresosExcel'])->name('reportes-excel.detalle-ingresos')->middleware('auth');
Route::resource('practico-categorias', practicoCategoriaController::class)->middleware('auth')->middleware('rol');
Route::resource('practico-preguntas', practicoPreguntasController::class)->middleware('auth')->middleware('rol');
Route::resource('escuelas', escuelasController::class)->middleware('auth')->middleware('rol');
Route::resource('ingresos', ingresosController::class)->middleware('auth')->middleware('rol');
Route::resource('detalle-ingresos', detalleIngresosController::class)->middleware('auth')->middleware('rol');
Route::get('reporte-ingresos', [reportesController::class, 'reporteIngresos'])->middleware('auth')->middleware('rol');
Route::get('reporte-gastos', [reportesController::class, 'reporteGastos'])->name('reporte-gastos.index')->middleware('auth')->middleware('rol');
Route::get('reporte-ingresos', [reportesController::class, 'reporteIngresos'])->name('reporte-ingresos.index')->middleware('auth')->middleware('rol');
Route::post('reporte-gastos/buscar', [reportesController::class , 'buscarGastos'])->name('reporte-gastos/buscarGastos')->middleware('auth')->middleware('rol');
Route::post('reporte-ingresos/buscar', [reportesController::class , 'buscarIngresos'])->name('reporte-ingresos/buscarIngresos')->middleware('auth')->middleware('rol');
Route::get('detalle-gastos-reporte', [reportesController::class, 'detalleGastos'])->name('detalle-gastos-reporte.index')->middleware('auth')->middleware('rol');
Route::post('detalle-gastos-reporte/buscar', [reportesController::class , 'buscarDetalleGastos'])->name('detalle-gastos-reporte/buscarDetalleGastos')->middleware('auth')->middleware('rol');
Route::get('detalle-ingresos-reporte', [reportesController::class, 'detalleIngresos'])->name('detalle-ingresos-reporte.index')->middleware('auth')->middleware('rol');
Route::post('detalle-ingresos-reporte/buscar', [reportesController::class , 'buscarDetalleIngresos'])->name('detalle-ingresos-reporte/buscarDetalleIngresos')->middleware('auth')->middleware('rol');
Route::get('detalle-ingresos/{id_detalle}/factura', [detalleIngresosController::class, 'generarFacturaPdf'])->name('detalle-ingresos.factura')->middleware('auth')->middleware('exp');
Route::get('detalle-ingresos/{id_detalle}/credito-fiscal', [detalleIngresosController::class, 'generarCreditoFiscal'])->name('detalle-ingresos.credito-fiscal')->middleware('auth')->middleware('exp');
Route::get('reportes-excel/{fecha_inicio}/{fecha_fin}/gastosExcel', [reportesController::class, 'gastosExcel'])->name('reportes-excel.gastos')->middleware('auth');
Route::get('reportes-excel/{fecha_inicio}/{fecha_fin}/ingresosExcel', [reportesController::class, 'ingresosExcel'])->name('reportes-excel.ingresos')->middleware('auth');

Route::resource('reporte-resultados', reporteResultadosController::class)->middleware('auth');
Route::post('reporte-resultados/buscar',[reporteResultadosController::class, 'buscarResultados'])->name('reporte-resultados.buscar')->middleware('auth');
Route::get('reporte-resultados/{fecha_inicio}/{fecha_fin}/{estatus}/resultadosExcel', [reporteResultadosController::class, 'resultadosExcel'])->name('reporte-excel.resultados')->middleware('auth');

Route::get('respuestas/{id_pregunta}/index',[respuestasController::class, 'index'])->name('respuestas.index')->middleware('auth')->middleware('rol');
Route::post('respuestas/{id_pregunta}/store',[respuestasController::class, 'store'])->name('respuestas.store')->middleware('auth')->middleware('rol');
Route::get('respuestas/{id_pregunta}/show/{id}',[respuestasController::class, 'show'])->name('respuestas.show')->middleware('auth')->middleware('rol');
Route::get('respuestas/{id_pregunta}/edit/{id}',[respuestasController::class, 'edit'])->name('respuestas.edit')->middleware('auth')->middleware('rol');
Route::patch('respuestas/{id_pregunta}/update/{id}',[respuestasController::class, 'update'])->name('respuestas.update')->middleware('auth')->middleware('rol');
Route::delete('respuestas/{id_pregunta}/destroy/{id}',[respuestasController::class, 'destroy'])->name('respuestas.destroy')->middleware('auth')->middleware('rol');

Route::resource('pizarra', pizarraController::class);