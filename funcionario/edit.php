<?php
require_once('functions.php');
edit();
include(HEADER_TEMPLATE); 
?>

<br>
<h2>Atualizar Funcionário</h2>

<form action="edit.php?id=<?php echo $funcionario['id']; ?>" method="post" enctype="multipart/form-data">
  <hr />
  <div class="row">
    <div class="form-group col-md-2">
      <label for="campo1">ID</label>
      <input type="number" class="form-control" name="funcionario['id']" value="<?php echo $funcionario['id']; ?>" disabled>
    </div>
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="funcionario['name']" value="<?php echo $funcionario['name']; ?>">
    </div>
    <div class="form-group col-md-7">
      <label for="name">Endereço</label>
      <input type="text" class="form-control" name="funcionario['endereco']" value="<?php echo $funcionario['endereco']; ?>">
    </div>
    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="funcionario['birthdate']" value="<?php echo formatadata($funcionario['birthdate'], "Y-m-d"); ?>">
    </div>
    <div class="form-group col-md-7">
      <label for="name">Imagem</label>
      <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage(event)">
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