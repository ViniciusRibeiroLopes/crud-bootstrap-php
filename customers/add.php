<?php
require_once('functions.php'); // Importa o arquivo com funções auxiliares (provavelmente CRUD e utilitários)
add(); // Chama a função 'add' (possivelmente para inicializar lógica de cadastro de cliente)

if (!isset($_SESSION)) // Verifica se a sessão já não foi iniciada
  session_start(); // Se não, inicia a sessão

include(HEADER_TEMPLATE); // Inclui o cabeçalho (layout/template padrão do sistema)

// ---------------- VERIFICAÇÃO DE LOGIN -----------------
if (!isset($_SESSION['user'])) { // Se não existir usuário logado na sessão
  // Define mensagem de erro
  $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
  $_SESSION['type'] = "danger";

  echo "<br>";
?>
  <!-- Exibe alerta de erro (Bootstrap) -->
  <div class="alert alert-danger alert-dismissible" role="alert" id="actions">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <!-- Botão para voltar à página anterior -->
  <div class="container text-center">
    <a href="javascript:history.back()" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
  </div>

<?php
  clear_messages(); // Função que deve limpar mensagens da sessão
  include(FOOTER_TEMPLATE); // Inclui o rodapé
  exit; // Interrompe o script para não exibir o formulário
}
?>

<!-- ---------------- FORMULÁRIO DE CADASTRO ---------------- -->
<br>
<h2>Novo Cliente</h2>

<form action="add.php" method="post">
  <!-- Campos de cadastro -->
  <hr />
  <div class="row">
    <!-- Nome -->
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="customer['name']" maxlength="50">
    </div>

    <!-- CPF ou CNPJ -->
    <div class="form-group col-md-3">
      <label for="campo2">CNPJ / CPF</label>
      <input type="text" class="form-control" name="customer['cpf_cnpj']" maxlength="11">
    </div>

    <!-- Data de nascimento -->
    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="customer['birthdate']">
    </div>
  </div>

  <!-- Endereço -->
  <div class="row">
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="customer['address']">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Bairro</label>
      <input type="text" class="form-control" name="customer['hood']">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">CEP</label>
      <input type="text" class="form-control" name="customer['zip_code']" maxlength="8">
    </div>

    <!-- Data de cadastro (bloqueada, não editável) -->
    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="text" class="form-control" name="customer['created']" disabled>
    </div>
  </div>

  <!-- Município, telefone, celular, estado, inscrição estadual -->
  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo1">Município</label>
      <input type="text" class="form-control" name="customer['city']">
    </div>

    <div class="form-group col-md-2">
      <label for="campo2">Telefone</label>
      <input type="text" class="form-control" name="customer['phone']" maxlength="11">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="customer['mobile']" maxlength="11">
    </div>

    <div class="form-group col-md-1">
      <label for="campo3">UF</label>
      <input type="text" class="form-control" name="customer['state']" maxlength="2">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Inscrição Estadual</label>
      <input type="text" class="form-control" name="customer['ie']" maxlength="15">
    </div>
  </div>

  <!-- Botões de ação -->
  <br>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-default"><i class="fa-solid fa-xmark"></i> Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?> <!-- Inclui rodapé do sistema -->
