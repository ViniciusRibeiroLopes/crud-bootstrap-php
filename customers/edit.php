<?php
require_once('functions.php'); // Importa funções auxiliares (CRUD e utilidades)
edit(); // Chama a função 'edit' (carrega os dados do cliente e trata envio de edição)

if (!isset($_SESSION))
  session_start(); // Garante que a sessão esteja ativa

include(HEADER_TEMPLATE); // Inclui o cabeçalho do layout padrão

// ---------------- VERIFICAÇÃO DE LOGIN -----------------
if (!isset($_SESSION['user'])) { // Se não houver usuário logado
  // Define mensagem de erro
  $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
  $_SESSION['type'] = "danger";

  echo "<br>";
?>
  <!-- Exibe mensagem de erro em alerta (Bootstrap) -->
  <div class="alert alert-danger alert-dismissible" role="alert" id="actions">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <!-- Botão para voltar -->
  <div class="container text-center">
    <a href="javascript:history.back()" class="btn btn-light">
      <i class="fa-solid fa-rotate-left"></i> Voltar
    </a>
  </div>

<?php
  clear_messages(); // Limpa mensagens da sessão
  include(FOOTER_TEMPLATE); // Inclui rodapé
  exit; // Interrompe o script para não exibir o formulário
}
?>

<!-- ---------------- FORMULÁRIO DE EDIÇÃO ---------------- -->
<br>
<h2>Atualizar Cliente</h2>

<!-- O formulário envia os dados para edit.php passando o ID na URL -->
<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
  <hr />
  <div class="row">
    <!-- Nome / Razão Social -->
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="customer['name']" value="<?php echo $customer['name']; ?>">
    </div>

    <!-- CNPJ / CPF -->
    <div class="form-group col-md-3">
      <label for="campo2">CNPJ / CPF</label>
      <input type="text" class="form-control" name="customer['cpf_cnpj']" value="<?php echo $customer['cpf_cnpj']; ?>">
    </div>

    <!-- Data de nascimento (formatada no padrão YYYY-MM-DD para o input date) -->
    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="customer['birthdate']"
             value="<?php echo formatadata($customer['birthdate'], "Y-m-d"); ?>">
    </div>
  </div>

  <div class="row">
    <!-- Endereço -->
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="customer['address']" value="<?php echo $customer['address']; ?>">
    </div>

    <!-- Bairro -->
    <div class="form-group col-md-3">
      <label for="campo2">Bairro</label>
      <input type="text" class="form-control" name="customer['hood']" value="<?php echo $customer['hood']; ?>">
    </div>

    <!-- CEP -->
    <div class="form-group col-md-2">
      <label for="campo3">CEP</label>
      <input type="text" class="form-control" name="customer['zip_code']" value="<?php echo $customer['zip_code']; ?>">
    </div>

    <!-- Data de cadastro (não editável) -->
    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="text" class="form-control" name="customer['created']" disabled
             value="<?php echo $customer['created']; ?>">
    </div>
  </div>

  <div class="row">
    <!-- Município -->
    <div class="form-group col-md-3">
      <label for="campo1">Município</label>
      <input type="text" class="form-control" name="customer['city']" value="<?php echo $customer['city']; ?>">
    </div>

    <!-- Telefone -->
    <div class="form-group col-md-2">
      <label for="campo2">Telefone</label>
      <input type="text" class="form-control" name="customer['phone']" value="<?php echo $customer['phone']; ?>">
    </div>

    <!-- Celular -->
    <div class="form-group col-md-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="customer['mobile']" value="<?php echo $customer['mobile']; ?>">
    </div>

    <!-- UF -->
    <div class="form-group col-md-1">
      <label for="campo3">UF</label>
      <input type="text" class="form-control" name="customer['state']" value="<?php echo $customer['state']; ?>">
    </div>

    <!-- Inscrição Estadual -->
    <div class="form-group col-md-2">
      <label for="campo3">Inscrição Estadual</label>
      <input type="text" class="form-control" name="customer['ie']" value="<?php echo $customer['ie']; ?>">
    </div>
  </div>

  <!-- Botões -->
  <br>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i> Salvar
      </button>
      <a href="index.php" class="btn btn-default">
        <i class="fa-solid fa-xmark"></i> Cancelar
      </a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?> <!-- Inclui rodapé -->
