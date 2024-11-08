<?php

include('functions.php');
view($_GET['id']);
include(HEADER_TEMPLATE);

?>
<br>
<h2 class="mt-2">Funcionário <?php echo $funcionario['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
    <dt>Nome / Razão Social:</dt>
    <dd><?php echo $funcionario['name']; ?></dd>

    <dt>Endereço:</dt>
    <dd><?php echo $funcionario['endereco']; ?></dd>

    <dt>Idade:</dt>
    <dd><?php echo calcularIdade($funcionario['birthdate']); ?></dd>

    <dt>Data de Nascimento:</dt>
    <dd><?php echo formatadata($funcionario['birthdate'], "d/m/Y"); ?></dd>
</dl>

<dl class="dl-horizontal">

    <dt>Data de Cadastro:</dt>
    <dd><?php echo formatadata($funcionario['created'], "d/m/Y - H:i:s"); ?></dd>

    <dt>Data da Última Atualização:</dt>
    <dd><?php echo formatadata($funcionario['modified'], "d/m/Y - H:i:s"); ?></dd>

    <dt>Imagem:</dt>
    <dd><?php
        if (empty($funcionario['foto'])) {
            $imagem = 'SemImagem.png';
        } else {
            $imagem = $funcionario['foto'];
        }
        ?>
        <img src="../fotos/<?php echo $imagem; ?>" alt="Foto do funcionário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
    </dd>
</dl>

<br>
<div id="actions" class="row">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $funcionario['id']; ?>" class="btn btn-primary"> <i class="fa-solid fa-pen"></i> Editar</a>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>