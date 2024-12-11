<?php session_start();
include('config.php');
if (
    !isset($_SESSION['usuario_id']) ||
    $_SESSION['tipo_id'] != 2
) {
    header('location: login.php');
    exit();
}

include('header.php');

?>


<!-- Include Navbar -->
<div class="container mt-5">
    <h1>Bem-vindo ao Dashboard do Supervisor!</h1>
    <!-- Conteúdo específico do Supervisor -->
</div>

<?php include('footer.php'); ?>