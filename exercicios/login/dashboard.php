<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('location: login.php');
}
include('header.php');
?>
    <h1>Bem-vindo ao Dashboard!</h1>
    <p>Olá <?php echo htmlspecialchars($_SESSION['usuario_nome']) ?> você está logado!</p>

    <p>Autorizado: <?php echo htmlspecialchars($_SESSION['tipo_descricao']); ?></p>

    <br>
    <a href="logout.php">Logout</a>
<?php include('footer.php'); ?>