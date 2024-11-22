<?php
include("functions.php");
index();
if (!isset($_SESSION))
    session_start();
include(HEADER_TEMPLATE);
// Verifica se o usuário não está logado ou não é admin
if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
    // Mensagem de erro caso o usuário não esteja logado ou não seja admin
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";

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
?>

<header class="mt-2">
	<br>
	<div class="row">
		<div class="col-12 col-md-6">
			<h2>Usuários</h2>
		</div>

		<div class="col-12 col-md-6 text-md-end text-start mt-2 mt-md-0 h2">
			<a class="btn btn-primary square-button mb-2" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
			<a class="btn btn-light square-button mb-2" href="../funcionario/"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>

<form name="filtro" action="index.php" method="post">
    <div class="row">
        <div class="form-group col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" maxlength="50" name="users" required>
                <button type="submit" class="btn btn-secondary"><i class='fas fa-search'></i> Consultar</button>
            </div>
        </div>
    </div>
</form>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($usuarios): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td align='center'><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['user']; ?></td>
                        <td>
                            <?php
                            if (empty($usuario['foto'])) {
                                $imagem = 'SemImagem.png';
                            } else {
                                $imagem = $usuario['foto'];
                            }
                            ?>
                            <img src="../fotos/<?php echo $imagem; ?>" alt="Foto do usuário" class="img-fluid" style="width: 180px; height: auto;">
                        </td>
                        <td class="actions text-right">
                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-dark">
                                    <i class="fa fa-eye"></i><span class="btn-text"> Visualizar</span>
                                </a>
                                <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil"></i><span class="btn-text"> Editar</span>
                                </a>
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal-user"
                                    data-usuario="<?php echo $usuario['id']; ?>">
                                    <i class="fa fa-trash"></i><span class="btn-text"> Excluir</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>