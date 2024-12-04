<?php 

  require ('formulario.php');
  $db = new Conexion();
  $conexion = $db->getConexion(); //conexion base de datos 

  $regexNombre = "/^[aA-zZ]{3,29}$/";
  
  $regexapellido = "/^[aA-zZ]{3,29}$/";

  $regexCorreo = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
  

  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $correo = $_POST['correo'];
  $fecha_nacimiento = $_POST['fecha'];
  $genero_id = $_POST['genero'];
  $ciudad_id = $_POST['ciudad_id'];
  $id_lenguaje = $_POST['lenguaje'];

  

  
	if(preg_match($regexNombre,$nombre)){

    if(preg_match($regexapellido,$apellido)){

      if(preg_match($regexCorreo,$correo)){

        $sql = "INSERT INTO usuario (nombre ,apellido, fecha_nacimiento, id_genero,id_ciudad, correo) VALUES (:nombre,:apellido,:fecha,:genero_id,:ciudad_id,:correo)";

      $stm = $conexion->prepare($sql);

      $stm->bindParam(':nombre', $nombre);
      $stm->bindParam(':apellido', $apellido);
      $stm->bindParam(':correo', $correo);
      $stm->bindParam(':fecha', $fecha_nacimiento);
      $stm->bindParam(':genero_id', $genero_id);
      $stm->bindParam(':ciudad_id', $ciudad_id);
      $stm->execute();

          
      $id_usuario = $conexion->lastInsertId();


      $sqlLenguajes = "INSERT INTO lenguaje_usuarios (id_aprendiz,id_lenguaje) VALUES (:id_aprendiz, :id_lenguaje)";

      $prueba = $conexion->prepare($sqlLenguajes);

      foreach ($id_lenguaje as $key => $value) {
        $prueba ->bindParam(':id_aprendiz', $id_usuario);
        $prueba ->bindParam(':id_lenguaje', $value);
        $prueba ->execute();
      }

      header('Location:vista.php');
      echo"Datos ingresados con exito";

     }else {
      echo '<p style="color:red">Correo electronico no valido</p>'; 
      } 

    }else {
      echo '<p style="color:red">Apellido incorrecto</p>'; 
      }

  }else{
		echo '<p style="color:red">Nombre incorrecto</p>'; 
	  }

	
?>
