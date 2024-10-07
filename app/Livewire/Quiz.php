<?php

namespace App\Livewire;

use App\Models\detalleExamen;
use App\Models\examen;
use App\Models\examenConfiguracion;
use App\Models\expediente;
use App\Models\pregunta;
use App\Models\respuesta;
use DateTime;
use Livewire\Component;

class Quiz extends Component
{

    public $examen;
    public $totalP;
    public $preguntas;
   
    public $tiempo;
    public $preguntaActual = 1;
    public $id_respuesta;
    public $id_pregunta;
    public $numero_correctas = 0;
    public $calificacion = 0;
    public $estadoPrueba;
    public $temporizador;
    


    public function mount($examen, $totalP, $tiempo, $preguntas)
    {
       

        $this->examen = $examen;
        $this->totalP = $totalP;
        $this->tiempo = $tiempo;
        $this->preguntas = $preguntas;
       
        $this->preguntaActual = 1;
        $this->temporizador = $tiempo*60;
        
    }

    public function render()
    {
        return view('livewire.quiz');
    }

   

    public function incrementar()
    { 
        if($this->id_respuesta == 0){
           
            $this->addError('respuesta', 'Debes seleccionar una respuesta');
            return;
        }else{
            $this->preguntaActual++;
            if ($this->preguntaActual <= ($this->totalP + 1)) {
    
                
                $detalle = new detalleExamen();
                $configuracion = examenConfiguracion::all()->first();
                $detalle->id_examen = $this->examen->id;
                $pregunta = pregunta::find($this->id_pregunta);
                $respuesta = respuesta::find($this->id_respuesta);
                $detalle->id_pregunta = $pregunta->id;
                $detalle->id_respuesta = $respuesta->id;
                $detalle->id_respuesta_correcta = respuesta::where('id_pregunta', $pregunta->id)->where('validez', 'Correcta')->first()->id;
                $detalle->save();
                $examen = examen::find($this->examen->id);
                if ($detalle->id_respuesta == $detalle->id_respuesta_correcta) {
                    $this->numero_correctas++;
                }
                $examen->calificacion = ($this->numero_correctas / $this->totalP) * 10;
                $examen->total_respuestas_correctas = $this->numero_correctas;
                if($this->preguntaActual == $this->totalP){
                    $examen->estado = 'Finalizado';
                }
               
                $tiempo1 = new DateTime('00:'.floor($this->temporizador/60).':'.str_pad($this->temporizador % 60,2,'0',  STR_PAD_LEFT));
                $tiempo2 = new DateTime('00:'.$this->tiempo.':00');
                $tiempototal = $tiempo1->diff($tiempo2);
                $examen->tiempo = $tiempototal->format('%i minutos %s segundos');
                $examen->save();
                $expediente = expediente::where('estado', 'Activo')->where('id_cliente', auth()->user()->id)->first();
                if($examen->calificacion >= $configuracion->nota_aprobada){
                    $this->estadoPrueba = 'Aprobada';
                    $expediente->estado_examen_teorico = 'Aprobado';
                }
                else{
                    $this->estadoPrueba = 'Reprobada';
                    $expediente->estado_examen_teorico = 'Reprobado';
                }

                $expediente->save();

                
                
    
                
    
                $this->calificacion = $examen->calificacion;
                $this->id_respuesta = 0;
                $this->id_pregunta = 0;
    
                
            } 
        }
       
    }

    public function guardarRespuesta($id_respuesta, $id_pregunta)
    {
     
        $this->id_respuesta = $id_respuesta;
        $this->id_pregunta = $id_pregunta;
       
    }
    public function actualizarTiempo(){
       
        if($this->preguntaActual > $this->totalP){

        }
        else{

            if ($this->temporizador > 0) {
                $this->temporizador--;
            } else {
                $this->preguntaActual = $this->totalP + 1;
                $examen = examen::find($this->examen->id);
                $examen->estado = 'Finalizado';
                $examen->save();
            }

        }
       
    }

    
}
