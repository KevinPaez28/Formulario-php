<?php 
    
  require ('formulario.php');
  $db = new Conexion();
  $conexion = $db->getConexion();
  

  $id_usuario = $_REQUEST['id'];

  $nombre = $_REQUEST['nombre'];
  $apellido = $_REQUEST['apellido'];
  $correo = $_REQUEST['correo'];
  $fecha_nacimiento = $_REQUEST['fecha'];
  $genero_id = $_REQUEST['genero'];
  $ciudad_id = $_REQUEST['id_ciudad'];
  $id_lenguaje = $_REQUEST['lenguaje'];


  $sql = "UPDATE usuario SET nombre = :nombre,  apellido = :apellido ,  correo = :correo , fecha_nacimiento = :fecha , id_genero = :genero_id , id_ciudad = :ciudad_id WHERE id_aprendiz = :id_usuario";
  $stm = $conexion->prepare($sql);
  $stm->bindParam(':nombre', $nombre);
  $stm->bindParam(':apellido', $apellido);
  $stm->bindParam(':correo', $correo);
  $stm->bindParam(':fecha', $fecha_nacimiento);
  $stm->bindParam(':genero_id', $genero_id);
  $stm->bindParam(':ciudad_id', $ciudad_id);
  $stm->bindParam(':id_usuario', $id_usuario);
  $stm->execute();


?>    