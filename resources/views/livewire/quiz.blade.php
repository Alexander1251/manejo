<div>

    <form wire:submit.prevent="examen-formulario">
        <input type="hidden" id = "id_examen" value="{{ $examen->id }}">

        <input type="hidden" id="tiempo" value="{{ $tiempo }}">
        <input type="hidden" id="total-P" value="{{ $totalP }}">
        <h1>Prueba teórica <span wire:poll.1s="actualizarTiempo" id="temporizador">
                @if ($preguntaActual <= $totalP)
                    {{ floor($temporizador / 60) }}:{{ str_pad($temporizador % 60, 2, '0', STR_PAD_LEFT) }}
                @endif
            </span></h1>
        <div class="quiz">

            @foreach ($preguntas as $pregunta)
                @if ($preguntaActual == $loop->iteration)
                    @if ($errors->any())
                        <div class="alerta" id="alerta">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 id="question">{{ $pregunta->pregunta }}</h2>
                    @if (isset($pregunta->imagen))
                        <div id="imagen">
                            <img class="img-pregunta" src="{{ asset('imgPreguntas/' . $pregunta->imagen) }}"
                                alt="">
                        </div>
                    @endif

                    @foreach ($pregunta->respuestas as $respuesta)
                        <div id="answer-buttons">
                            <button  wire:click ="guardarRespuesta({{ $respuesta->id }}, {{ $respuesta->id_pregunta }})"
                                @if ($id_respuesta == $respuesta->id) style = "background: #8E8E8E; color: #fff; border: 1px solid  #8E8E8E; " @endif
                                class="btn boton-navegable">{{ $respuesta->respuesta }}</button>
                        </div>
                    @endforeach
                    <div>
                        <br>
                        <span id = "total-question">{{ $loop->iteration }}/{{ $totalP }}</span>
                    </div>
                @endif
            @endforeach

            @if ($preguntaActual <= $totalP)
                <input type="hidden" wire:model="id_respuesta">
                <input type="hidden" wire:model="id_pregunta">



                <button id="next-btn" class="boton-navegable" type="submit" wire:click="incrementar()">Siguiente</button>
            @else
                <div class="resultados">

                    <h2 id="question">Resultados:</h2>
                    <p>Total de preguntas: {{ $totalP }}</p>
                    <p>Total de preguntas correctas: {{ $numero_correctas }}</p>
                    <p>Calificación: {{ $calificacion }}</p>
                    <p>Estado de la prueba: {{ $estadoPrueba }}</p>



                    <br>
                    <div class="nota" style="display: grid">
                        <div class="circle {{ $estadoPrueba == 'Aprobada' ? 'aprobado' : 'reprobado' }}">
                            {{ number_format($calificacion, 2) }}
                        </div>
                    </div>

                    <a href="{{ route('Inicio') }}" class="salir boton-navegable">Salir</a>



                </div>
            @endif
        </div>

    </form>




</div>
