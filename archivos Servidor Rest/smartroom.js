const {Router} = require('express');
const router = Router();
const mysql = require('mysql');

// se crea la conexión a mysql
const connection = mysql.createPool({
			connectionLimit:500,
   			host: 'localhost',
   			user: 'root',
   			password: '1144097108', //el password de ingreso a mysql
   			database: 'smartroom',
   			port: 3306});

//function get en la ruta /datos, que trae todos los datos almacenados en la tabla
router.get('/smartroom', (req,res) => {
	var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
	var arreglo=[]; //variable para almacenar todos los datos, en formato arreglo de json
	
connection.getConnection(function(error, tempConn){ //conexion a mysql
		if(error){
			throw error;  //si no se pudo conectar
		}else{
		console.log('Conexion correcta.');
		//ejecución de la consulta
		tempConn.query('SELECT * FROM datosroom', function(error, result){
      			var resultado=result; //se almacena el resultado de la consulta en la variable resultado
		  if(error){
         			throw error;
		 	res.send("error en la ejecución del query");
      		}else{
			tempConn.release(); //se librea la conexió
			for (i=0;i<resultado.length; i++){ 		//se lee el resultado y se arma el json
json1={"id_datosroom":resultado[i].id_datosroom, "temperatura":resultado[i].temperatura,"humedad":resultado[i].humedad,
"movimiento":resultado[i].movimiento, "luz":resultado[i].luz, "toque":resultado[i].toque, "fecha":resultado[i].fecha, "hora":resultado[i].hora, "id_usuariodr":resultado[i].id_usuariodr };
				console.log(json1); //se muestra el json en la consola
				arreglo.push(json1); //se añade el json al arreglo
			}
			res.json(arreglo); //se retorna el arreglo
         }
		}
	);
	
	}});
 });

//función post en la ruta /datos que recibe datos
router.post('/smartroom', (req,res) => {
	console.log(req.body); //mustra en consola el json que llego
	json1 = req.body; //se almacena el json recibido en la variable json1
	connection.getConnection(function(error, tempConn){ //conexion a mysql
		if(error){
			throw error; //en caso de error en la conexion
		}else{
		console.log('Conexion correcta.');
		tempConn.query('INSERT INTO datosroom VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?)', [json1.temperatura, json1.humedad, json1.movimiento, json1.luz, json1.fecha, json1.hora, json1.toque, json1.id_usuariodr], function(error, result){ //se ejecuta lainserción
   if(error){
      throw error;
	  res.send ("error al ejecutar el query");
   }else{
	   tempConn.release();
      res.send("datos almacenados"); //mensaje de respuesta
   }
 }
);
		}
	});
	

});

router.get('/smartroom/:id_usuariodr', (req,res) => {
	var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
	var arreglo=[]; //variable para almacenar todos los datos, en formato arreglo de json
  	var id=req.params.id_usuariodr; //recogemos el parámetro enviado en la url
	
connection.getConnection(function(error, tempConn){ //conexion a mysql
		if(error){
			throw error;  //si no se pudo conectar
		}else{
		console.log('Conexion correcta.');
		//ejecución de la consulta
		tempConn.query('SELECT * FROM datosroom where id_usuariodr=?',[id], function(error, result){
      			var resultado=result; //se almacena el resultado de la consulta en la variable resultado
		  if(error){
         			throw error;
		 	//res.send("error en la ejecución del query");
      		}else{
			tempConn.release(); //se librea la conexió
			for (i=0;i<resultado.length; i++){ 		//se lee el resultado y se arma el json
json1={"id_datosroom":resultado[i].id_datosroom, "temperatura":resultado[i].temperatura, "humedad":resultado[i].humedad,
"movimiento":resultado[i].movimiento, "luz":resultado[i].luz, "toque":resultado[i].toque, "fecha":resultado[i].fecha, "hora":resultado[i].hora, "id_usuariodr":resultado[i].id_usuariodr };
				console.log(json1); //se muestra el json en la consola
				arreglo.push(json1); //se añade el json al arreglo
			}
			res.json(arreglo); //se retorna el arreglo
         }
		}
	);
	
	}});
 });

module.exports = router;
