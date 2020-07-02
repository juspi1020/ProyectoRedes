
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/datos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,700;1,400&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <h1>
    <?php
    session_start();
    echo $_SESSION['login'];
    echo $_SESSION['id_user'];
    $ned = $_SESSION['id_user'];
    ?>
    </h1>
    <div class="o-big">

      <div class="o-title">
                <h1 class="o-t1">Smart</h1>
                <h1 class="o-t2">room</h1>
                <img src="../src/fox.png">
              </div>
              <div class="o-subtitle">
              <h2>Datos de humedad.</h2>
              </div>

      <div class="o-table">
      <table border="10px">
          <tr><th>temperatura</th><th>humedad</th><th>movimiento</th><th>luz</th><th>toque</th><th>fecha</th><th>hora</th></tr>
          <?php
          $url_rest = "http://Project-josedavgarcia615767.codeanyapp.com/smartroom/$ned";
          $curl = curl_init($url_rest);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $respuesta = curl_exec($curl);

          if($respuesta==false){
              curl_close($curl);
              die ("Error...");
          }

          curl_close($curl);
          //echo $respuesta;
          $resp = json_decode($respuesta);
          $tam = count($resp);

          for ($i=0; $i<$tam; $i++){
            $j = $resp[$i];
            $iddevice = $j -> id_usuariodr;
            $tempe = $j -> temperatura;
            $hum = $j -> humedad;
            $movimiento = $j -> movimiento;
            $luz = $j -> luz;
            $toque = $j -> toque;
            $fecha = $j -> fecha;
            $hora = $j -> hora;
            echo "<tr><th>$tempe</th><th>$hum</th><th>$movimiento</th><th>$luz</th><th>$toque</th><th>$fecha</th><th>$hora</th></tr>";
          }
          ?>
        
      </table>
      
    </div>
          
    <div class="o-link"><a href="../html/index.html">VOLVER</a></div>
     
      
      </div>
</body>
</html>