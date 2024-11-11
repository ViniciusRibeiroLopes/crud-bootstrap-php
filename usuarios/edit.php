<?php
// Esse é o edit.php
include('functions.php');
edit();

if (!isset($_SESSION))
session_start();

include(HEADER_TEMPLATE);
?>

<header>
    <h2>Atualizar Usuário</h2>
</header>

<!-- Área de campos do form -->
<form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-8">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="campo2">Usuário (Login)</label>
            <input type="text" class="form-control" name="usuario[user]" value="<?php echo $usuario['user']; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="campo3">Senha</label>
            <input type="password" class="form-control" name="usuario[password]" value="<?php echo $usuario['password']; ?>">
        </div>
    </div>

    <div class="form-group col-md-7">
        <label for="name">Imagem</label>
        <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">

        <?php
        // Verifica se a imagem foi definida, caso contrário, usa uma imagem padrão
        $imagem = !empty($usuario['foto']) ? $usuario['foto'] : 'SemImagem.png';
        ?>

        <br>
        <!-- Exibe a imagem atual ou a imagem padrão -->
        <img id="imagePreview" src="../fotos/<?php echo $imagem; ?>" alt="Foto do usuário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
    </div>

    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>

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