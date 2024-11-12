<?php
include('functions.php');

// Inicia a sessão
if (!isset($_SESSION)) session_start();

// Verifica se o usuário não está logado ou não é admin
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin') {
    // Mensagem de erro caso o usuário não esteja logado ou não seja admin
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";

    // Inclui o cabeçalho e mostra a mensagem de erro
    include(HEADER_TEMPLATE);

    echo "<br>";
?>

    <!-- Exibe a mensagem de erro e a opção de voltar -->
    <div class="alert alert-danger alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="container text-center">
        <a href="javascript:history.back()" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </div>

<?php
    clear_messages();
    include(FOOTER_TEMPLATE);
    exit; // Impede a execução de qualquer código abaixo
}

// Se o usuário está logado e é admin, continua com a execução normal
view($_GET['id']);
include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php else : ?>

    <br>
    <header>
        <h2>Cliente <?php echo $usuario['id']; ?></h2>
    </header>
    <hr>
    <dl class="dl-horizontal">
        <dt>Nome:</dt>
        <dd><?php echo $usuario['nome']; ?></dd>

        <dt>Login:</dt>
        <dd><?php echo $usuario['user']; ?></dd>

        <dt>Senha:</dt>
        <dd><?php echo $usuario['password']; ?></dd>

        <dt>Foto:</dt>
        <dd><?php
            if (empty($funcionario['foto'])) {
                $imagem = 'SemImagem.png';
            } else {
                $imagem = $funcionario['foto'];
            }
            ?>
            <img src="../fotos/<?php echo $imagem; ?>" alt="Foto do usuário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
        </dd>
    </dl>
<?php endif; ?>

<div id="actions" class="row">
    <div class="col-md-12">
        <?php if (empty($_SESSION['message'])): ?>
            <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
        <?php endif; ?>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>