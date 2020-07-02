<html>
    <head>

    <title>Document</title>
    </head>
            <body>
                <h1> Ingresaste mal la contraseña intenta de nuevo </h1>
            <?php
                $algo1 = $_POST["username"];
                $algo2 = $_POST["pass"];
               
                $url_rest = "http://Project-josedavgarcia615767.codeanyapp.com/usuario";
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
                  $username = $j -> username;
                  $password = $j -> password;
                  
                  //echo $username, $password;
                  $num = 0;
                   if($algo1 == $username && $algo2 == $password){
                        header("Location: ../php/dashboardUser.php");
                        $id = $j -> id_usuario;
                    }
                    elseif($algo1 == "admin" && $algo2 == "1234"){
                        header("Location: ../html/dashboardAdmin.html");
                    } 
                }
                session_start();
                $_SESSION['login'] = $_POST["username"];
                $_SESSION['id_user'] = $id;
                
      
            /*    
            $algo1 = $_POST["username"];
            $algo2 = $_POST["pass"];

            if($algo1 == "algo" && $algo2 == "1234"){
                header("Location: ../html/dashboardUser.html");
            } 
            elseif($algo1 == "admin" && $algo2 == "1234"){
                header("Location: ../html/dashboardAdmin.html");
            }
            else {
                header("Location: ../html/index.html");
            }
            */

            ?>    
            </body>
</html>

    