<?php
include("includes/db.php");

$id = $_GET['id'];

$resultado = $conexion->query("SELECT * FROM productos WHERE id=$id");
$fila = $resultado->fetch_assoc();

if(isset($_POST['actualizar'])){

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

$sql = "UPDATE productos 
SET nombre='$nombre', descripcion='$descripcion', precio='$precio'
WHERE id=$id";

$conexion->query($sql);

header("Location: index.php");

}

include("includes/navbar.php");
?>

<h2>Editar Producto</h2>

<form method="POST">

Nombre:<br>
<input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>"><br>

Descripción:<br>
<input type="text" name="descripcion" value="<?php echo $fila['descripcion']; ?>"><br>

Precio:<br>
<input type="number" name="precio" value="<?php echo $fila['precio']; ?>"><br><br>

<button type="submit" name="actualizar">Actualizar</button>

</form>

<?php include("includes/footer.php"); ?>