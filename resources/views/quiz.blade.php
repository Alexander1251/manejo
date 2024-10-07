<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background: #001e4d;
        }

        .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            text-align: center;

            line-height: 100px;
            font-size: 20px;
            font-weight: bold;
            margin: auto;

        }




        .aprobado {
            background-color: green;
            color: white;
        }

        .reprobado {
            background-color: red;
            color: white;
        }

        .app {
            background: #fff;
            width: 90%;
            max-width: 600px;
            margin: 100px auto 0;
            border-radius: 10px;
            padding: 30px;

        }

        .app h1 {
            font-size: 25px;
            color: #001e4d;
            font-weight: 600;
            border-bottom: 1px solid #333;
            padding-bottom: 30px;
        }

        .quiz {
            padding: 20px 0;

        }

        .quiz h2 {
            font-size: 18px;
            color: #001e4d;
            font-weight: 600;

        }

        .alerta {
            background-color: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            padding: 10px;
            margin-bottom: 20px;
        }

        .btn {
            background: #fff;
            color: #222;
            font-weight: 500;
            width: 100%;
            border: 1px solid #222;
            padding: 10px;
            margin: 10px 0;
            text-align: left;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover:not([disabled]) {
            background: #001e4d;
            border: 1px solid #001e4d;
            color: #fff;
        }

        .btn:disabled {
            cursor: no-drop;
        }

        #imagen {
            text-align: center;
        }

        .img-pregunta {
            height: 100px;
            width: 100px;

        }

        .resultados {
            line-height: 1.5;
        }

        #next-btn {
            background: #001e4d;
            color: #fff;
            font-weight: 500;
            width: 150px;
            border: 0;
            padding: 10px;
            margin: 20px auto 0;
            border-radius: 4px;
            cursor: pointer;
            display: block;
        }

        .salir {
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            background: #001e4d;
            color: #fff;
            font-weight: 300;
            width: 150px;
            border: 1px white solid;
            padding: 10px;
            margin: 20px auto 0;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            text-align: center;
            transition: all 0.3s;
        }

        .salir:hover {
            background: #fff;
            color: #001e4d;
            border-color: #001e4d;

        }

        .correct {

            background: #9aeabc;
        }

        .incorrect {
            background: #ff9393;

        }

        #temporizador {
            float: right;


        }

        #total-question {
            font-size: 18px;
            color: #001e4d;
            font-weight: 600;
            float: right;

        }
    </style>
</head>

<body>
    <div class="app">

        @livewire('quiz', ['examen' => $examen, 'totalP' => $totalP, 'tiempo' => $tiempo, 'preguntas' => $preguntas])
    </div>



    <script>
        let indiceBotonSeleccionado = 0;

        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
                const botones = document.querySelectorAll('.boton-navegable');
                let siguienteIndice = indiceBotonSeleccionado + (event.key === 'ArrowDown' ? 1 : -1);
                siguienteIndice = Math.max(0, Math.min(siguienteIndice, botones.length - 1));
                botones[siguienteIndice].focus();
                indiceBotonSeleccionado = siguienteIndice;
            }
        });

       

        document.addEventListener('keydown', (event) => {
            const botones = document.querySelectorAll('button');
            const siguiente = document.getElementById('next-btn');
            const numeroBoton = event.key; // Obtiene la tecla presionada (1, 2, 3 o 4)
            const indiceBoton = numeroBoton - 1; // Calcula el índice del botón
            console.log(botones);
            
            if (indiceBoton >= 0 && indiceBoton < botones.length) {
                
                botones[indiceBoton].click();
                
              
                
            }

            if(numeroBoton == 5){
                siguiente.click();
            }
        });
    </script>

</body>

</html>
