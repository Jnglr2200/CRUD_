<?php
if (!empty($_GET["id"])) { 
    header("Location: ../Vista/formulario_editar.php?id=" . $_GET["id"]);
    exit(); // Recomendado después de un header()
}

?>
