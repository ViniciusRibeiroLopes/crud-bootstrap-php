<?php
include('functions.php');
add();
if (!isset($_SESSION))
session_start();
include(HEADER_TEMPLATE);

// Verifica se o usuário não está logado ou não é admin
if (!isset($_SESSION['user']) || $_SESSION['user'] != "admin") {
    // Mensagem de erro caso o usuário não esteja logado ou não seja admin
    $_SESSION['message'] = "Você precisa estar logado  e ser administrador para acessar esse recurso!";
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

<br>
<h2>Novo Usuário</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
    <!-- área de campos do formulário -->
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" name="usuario[nome]" maxlength="50" required>
        </div>

        <div class="form-group col-md-2">
            <label for="username">Usuário (Login)</label>
            <input type="text" class="form-control" name="usuario[user]" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="usuario[password]" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">
        </div>
        <div class="form-group col-md-2">
            <?php
            if (empty($usuario['foto'])) {
                $imagem = 'SemImagem.png';
            } else {
                $imagem = $usuario['foto'];
            }
            ?>
            <br>
            <img id="imagePreview" src="../fotos/<?php echo $imagem; ?>" alt="Foto do usuário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
        </div>
    </div>

    <br>
    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="index.php" class="btn btn-default"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php
// Check for existing username using prepared statements (recommended)
if (isset($_POST['usuario']['user'])) {
  $username = $_POST['usuario']['user'];
  $sql = "SELECT * FROM usuarios WHERE username = ?"; // Prepare the query
  $stmt = mysqli_prepare($conn, $sql); // Prepare statement
  mysqli_stmt_bind_param($stmt, "s", $username); // Bind username parameter
  mysqli_stmt_execute($stmt); // Execute the prepared statement
  $result = mysqli_stmt_get_result($stmt); // Get results

  if (mysqli_num_rows($result) > 0) {
    echo "Usuário já existe!"; // Display error message
  }

  // Free resources
  mysqli_stmt_close($stmt);
  mysqli_free_result($result);
}
?>


<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Atualiza a imagem para o preview
            }

            reader.readAsDataURL(input.files[0]); // Lê o arquivo como uma URL de dados
        }
    }
</script>

<?php include(FOOTER_TEMPLATE); ?>