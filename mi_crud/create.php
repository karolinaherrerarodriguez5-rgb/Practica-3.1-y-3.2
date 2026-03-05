<?php
include("includes/db.php");

if(isset($_POST['guardar'])){

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

$sql = "INSERT INTO productos(nombre,descripcion,precio)
VALUES('$nombre','$descripcion','$precio')";

$conexion->query($sql);

header("Location: index.php");

}

include("includes/navbar.php");
?>

<h2>Agregar Producto</h2>

<form method="POST">

Nombre:<br>
<input type="text" name="nombre" required><br>

Descripción:<br>
<input type="text" name="descripcion" required><br>

Precio:<br>
<input type="number" name="precio" required><br><br>

<button type="submit" name="guardar">Guardar</button>

</form>

<?php include("includes/footer.php"); ?>