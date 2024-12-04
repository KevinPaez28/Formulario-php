<?php 

require('formulario.php');

$db = new Conexion();
$conexion = $db->getConexion();

$id_usuario  = $_GET['id'];

$sqlusuario = "SELECT  u.id_aprendiz , u.nombre , u.apellido , u.correo , u.fecha_nacimiento , u.id_genero , u.id_ciudad FROM usuario u INNER JOIN genero g on u.id_genero = g.id_genero  INNER JOIN ciudad c on u.id_ciudad = c.id_ciudad ";
$banderausuario = $conexion->prepare($sqlusuario);
$banderausuario->execute();

$usuarios = $banderausuario->fetchAll();

$sqlciudad = "SELECT * FROM ciudad ";
$banderaciudad = $conexion->prepare($sqlciudad);
$banderaciudad->execute();
$ciudades = $banderaciudad->fetchAll();


$sqlCiudadSeleccioanda = "SELECT * FROM ciudad c INNER JOIN  usuario u on c.id_ciudad = u.id_ciudad WHERE u.id_aprendiz = $id_usuario";

$banderaCiudadSeleccionada = $conexion->prepare($sqlCiudadSeleccioanda);
$banderaCiudadSeleccionada->execute();
$ciudadSeleccionada = $banderaCiudadSeleccionada->fetchAll();

$sqlGeneros = "SELECT * FROM genero ";
$banderaGeneros = $conexion->prepare($sqlGeneros);
$banderaGeneros->execute();
$generos = $banderaGeneros->fetchAll();

$sqlGeneroSeleccionado = "SELECT * FROM genero g INNER JOIN usuario u on g.id_genero = u.id_genero WHERE u.id_aprendiz = $id_usuario ";

$banderaGeneroSeleccionado = $conexion->prepare($sqlGeneroSeleccionado);
$banderaGeneroSeleccionado->execute();
$generoSeleccionado = $banderaGeneroSeleccionado->fetchAll();

$sqlDatosUsuario = "SELECT * FROM usuario WHERE id_aprendiz = $id_usuario ";
$banderaDatosUsuario = $conexion->prepare($sqlDatosUsuario);
$banderaDatosUsuario -> execute();
$datos = $banderaDatosUsuario->fetchAll();


$sqlLenguajes = "SELECT * FROM lenguajes";
$banderaLenguajes = $conexion->prepare($sqlLenguajes);
$banderaLenguajes->execute();
$lenguajes = $banderaLenguajes->fetchAll();

$sqlLenguajeSeleccion = "SELECT * FROM lenguajes l INNER JOIN  lenguaje_usuarios lu on l.id_lenguaje = lu.id_lenguaje WHERE lu.id_aprendiz = $id_usuario";
$banderaLenguajesSeleccion = $conexion->prepare($sqlLenguajeSeleccion);
$banderaLenguajesSeleccion->execute();
$lenguajeSeleccionados = $banderaLenguajesSeleccion->fetchAll();



?>

<form action="update.php" method="post" >
    <div>
        <label for="id_ciudad">Ciudades</label>
        <select name="id_ciudad" id="id_ciudad">
            <?php foreach ($ciudades as $key => $value)

            {  foreach ($ciudadSeleccionada as $key => $seleccion) {
                
            ?>
                <option id="<?=$value['id_ciudad']?>" value="<?=$value['id_ciudad']  ?> 
                " <?= $value['ciudad'] == $seleccion['ciudad']  ? 'selected' : '' ?>>
                
                    <?=$value['ciudad']?>
                </option>
                <?php
            }
            }?>
        </select>
    </div>

    <div>
        <label>Generos</label><br>
        <?php
        foreach ($generos as $key => $value){
        foreach ($generoSeleccionado as $key => $seleccion) {
                
            
        ?>
        <label for="gen_<?=$value['id_genero']?>">            
            <input id="gen_<?=$value['id_genero']?>" type="radio" name="genero" value="<?=$value['id_genero']?>" <?= $value['genero'] == $seleccion['genero'] ? 'checked' : '' ?>>
            <?=$value['genero'] ?> 
        </label>
        <br>
        <?php
            }
        }
        ?>
    </div>
    
    <input type="hidden" name="id" value="<?=$id_usuario?>">

    <label for="nombre">Nombre</label>
    <?php foreach ($datos as $key => $valor) {
        
     ?>
    <input type="text" name="nombre" id="nombre" value="<?= $valor['nombre']  ?>">
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" value="<?= $valor['apellido']  ?>" >
    <label for="correo">Correo</label>
    <input type="text" name="correo" id="correo" value="<?=$valor['correo'] ?>">
    <label for="fecha">Fecha Nacimiento</label>
    <input type="date" name="fecha" id="fecha" value="<?=$valor['fecha_nacimiento'] ?>">
    <?php  } ?>
    <div>
        <label>Lenguajes</label><br>
        <?php
        foreach ($lenguajes as $key => $value){
        ?>
        <label for="lenguaje_<?=$value['id_lenguaje']?>">            
            <input id="lenguaje_<?=$value['id_lenguaje']?>" type="checkbox" name="lenguaje[]" value="<?=$value['id_lenguaje']?>"  
            
            <?php
            foreach ($lenguajeSeleccionados as $key => $contenido) {
                if($value['id_lenguaje'] == $contenido['id_lenguaje']){
                    ?>
                    checked
                    <?php
                }
            }
             ?>>
            <?=$value['lenguaje']?>
        </label>
        <br>
        <?php
            
        }
        ?>
    </div>
    <input type="submit">
  </form>