<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pizarra</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .main-container {
            background-color: rgb(113, 128, 212);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        canvas {
            background-color: transparent;
            position: absolute;
            top: 0;
            left: 0;
            width: 900px;
            height: 900px;
        }

        .imagen {}
    </style>
</head>

<body>
    <main class="main-container">
        <img class="imagen"
            src="https://0.academia-photos.com/attachment_thumbnails/56217563/mini_magick20190112-3304-1a2vp4j.png?1547348660"
            alt="">
        <canvas id="main-canvas" width="900" height="900"></canvas>
    </main>

    <button class="guardar">Guardar cambios</button>
    <button id="borrar">Borrar</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('fabric.min.js') }}"></script>

    <script>
        //Guardar el elemento y el contexto
        const mainCanvas = document.getElementById("main-canvas");
        const context = mainCanvas.getContext("2d");



        let initialX;
        let initialY;
        let correccionX = 0;
        let correccionY = 0;


        let posicion = mainCanvas.getBoundingClientRect();
        correccionX = posicion.x;
        correccionY = posicion.y;

        const dibujar = (cursorX, cursorY) => {
            context.beginPath();
            context.moveTo(initialX, initialY);
            context.lineWidth = 1;
            context.strokeStyle = "#000";
            context.lineCap = "round";
            context.lineJoin = "round";
            context.lineTo(cursorX, cursorY);
            context.stroke();

            initialX = cursorX;
            initialY = cursorY;
        };

        const mouseDown = (evt) => {
            if (evt.button !== 0) return;
            evt.preventDefault();
            if (evt.changedTouches === undefined) {
                initialX = evt.offsetX;
                initialY = evt.offsetY;
            } else {
                //evita desfase al dibujar
                initialX = evt.changedTouches[0].pageX - correccionX;
                initialY = evt.changedTouches[0].pageY - correccionY;
            }
            dibujar(initialX, initialY);
            mainCanvas.addEventListener("mousemove", mouseMoving);
            mainCanvas.addEventListener('touchmove', mouseMoving);
        };

        const mouseMoving = (evt) => {
            evt.preventDefault();
            if (evt.changedTouches === undefined) {
                dibujar(evt.offsetX, evt.offsetY);
            } else {
                dibujar(evt.changedTouches[0].pageX - correccionX, evt.changedTouches[0].pageY - correccionY);
            }
        };

        const mouseUp = () => {
            mainCanvas.removeEventListener("mousemove", mouseMoving);
            mainCanvas.removeEventListener("touchmove", mouseMoving);
        };

        mainCanvas.addEventListener("mousedown", mouseDown);
        mainCanvas.addEventListener("mouseup", mouseUp);

        //pantallas tactiles
        mainCanvas.addEventListener('touchstart', mouseDown);
        mainCanvas.addEventListener('touchend', mouseUp);

        

        const canvas = document.getElementById('main-canvas');
        const ctx = canvas.getContext('2d');

        let isDrawing = false;
        let rectangle = {};
        let rectangles = [];

        canvas.addEventListener('mousedown', (e) => {
            if (e.button === 2) {
                isDrawing = true;
                rectangle = {
                    startX: e.clientX - canvas.offsetLeft,
                    startY: e.clientY - canvas.offsetTop,
                    text: ''
                };
            }
        });

        canvas.addEventListener('mousemove', (e) => {
            if (isDrawing) {
                rectangle.w = e.clientX - canvas.offsetLeft - rectangle.startX;
                rectangle.h = e.clientY - canvas.offsetTop - rectangle.startY;
                drawAllRectangles();
            }
        });

        canvas.addEventListener('mouseup', () => {
            if (isDrawing) {
                isDrawing = false;
                const text = prompt('Ingrese el texto:');
                if (text) {
                    rectangle.text = text;
                    rectangles.push(rectangle);
                }
                drawAllRectangles();


            }
        });

        function drawAllRectangles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.setLineDash([5, 5]);
            // Dibujar el rectángulo actual (si está siendo creado)
            if (isDrawing) {
                ctx.strokeRect(rectangle.startX, rectangle.startY, rectangle.w, rectangle.h);
            }

            // Dibujar todos los rectángulos almacenados
            rectangles.forEach(rect => {
                ctx.strokeRect(rect.startX, rect.startY, rect.w, rect.h);

                // Ajustar el tamaño del texto al rectángulo
                let fontSize = 20;
                ctx.font = fontSize + 'px Arial';

                // Dividir el texto en líneas que quepan en el rectángulo
                let lines = [];
                let currentLine = '';
                let words = rect.text.split(' ');
                for (let word of words) {
                    let testLine = currentLine + word + ' ';
                    let metrics = ctx.measureText(testLine);
                    if (metrics.width > rect.w) {
                        lines.push(currentLine.trim());
                        currentLine = word + ' ';
                    } else {
                        currentLine = testLine;
                    }
                }
                lines.push(currentLine.trim());

                // Calcular la altura de una línea y el espacio entre líneas
                let lineHeight = fontSize * 1.2;
                let textHeight = lines.length * lineHeight;

                // Calcular la posición vertical inicial
                let y = rect.startY + lineHeight;;

                // Dibujar cada línea
                lines.forEach(line => {
                    ctx.fillText(line, rect.startX, y);
                    y += lineHeight;
                });


            });
        }



        $(document).ready(function() {
            $('.guardar').click(function() {
                $.ajax({
                    url: "{{ route('pizarra.store') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {

                        data: JSON.stringify(guardado.toJSON())
                    },
                    success: function(response) {
                        alert(response.success);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        
        const borrarBtn = document.getElementById('borrar');

        let isErasing = false;
        let eraserSize = 20;

        borrarBtn.addEventListener('click', () => {
            isErasing = true;
        });

        canvas.addEventListener('mousedown', (e) => {
            if (isErasing) {
                erase(e.offsetX, e.offsetY);
            }
        });

        canvas.addEventListener('mousemove', (e) => {
            if (isErasing) {
                erase(e.offsetX, e.offsetY);
            }
        });

        canvas.addEventListener('mouseup', () => {
            isErasing = false;
        });

        function erase(x, y) {
            ctx.save();
            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(x, y, eraserSize, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }
    </script>
</body>

</html>
