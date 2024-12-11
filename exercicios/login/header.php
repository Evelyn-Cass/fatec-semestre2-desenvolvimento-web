<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_COOKIE['tema'])) {
    $tema = $_COOKIE['tema'];
} else {
    $tema = 'light';
}

// if (isset($_SESSION['tipo_id'])) {
//     switch ($_SESSION['tipo_id']) {
//     case 1:
//     $tema = 'admin'; // Vermelho para Administrador
//     break;
//     case 2:
//     $tema = 'supervisor'; // Verde para Supervisor
//     break;
//     default:
//     $tema = 'common'; // Azul para Usuário Comum
//     break;
//     }
//   }



?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="<?php echo htmlspecialchars($tema) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de login para gerenciar usuários.">
    <title>Login</title>

    <link rel="stylesheet" href="styles/styleIndex.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</head>

<body>
    <nav class="fixed-top navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" id="theme-toggle">Mudar Tema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    <a class="nav-link active" href="index.php">Home</a>
                    <a class="nav-link" href="noticias.php">Notícias</a>
                    <a class="nav-link" href="sobre.php">Sobre Nós</a>
                    <a class="nav-link" href="contato.php">Contato</a>

                    <?php if (isset($_SESSION['tipo_id'])): ?>
                        <?php if ($_SESSION['tipo_id'] == 2): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard_super.php">Supervisor</a>
                            </li>
                        <?php elseif ($_SESSION['tipo_id'] == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard_admin.php">Administrador</a>
                            </li>
                        <?php endif; ?>
                    <?php endif;
                    if (isset($_SESSION['usuario_id'])) {
                        echo "<a class='nav-link right' href='logout.php'>Logout</a>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>

    <style>
        .right {
            position: fixed;
            right: 10px;
        }

        #theme-toggle {
            cursor: pointer;
        }
    </style>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            document.cookie = `tema=${newTheme}; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;

        });
    </script>