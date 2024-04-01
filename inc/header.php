<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CRUD com Bootstrap</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }

        .btn-light {
            background-color: #cccccc;
            border-color: #cccccc;

        }

        .btn-light:hover {
            background-color: #888888;
            border-color: #888888;
        }
        header, #actions{
            margin-top: 10px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a href="<?php echo BASEURL; ?>" class="navbar-brand"><i class="fa-solid fa-house-chimney"></i> CRUD PW</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-users"></i> Clientes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo BASEURL?>customers/add.php"> <i class="fa-solid fa-user-plus"></i> Adicionar cliente</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL?>customers/"> <i class="fa-solid fa-users"></i> Gerenciar cliente</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-paw"></i> Animais
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo BASEURL?>animais/add.php"> <i class="fa-solid fa-plus"></i> Adicionar animal</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL?>animais/"> <i class="fa-solid fa-paw"></i> Gerenciar animais</a></li>
                        </ul>
                    </li>

                    <?php if (isset($_SESSION['user'])) :?>
                        <?php if($_SESSION['user'] == "admin"): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user-lock"></i> Usuários
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL?>usuarios/add.php"> <i class="fa-solid fa-user-tie"></i> Adicionar usuário</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL?>usuarios/"> <i class="fa-solid fa-user-lock"></i> Gerenciar usuários</a></li>
                                </ul>
                            </li>
                            <?php endif ?>
                            <li class="nav-item">
                                <a href="<?php echo BASEURL?>inc/logout.php" class="nav-link">
                                    Bem vindo <?php echo $_SESSION['user']?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                    <i class="fa-solid fa-users"></i> Login
                                </a>
                            </li>
                        <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">