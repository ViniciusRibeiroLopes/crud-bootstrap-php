<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>CRUD com Bootstrap</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?php echo BASEURL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASEURL; ?>https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="<?php echo BASEURL; ?>css/tiny-slider.css" rel="stylesheet">
    <link href="<?php echo BASEURL; ?>css/style.css" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?php echo BASEURL; ?>assets/favicon.png" />
    <!-- Bootstrap Icons-->
    <link href="<?php echo BASEURL; ?>https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="<?php echo BASEURL; ?>https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="<?php echo BASEURL; ?>https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo BASEURL; ?>https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>https://unpkg.com/aos@2.3.1/dist/aos.css" />


</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><i class="fa-solid fa-users-line"></i> Home</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASEURL; ?>index.php"><i class="fa-solid fa-house"></i> Início</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-user"></i>
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers" data-aos="fade-up"><i class="fa-solid fa-users"></i> Gerenciar Clientes</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-user-tie"></i>
                            Funcionários
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>funcionario"><i class="fa-brands fa-black-tie"></i> Gerenciar Funcionários</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>funcionario/add.php"><i class="fa-regular fa-square-plus"></i> Novo Funcionário</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-user-tie"></i>
                            Usuários
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-brands fa-black-tie"></i> Gerenciar Usuários</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-regular fa-square-plus"></i> Novo Usuário</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['user'])): // Verifica se está logado 
                    ?>
                        <?php if ($_SESSION['user'] == "admin"): // Verifica se está logado como admin 
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user-lock"></i> Usuários
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Adicionar Usuário</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuários</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                                Bem vindo <?php echo $_SESSION['user'] ?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                <i class="fa-solid fa-users"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </nav> 
    <!-- End Header/Navigation -->
    <main class="container align-items-center justify-content-center custom-padding">
