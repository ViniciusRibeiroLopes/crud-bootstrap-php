<?php

// Inclui o arquivo com funções auxiliares (como formatar CPF, datas, telefone etc.)
include('functions.php');

// Chama a função view(), passando o ID do cliente pela URL (?id=valor)
view($_GET['id']);

// Inicia a sessão, caso ainda não esteja ativa
if (!isset($_SESSION))
    session_start();

// Inclui o template de cabeçalho (HTML inicial, menu, etc.)
include(HEADER_TEMPLATE);

?>
<br>
<!-- Título da página exibindo o ID do cliente -->
<h2 class="mt-2">Cliente <?php echo $customer['id']; ?></h2>
<hr>

<!-- Exibe mensagens armazenadas em sessão, se existirem -->
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
        <?php echo $_SESSION['message']; ?>
    </div>
<?php endif; ?>

<!-- Lista de dados principais do cliente -->
<dl class="dl-horizontal">
    <dt>Nome / Razão Social:</dt>
    <dd><?php echo $customer['name']; ?></dd>

    <dt>CPF / CNPJ:</dt>
    <dd><?php echo cpf_cnpj($customer['cpf_cnpj']); ?></dd>

    <dt>Data de Nascimento:</dt>
    <dd><?php echo formatadata($customer['birthdate'], "d/m/Y"); ?></dd>
</dl>

<!-- Endereço e datas de cadastro/atualização -->
<dl class="dl-horizontal">
    <dt>Endereço:</dt>
    <dd><?php echo $customer['address']; ?></dd>

    <dt>Bairro:</dt>
    <dd><?php echo $customer['hood']; ?></dd>

    <dt>CEP:</dt>
    <dd><?php echo cep($customer['zip_code']); ?></dd>

    <dt>Data de Cadastro:</dt>
    <dd><?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?></dd>

    <dt>Data da Última Atualização:</dt>
    <dd><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></dd>
</dl>

<!-- Contato e dados adicionais -->
<dl class="dl-horizontal">
    <dt>Cidade:</dt>
    <dd><?php echo $customer['city']; ?></dd>

    <dt>Telefone:</dt>
    <dd><?php echo telefone($customer['phone']); ?></dd>

    <dt>Celular:</dt>
    <dd><?php echo telefone($customer['mobile']); ?></dd>

    <dt>UF:</dt>
    <dd><?php echo $customer['state']; ?></dd>

    <dt>Inscrição Estadual:</dt>
    <dd><?php echo number_format($customer['ie'], 0, ",", "."); ?></dd>
</dl>

<!-- Ações disponíveis: editar ou voltar para a listagem -->
<div id="actions" class="row">
    <div class="col-md-12">
        <!-- Botão para editar o cliente -->
        <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">
            <i class="fa-solid fa-pen"></i> Editar
        </a>

        <!-- Botão para voltar à página inicial de clientes -->
        <a href="index.php" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<!-- Inclui o template de rodapé (HTML final, scripts, etc.) -->
<?php include(FOOTER_TEMPLATE); ?>
