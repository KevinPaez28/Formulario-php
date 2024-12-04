<link rel="stylesheet" href="formulario.css">
<?php


require('formulario.php');

$db = new Conexion();

$conexion = $db->getconexion();

$sql = "SELECT * FROM ciudad";
$banedera = $conexion ->prepare ($sql);
$banedera->execute();
$ciudades=$banedera-> fetchAll();

$generos = "SELECT * FROM genero";
$banedera = $conexion ->prepare ($generos);
$banedera->execute();
$genero=$banedera-> fetchAll();

$sqlLenguajes = "SELECT * FROM lenguajes";
$banderaLenguajes = $conexion->prepare($sqlLenguajes);
$banderaLenguajes->execute();
$lenguajes = $banderaLenguajes->fetchAll();


?>

<div class="content">
  <form action="controlador.php" method="post" class="formulario">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="text_input" required>
    
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" class="text_input" required>
    
    <label for="correo">Correo</label>
    <input type="text" name="correo" id="correo" class="text_input" required>
    
    <label for="fecha">Fecha Nacimiento</label>
    <input type="date" name="fecha" id="fecha" class="text_input"required >
    
    <div>
      <label for="ciudad_id">Ciudad</label>
      <select name="ciudad_id" id="ciudad_id" class="text_input">
        <?php
        foreach($ciudades as $key => $value){
          ?>

          <option id="<?= $value['id_ciudad']?>" required value="<?= $value['id_ciudad']?>">
            <?=$value['ciudad']?>
          </option>

        <?php
        }
        ?>
      </select>

    <div>  
      <div>
        <?php
        foreach($genero as $key => $value){
        ?>

          <input type="radio" id="gen_<?= $value['id_genero']?>" name="genero"  required value=" <?= $value['id_genero']?>"/>
          <label for="gen_<?= $value['id_genero']?>"><?=$value['genero']?></label>

        <?php
        }
        ?>
      </div>
      
      <div>
        <label>Lenguajes</label><br>
        <?php
          foreach ($lenguajes as $key => $value){
            ?>
            <label for="lenguaje_<?=$value['id_lenguaje']?>">            
            <input class="lenguajess" id="lenguaje_<?=$value['id_lenguaje']?>" type="checkbox" name="lenguaje[]" value="<?=$value['id_lenguaje']?>">
            <?=$value['lenguaje']?>
          </label>
          <br>
          <?php
          }
          ?>
      </div>
      
      <button class="consultas"><a href="vista.php">Ver usuarios</a></button>
      
      <input type="submit">

</div>
</form>
