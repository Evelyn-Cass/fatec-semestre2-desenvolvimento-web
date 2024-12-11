<?php
include('header.php');
if (isset($_GET['msg']) && $_GET['msg'] == 'logout') {
    echo "<div class='alert'>Deslogado com sucesso!</div>";
}
?>
<div class="container mt-5">
    <h1 aria-label="Título da Página">Bem-vindo ao Sistema Login</h1>

    <?php
    if (!isset($_SESSION['usuario_id'])) {
    ?>
        <a href="login.php" class="button">Login</a>
        <a href="registro.php" class="button">Registrar</a>
    <?php
    } else {
    ?>
        <a href="logout.php" class="button">Logout</a>
    <?php
    }
    ?>
</div>

<?php include('footer.php'); ?>