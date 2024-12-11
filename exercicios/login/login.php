<?php
    session_start();
    include('config.php');
 $erro = array("","");
    if (isset($_SESSION["msg"])){
        echo "<span class='msg'>".htmlspecialchars($_SESSION["msg"])."</span>";
        unset($_SESSION["msg"]);
    };

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        // Verificar credenciais
        $sql = "SELECT * FROM usuario WHERE email=?";

        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();            
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['tipo_id'] = $usuario['tipo_id'];

                //armazenar tema
                $temaEscolhido = $_POST['tema'];
                $_SESSION['tema'] = $temaEscolhido;

                setcookie("tema", "", time() - 3600, "/"); // Unset the cookie first
                setcookie("tema", $temaEscolhido, time() + (86400 * 30), "/", "", false, true); // 30 dias

                // Verifica o Id do Tipo do Usuário e retorna sua Descrição.
                if($_SESSION['tipo_id'] == 1) {
                    $_SESSION['tipo_descricao'] = "Administrador";
                } else if($_SESSION['tipo_id'] == 2) {
                    $_SESSION['tipo_descricao'] = "Supevisor";
                } else {
                    $_SESSION['tipo_descricao'] = "Usuário Comum";
                }
                setcookie("usuario", $usuario['nome'], time() + (86400 * 30), "/"); // 30 dias
                header('location: dashboard.php');
            } else {
                $erro[0] = "Senha incorreta.";
            }
        } else {
            $erro[1]="Usuário não encontrado.";
        }
    }
    include('header.php');
?>

<form method="post">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="exemplo@exemplo.com"
  <?php if(isset($_POST["email"])) echo "value=".htmlspecialchars($_POST["email"]) ?> required>
<?php
    if ($erro[1] != "") {
        echo "<span class='alert-erro'>".htmlspecialchars($erro[1])."</span><br>";
    }
?>
</div>

<label for="inputPassword5" class="form-label">Senha</label>
<input type="password" id="inputPassword5" class="form-control" name="senha" aria-describedby="passwordHelpBlock" required>
<?php
    if ($erro[0] != "") {
        echo "<span class='alert-erro'>".htmlspecialchars($erro[0])."</span><br>";
    }
?>
<br>
</div>


    <select class="form-select" aria-label="Default select example" id='select' name="tema">
        <option value="light">Claro</option>
        <option value="dark">Escuro</option>
        <!-- <option value="admin">Vermelho(Admin)</option>
        <option value="supervisor">Verde(Supervisor)</option>
        <option value="comum">Azul(Comum)</option> -->
    </select>
    <br>
    <div class="d-grid gap-2">
    <input class="btn btn-primary btn-lg" type="submit" value="Login">
    </div>
</form>


<?php include('footer.php'); ?>
<style>
    span {
        color: green;
    }
    .alert-erro{
        color: crimson;
    }
    form{
    width: 30%;}
</style>

<script>
    document.querySelector('select').value = "<?php if(isset($_POST['tema'])) echo htmlspecialchars($_POST['tema']); else echo 'light'; ?>";
</script>