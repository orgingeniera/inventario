<?php
session_start();
require("../conexion.php");


$id_user = $_SESSION['idUser'];
$permiso = "proveedores"; 
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
    exit();  
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $query_delete = mysqli_query($conexion, "DELETE FROM proveedores WHERE idproveedor = $id");

    if ($query_delete) {
        header("Location: proveedores.php");
    } else {
        echo "Error al eliminar el proveedor.";
    }

    mysqli_close($conexion);
    exit();  
}
?>
