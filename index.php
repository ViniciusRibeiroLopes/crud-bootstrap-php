<?php
	include "config.php";
	include DBAPI;
	if (!isset($_SESSION))
		session_start();
	include(HEADER_TEMPLATE);
	$db = open_database();
?>

</main>

<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Sistema de Gestão de Empresas<span clsas="d-block"></span></h1>
					<p class="mb-4">Gerencie seus clientes, funcionários e produtos de forma eficaz e organizada.
						Transforme seu controle de dados com nosso sistema prático e intuitivo.</p>
					<p><a href="#start" class="btn btn-dark me-2">Iniciar Gestão</a></p>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<img src="assets/funcionario_index.png" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Hero Section -->

<hr>

<?php if ($db): ?>
	<div class="container text-center" data-aos="fade-up" data-aos-delay="200" id="start">
		<div class="row justify-content-center">
			<div class="col-lg-2 col-sm-4 col-md-3 mb-3" data-aos="fade-up">
				<a href="customers/add.php" class="btn btn-default w-100 square-button">
					<i class="fa-solid fa-square-plus fa-4x"></i>
					<p class="mt-2">Novo Cliente</p>
				</a>
			</div>

			<div class="col-lg-2 col-sm-4 col-md-3 mb-3">
				<a href="customers" class="btn btn-light w-100 square-button">
					<i class="fa fa-user fa-4x"></i>
					<p class="mt-2">Clientes</p>
				</a>
			</div>
		</div>

		<hr>

		<div class="row justify-content-center" data-aos="fade-up">
			<div class="col-lg-2 col-sm-4 col-md-3 mb-3">
				<a href="funcionario/add.php" class="btn btn-default w-100 square-button">
					<i class="fa-regular fa-square-plus fa-4x"></i>
					<p class="mt-2">Novo Funcionário</p>
				</a>
			</div>

			<div class="col-lg-2 col-sm-4 col-md-3 mb-3">
				<a href="funcionario" class="btn btn-light w-100 square-button">
					<i class="fa-solid fa-user-tie fa-4x"></i>
					<p class="mt-2">Funcionários</p>
				</a>
			</div>
		</div>

		<hr>

		<?php if (isset($_SESSION['user'])): ?>
			<?php if ($_SESSION['user'] == 'admin'): ?>
				<div class="row justify-content-center mb-3">
					<div class="col-lg-2 col-sm-4 col-md-3 mb-3">
						<a href="usuarios/add.php" class="btn btn-secondary w-100 square-button">
							<i class="fa-solid fa-user-tie fa-4x"></i>
							<p class="mt-2">Novo Usuário</p>
						</a>
					</div>

					<div class="col-lg-2 col-sm-4 col-md-3 mb-3">
						<a href="<?php echo BASEURL; ?>usuarios" class="btn btn-light w-100 square-button">
							<i class="fa-solid fa-user-lock fa-4x"></i>
							<p class="mt-2">Usuários</p>
						</a>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>


<?php else: ?>
	<!-- Comenta a DIV abaixo -->
	<!--
			<div class="alert alert-danger" role="alert">
				<p><strong>ERRO!</strong> Não foi possível Conectar ao Banco de Dados!</p>
			</div>
			-->
<?php endif; ?>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
			<?php echo $_SESSION['message']; ?>
		</p>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>


<?php include(FOOTER_TEMPLATE); ?>