<?php session_start();
include('config.php');
if (
    !isset($_SESSION['usuario_id']) ||
    $_SESSION['tipo_id'] != 1
) {
    header('location: login.php');
    exit();
} 
include('header.php');
?>

<div class="container mt-5">
    <h1>Bem-vindo ao Dashboard do Administrador!</h1>
    <!-- Conteúdo específico do Administrador -->
</div>

<?php include('footer.php'); ?>