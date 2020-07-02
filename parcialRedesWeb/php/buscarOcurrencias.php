
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
    <div class="o-big">

      <div class="o-title">
                <h1 class="o-t1">Smart</h1>
                <h1 class="o-t2">Bicycle</h1>
              </div>
              <div class="o-subtitle">
              <h2>Datos Bicicleta Inteligente.</h2>
              </div>

      <div class="o-table">
      <table border="10px">
          <tr><th>Id Ocurrencia</th><th>id_unico</th><th>temperatura</th><th>aceleracion</th><th>fechahora</th></tr>
          <?php
          $algo1 = $_POST["ObjetoE"];
          $url_rest = "http://Project-josedavgarcia615767.codeanyapp.com/objeto/$algo1";
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
            $iddevice = $j -> id_ocurrencia;
            $iduserio = $j -> id_unico;
            $tempera = $j -> temperatura;
            $aceleracion = $j -> aceleracion;
            $fechahora = $j -> fechahora;
            echo "<tr><th>$iddevice</th><th>$iduserio</th><th>$tempera</th><th>$aceleracion</th><th>$fechahora</th></tr>";
          }
          ?>
        
      </table>
      
    </div>
          
    <div class="o-link"><a href="../html/dashboardAdmin.html">VOLVER</a></div>
     
      
      </div>
</body>
</html>