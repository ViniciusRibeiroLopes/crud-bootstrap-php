<?php
//esse é o edit.php
include('functions.php');
edit();

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
            <label for="username">Usuário (Login)</label>
            <input type="text" class="form-control" name="usuario[user]" value="<?php echo $usuario['user']; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="usuario[password]" value="">
        </div>
    </div>

    <div class="form-group col-md-7">
        <label for="name">Imagem</label>
        <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">
        <?php
        if (empty($usuario['foto'])) {
            $imagem = 'SemImagem.png';
        } else {
            $imagem = $usuario['foto'];
        }
        ?>
        <br>
        <img id="imagePreview" src="../fotos/<?php echo $imagem; ?>" alt="Foto do funcionário" class="img-fluid img-thumbnail" style="width: 180px; height: auto;">
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
    $(document).ready(() => {
        $("#foto").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>