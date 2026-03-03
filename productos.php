<?php

// CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli("localhost", "root", "", "crud_productos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensaje = "";

// INSERTAR (CREATE)

if (isset($_POST['guardar'])) {

    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $cantidad = trim($_POST['cantidad']);

    // Validaciones básicas
    if ($nombre == "" || $descripcion == "" || $precio == "" || $cantidad == "") {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!is_numeric($precio) || !is_numeric($cantidad)) {
        $mensaje = "Precio y cantidad deben ser numéricos.";
    } else {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad)
                VALUES ('$nombre','$descripcion','$precio','$cantidad')";
        if ($conexion->query($sql)) {
            $mensaje = "Producto agregado correctamente.";
        } else {
            $mensaje = "Error al guardar.";
        }
    }
}


// ELIMINAR (DELETE)

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM productos WHERE id=$id");
    $mensaje = "Producto eliminado correctamente.";
}


// OBTENER DATOS PARA EDITAR

$editar = false;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $resultado = $conexion->query("SELECT * FROM productos WHERE id=$id");
    $fila = $resultado->fetch_assoc();
    $editar = true;
}


// ACTUALIZAR (UPDATE)
if (isset($_POST['actualizar'])) {

    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $cantidad = trim($_POST['cantidad']);

    if ($nombre == "" || $descripcion == "" || $precio == "" || $cantidad == "") {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        $sql = "UPDATE productos SET 
                nombre='$nombre',
                descripcion='$descripcion',
                precio='$precio',
                cantidad='$cantidad'
                WHERE id=$id";

        if ($conexion->query($sql)) {
            $mensaje = "Producto actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Productos</title>
</head>
<body>

<h2>Sistema CRUD de Productos</h2>

<?php if ($mensaje != "") { ?>
    <p><b><?php echo $mensaje; ?></b></p>
<?php } ?>


FORMULARIO

<form method="POST">

    <?php if ($editar) { ?>
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
    <?php } ?>

    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo $editar ? $fila['nombre'] : ''; ?>"><br><br>

    Descripción:<br>
    <input type="text" name="descripcion" value="<?php echo $editar ? $fila['descripcion'] : ''; ?>"><br><br>

    Precio:<br>
    <input type="text" name="precio" value="<?php echo $editar ? $fila['precio'] : ''; ?>"><br><br>

    Cantidad:<br>
    <input type="text" name="cantidad" value="<?php echo $editar ? $fila['cantidad'] : ''; ?>"><br><br>

    <?php if ($editar) { ?>
        <button type="submit" name="actualizar">Actualizar</button>
        <a href="productos.php">Cancelar</a>
    <?php } else { ?>
        <button type="submit" name="guardar">Guardar</button>
    <?php } ?>

</form>

<hr>


READ (LISTAR DATOS)

<h3>Lista de Productos</h3>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Acciones</th>
</tr>

<?php
$resultado = $conexion->query("SELECT * FROM productos");

while ($row = $resultado->fetch_assoc()) {
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nombre']; ?></td>
    <td><?php echo $row['descripcion']; ?></td>
    <td><?php echo $row['precio']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td>
        <a href="productos.php?editar=<?php echo $row['id']; ?>">Editar</a>
        |
        <a href="productos.php?eliminar=<?php echo $row['id']; ?>" 
           onclick="return confirm('¿Seguro que desea eliminar?');">
           Eliminar
        </a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>