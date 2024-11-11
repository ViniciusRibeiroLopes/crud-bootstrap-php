<?php
include("functions.php");
index();
if (!isset($_SESSION))
	session_start();
include(HEADER_TEMPLATE);
?>

<header
	class="mt-2">
	<br>
	<div class="row">
		<div class="col-12 col-md-6">
			<h2>Clientes</h2>
		</div>

		<div class="col-12 col-md-6 text-md-end text-start mt-2 mt-md-0 h2">
			<a class="btn btn-primary square-button mb-2" href="add.php"><i class="fa fa-plus"></i> Novo Cliente</a>
			<a class="btn btn-light square-button mb-2" href="../customers/"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>

<hr>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th width="30%">Nome</th>
				<th>CPF/CNPJ</th>
				<th>Telefone</th>
				<th>Atualizado em</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($customers): ?>
				<?php foreach ($customers as $customer): ?>
					<tr>
						<td><?php echo $customer['id']; ?></td>
						<td><?php echo $customer['name']; ?></td>
						<td><?php echo $customer['cpf_cnpj']; ?></td>
						<td><?php echo telefone($customer['phone']); ?></td>
						<td><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
						<td class="actions text-md-end text-start">
							<div class="d-flex flex-column flex-md-row justify-content-end gap-2">
								<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-dark square-button">
									<i class="fa fa-eye"></i><span class="btn-text"> Visualizar</span>
								</a>
								<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-primary square-button">
									<i class="fa fa-pencil"></i><span class="btn-text"> Editar</span>
								</a>
								<a href="#" class="btn btn-sm btn-danger square-button" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>">
									<i class="fa fa-trash"></i><span class="btn-text"> Excluir</span>
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>