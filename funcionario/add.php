<?php
include('functions.php');
add();
if (!isset($_SESSION))
session_start();
include(HEADER_TEMPLATE);

// Verifica se o usuário não está logado ou não é admin
if (!isset($_SESSION['user'])) {
    // Mensagem de erro caso o usuário não esteja logado ou não seja admin
    $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
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

<h2>Novo Funcionário</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
    <!-- área de campos do formulário -->
    <hr />
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" name="funcionario['name']" maxlength="50" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Nascimento</label>
            <input type="date" class="form-control" name="funcionario['birthdate']" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo3">Data de Cadastro</label>
            <input type="text" class="form-control" name="funcionario['created']" disabled>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="campo1">Endereço</label>
            <input type="text" class="form-control" name="funcionario['endereco']" required>
        </div>

        <div class="form-group col-md-2">
            <label for="campo2">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">
        </div>
        <div class="form-group col-md-2">
            <?php
            if (empty($funcionario['foto'])) {
                $imagem = 'SemImagem.png';
            } else {
                $imagem = $funcionario['foto'];
            }
            ?>
            <br>
            <img id="imagePreview" src="../fotos/<?php echo $imagem; ?>" alt="Foto do funcionário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
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