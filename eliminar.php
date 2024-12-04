<?php 

require('formulario.php');

$db = new Conexion();
$conexion = $db->getConexion();

$id_usuario  = $_REQUEST['id'];

$lenguaje_usuarios =  "DELETE from lenguaje_usuarios where id_aprendiz = :id_usuario;";
$stm = $conexion->prepare($lenguaje_usuarios);
$stm->bindParam(':id_usuario', $id_usuario);
$stm->execute();

$usuarios= "DELETE from usuario where id_aprendiz = :id_aprendiz;";
$stml = $conexion->prepare($usuarios);
$stml->bindParam(':id_aprendiz', $id_usuario);
$stml->execute();


header('Location:vista.php');
echo"eliminacion exitosa";