<?php
include("functions.php");
index();
include(HEADER_TEMPLATE);
?>

<header class="mt-2">
	<br>
	<div class="row">
		<div class="col-12 col-md-6">
			<h2>Funcionários</h2>
		</div>

		<div class="col-12 col-md-6 text-md-end text-start mt-2 mt-md-0 h2">
			<a class="btn btn-primary square-button mb-2" href="add.php"><i class="fa fa-plus"></i> Novo Funcionário</a>
			<a class="btn btn-light square-button mb-2" href="../funcionario/"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>
</header>


<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php //clear_messages(); 
	?>
<?php endif; ?>

<hr>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th width="30%">Nome</th>
				<th>Idade</th>
				<th>Endereço</th>
				<th>Imagem</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($funcionarios): ?>
				<?php foreach ($funcionarios as $funcionario): ?>
					<tr>
						<td><?php echo $funcionario['id']; ?></td>
						<td><?php echo $funcionario['name']; ?></td>
						<td><?php echo calcularIdade($funcionario['birthdate']); ?></td>
						<td><?php echo $funcionario['endereco']; ?></td>
						<td>
							<?php
							if (empty($funcionario['foto'])) {
								$imagem = 'SemImagem.png';
							} else {
								$imagem = $funcionario['foto'];
							}
							?>
							<img src="../fotos/<?php echo $imagem; ?>" alt="Foto do funcionário" class="img-fluid" style="width: 180px; height: auto;">
						</td>
						<td class="actions text-right">
							<div class="d-flex flex-column flex-md-row justify-content-end gap-2">
								<a href="view.php?id=<?php echo $funcionario['id']; ?>" class="btn btn-sm btn-dark">
									<i class="fa fa-eye"></i><span class="btn-text"> Visualizar</span>
								</a>
								<a href="edit.php?id=<?php echo $funcionario['id']; ?>" class="btn btn-sm btn-primary">
									<i class="fa fa-pencil"></i><span class="btn-text"> Editar</span>
								</a>
								<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal" data-funcionario="<?php echo $funcionario['id']; ?>">
									<i class="fa fa-trash"></i><span class="btn-text"> Excluir</span>
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="8">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php include('modal.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>