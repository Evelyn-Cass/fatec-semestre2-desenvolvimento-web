<?php
session_start();
include('config.php');
$erro = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_id = $_POST['tipo_id'];


    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $erro = "Email já cadastrado!";
    } else {
        $sql = "INSERT INTO usuario (nome, email, telefone, senha, tipo_id) VALUES (?, ?, ?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssssi', $nome, $email, $telefone, $senha, $tipo_id);


        if ($stm->execute() === FALSE) {
            echo htmlspecialchars("Erro: " . $stm->error);
        } else {
            $_SESSION['msg'] = "Usuário cadastrado com sucesso!";
            header('location: login.php');
        }
    }
}
include('header.php');
?>

<form method="post">


    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="nome" placeholder=""
            <?php if (isset($nome)) echo htmlspecialchars("value='" . $nome . "'"); ?> required>
    </div>

    <label for="exampleFormControlInput1" class="form-label">Email:</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="exemplo@exemplo.com"
        <?php if (isset($email)) echo htmlspecialchars("value='" . $email . "'"); ?> required>
    <span><?php echo htmlspecialchars($erro); ?></span><br>
    </div>

    <label for="exampleFormControlInput1" class="form-label">Telefone:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="telefone" placeholder="(00) 00000-0000"
        <?php if (isset($telefone)) echo htmlspecialchars("value='" . $telefone . "'"); ?>>
    </div><br>

    <label for="inputPassword5" class="form-label">Senha</label>
    <input type="password" id="inputPassword5" class="form-control" name="senha" aria-describedby="passwordHelpBlock" required>
    <div id="passwordHelpBlock" class="form-text"> 
    </div>
    <br>


    Tipo de Usuário:
    <select id='selector' name="tipo_id" class="form-select" aria-label="Default select example">
        <option value="0">Selecione</option>
        <option value="1">Admin</option>
        <option value="2">Supervisor</option>
        <option value="3">Usuário Comum</option>
    </select>
    <span id="error-selector"></span><br>
    <div class="d-grid gap-2">
    <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Registrar">
    </div>
</form>
<?php include('footer.php'); ?>

<style>
    form {
        width: 30%;
    }

    span {
        color: crimson;
    }
</style>

<script>
    document.querySelector('select').value = "<?php echo htmlspecialchars($tipo_id); ?>";

    const btnSubmit = document.getElementById('submit');

    btnSubmit.addEventListener('click', function() {

        const selector = document.getElementById('selector');
        const senha = document.getElementById('inputPassword5');

        if (selector.value == 0) {
            const errorSelector = document.getElementById('error-selector');
            errorSelector.innerHTML = 'Selecione um tipo de usuário!';
            event.preventDefault();
        }

        if (senha.value.length < 8 || senha.value.length > 20) {
            const erroSenha = document.getElementById('passwordHelpBlock');
            erroSenha.innerHTML = 'Sua senha deve conter de 8 a 20 caracteres.';
            event.preventDefault();
        }

    });
</script>