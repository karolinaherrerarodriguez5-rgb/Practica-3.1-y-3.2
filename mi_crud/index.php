<?php
include("includes/db.php");
include("includes/navbar.php");

$resultado = $conexion->query("SELECT * FROM productos");
?>

<h2>Lista de Productos</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>

<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['precio']; ?></td>

<td>
<a href="edit.php?id=<?php echo $fila['id']; ?>">Editar</a>
<a href="delete.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
</td>
</tr>

<?php } ?>

</table>

<?php include("includes/footer.php"); ?>