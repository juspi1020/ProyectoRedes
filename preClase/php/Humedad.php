<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/datos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,700;1,400&display=swap" rel="stylesheet"> 
  </head>
  <body>
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
          <tr><th>Id Usuario/dispositivo</th><th>Humedad</th><th>fecha</th></tr>
          <?php
          $url_rest = "http://Project-josedavgarcia615767.codeanyapp.com/smartroom";
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
            $hum = $j -> humedad;
            $fecha = $j -> fecha;
            echo "<tr><td>$iddevice</td><td>$hum</td><td>$fecha</td></tr>";
          }
          ?>
        
      </table>
      
    </div>
          
    <div class="o-link"><a href="../html/dashboardAdmin.html">VOLVER</a></div>
     
      
      </div>
      
     
     
  </body>
</html>