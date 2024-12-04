<?php 

require('formulario.php');

$db = new Conexion();
$conexion = $db->getConexion();

$sqlUsuario = "SELECT  u.id_aprendiz , u.nombre , u.apellido , u.correo , u.fecha_nacimiento , u.id_genero , u.id_ciudad FROM usuario u INNER JOIN genero g on u.id_genero = g.id_genero  INNER JOIN ciudad c on u.id_ciudad = c.id_ciudad";

$banderausuario = $conexion->prepare($sqlUsuario);

$banderausuario->execute();
$usuarios = $banderausuario->fetchAll();

// print_r($usuarios);

?>


<table border="1">
     
<tr>
   <th>id_usuario</th>
   <th>nombres</th>
   <th>apellidos</th>
   <th>correo</th>
   <th>fecha_nacimiento</th>
   <th>Genero</th>
   <th>Ciudad</th>
   


</tr>
   
  <?php foreach ($usuarios as $key => $value) {
    ?>
  
  <tr> 
  <td><?= $value['id_aprendiz'] ?></td>
  <td><?= $value['nombre'] ?></td>
  <td><?= $value['apellido'] ?></td>
  <td><?= $value['correo'] ?></td>
  <td><?= $value['fecha_nacimiento'] ?></td>
  <td><?= $value['id_genero'] ?></td>
  <td><?= $value['id_ciudad'] ?></td>
  <td><button><a href="editar.php?id=<?=$value['id_aprendiz']?>">Editar</a></button></td>
  <td><button><a href="eliminar.php?id=<?=$value['id_aprendiz']?>">Eliminar</a></button></td>

  </tr> 
  <?php 
  }
  ?>


</table>