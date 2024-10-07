<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
     

        @page{
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
            font-family:courier,arial,helvética;

        }
        .container {
           
      
            height: 100px;
            width: 100%;
           
            
      
           
         
        }

        .container2 {
        
            width: 100%;
         
            margin-top: 10px;
       
           
            height: 90px;
            line-height: 1.5;
            

        }
        .container3{
           
        }

       

        .izquierda {
            float: left;
            
          
          
            
            width: 25%;
            height: 100%;
            margin: 0px;
          

        }

        .left {
            
            float: left;
           
           
            font-size: 16px;
           
            width: 55%;
            height: 100%;
            margin: 0px;
            
        }

        .right {
            float: left;
            
        
            font-size: 16px;
            
            width: 45%;
            height: 100%;
           
          
            
        }

        .centro {
            float: left;
         
           
            font-size: 13px;
            width: 50%;
            height: 100%;
            text-align: center;
            
        }

        .derecha {
            float: left;
            
            font-size: 14px;
            height: 100%;
            
            
            width: 25%;
           
            
            
            text-align: center;
        }

        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            border: 1.5px solid black;
            border-radius: 10px;
            font-size: 14px;
            
        }

        

        thead th:nth-child(1) {
            width: 6%;
        }

        thead th:nth-child(2) {
            width: 48%;
        }

        thead th:nth-child(3) {
            width: 12%;
        }

        thead th:nth-child(4) {
            width: 11%;
        }
        thead th:nth-child(5) {
            width: 10%;
        }
        thead th:nth-child(6) {
            width: 13%;
        }
        
       

        th,
        td {
           
            padding-bottom: 5px;
            padding-top: 5px;
            border: 1.5px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th{
            font-size: 12px;
        }

        .container4 {
        
         
       
            height: 60px;
            padding: 12px;
            font-size: 10px;
            bottom: -70px;
            width: 425px;

        }

        .iz{
            float: left;
            margin-top: 20px;
           
   
            
            
            width: 180px;
         
          
            
            text-align: center;
        }
        .der{
            float: left;
            
          
            width: 180px;
            margin-left: 45px;
            height: 65px;
           
            text-align: left;
        }

        .cuadro{
            margin: 5%;
            padding: 5%;
            border: 1px solid black;
            border-radius: 10px;
            
           
        }

        .l{

            float: left;
            line-height: 1;
           
           
   
            
            
            width: 50%;
         
          
            
            text-align: left;

        }

        .r{

            float: left;
            line-height: 1;
            
          
            width: 50%;
            
           
           
            text-align: left;

        }
    
    </style>
</head>

<body>

    <div class="container">
        <div class="izquierda"><img src="{{$foto}}"
                height="100%" width="50%px" alt=""></div>
        <div class="centro"><b><span style="font-size: 20px;">{{$empresaDatos->nombre}}</span></b><br><br> <span>{{$empresaDatos->direccion}} <br>E-mail: {{$empresaDatos->correo}} <br> Tel. {{$empresaDatos->telefono}}</span> </div>
        <div class="derecha"><div class="cuadro"><b>CREDITO FISCAL</b> <br> <span style="color: red"><b>No. {{$expediente->id}}</b> </span> <br> <br><span style="font-size: 10px;">REGISTRO No.{{$empresaDatos->nrc}} <br> NIT: {{$empresaDatos->nit}}</span></div>
        </div>
    </div>

    <div class="container2">
        <div class="left">
        
          <b> Cliente: </b> {{$expediente->cliente->nombres}} {{$expediente->cliente->apellidos}}<br>
          <b>  Dirección: </b> {{$expediente->cliente->direccion}}<br>
          <b> Municipio:</b> {{$expediente->cliente->municipio}} <br>
          <b> Departamento:</b> {{$expediente->cliente->departamento}} <br>

           
          
        </div>
        <div class="right">
            <b> FECHA: </b> {{date('d-m-Y')}} <br>
            <b> NRC:</b> {{$expediente->cliente->nrc}} <br>
            <b> DUI:</b> {{$expediente->cliente->dui}} <br>
            <b> Giro:</b> {{$expediente->cliente->giro}} <br>
            
            
        </div>

    </div>

   

    <div class="container3">
        <table class="tabla">
            <thead>
                <tr>
                    <th>CANT</th>
                    <th>DESCRIPCION</th>
                    <th>PRECIO UNITARIO</th>
                    <th>VENTAS NO SUJETAS</th>
                    <th>VENTAS EXENTAS</th>
                    <th>VENTAS AFECTAS</th>
                </tr>
           
            </thead>
            <tbody>
                
                <tr>
                    <td>1</td>
                    <td>{{$expediente->ingreso->ingreso}}</td>
                    <td>${{$expediente->monto}}</td>
                    <td></td>
                    <td></td>
                    <td>$ {{$expediente->monto}}</td>
                </tr>    
             
                
               
                <tr>
                    <td style="text-align: left; " colspan="2" rowspan="2">Son: </td>
                    <td style="text-align: left;"  >SUMAS:    </td>
                    <td></td>
                    <td></td>
                    <td>$ {{$expediente->monto}}</td>
                    
                   
                </tr>

                <tr>
                    <td style="text-align: left;" colspan="3">13% DE IVA</td>
                    <td>$ {{$expediente->monto*0.13}}</td>
                    
                   
                </tr>

                <tr>
                    <td colspan="2" style="font-size:10px;"><b>LLENAR SI OPERACION ES IGUAL O MAYOR A $200</b></td>
                    <td style="text-align: left;" colspan="3">SUB-TOTAL</td>
                    <td>$ {{($expediente->monto*0.13 + $expediente->monto)}}</td>
                </tr>

                <tr>
                    <td colspan="2" rowspan="4" ><div class="r"><span style="text-align: center">Recibido por <br><br></span><b>NOMBRE: </b> <br> <br> <b>DUI/NIT:</b> <br> <br> <b>FIRMA:</b> </div><div class="l"><span style="text-align: center">Entregado por <br><br></span><b>NOMBRE: </b> <br> <br> <b>DUI/NIT:</b> <br> <br> <b>FIRMA:</b> </div></td>
                    <td style="text-align: left;" colspan="3">(-) IVA Retenido</td>
                    <td></td>
                </tr>

                <tr>
                    <td style="text-align: left;" colspan="3">VENTAS NO SUJETAS</td>
                    <td></td>
                </tr>

                <tr>
                    <td style="text-align: left;" colspan="3">VENTAS EXENTAS</td>
                    <td></td>
                </tr>

                <tr>
                    <td style="text-align: left;" colspan="3">VENTAS TOTALES</td>
                    <td>$ {{($expediente->monto*0.13 + $expediente->monto)}}</td>
                </tr>
                

            </tbody>
        </table>
    </div>
    

  

</body>

</html>
