<?php

include("../config.php"); // Arquivo de configuração do sistema (paths, constantes, etc.)
include(DBAPI);           // Arquivo com funções de acesso ao banco de dados (find, save, update, remove, etc.)

// Inicia a sessão, se ainda não estiver iniciada
if (!isset($_SESSION)) session_start();

$customers = null; // Variável global que vai armazenar a lista de clientes
$customer  = null; // Variável global para um cliente específico

/**
 *  Listagem de Clientes
 */
function index()
{
	global $customers;

  // Se houver busca pelo nome via POST
  if (!empty($_POST['customers'])) {
    // Aplica filtro no banco: SELECT * FROM customers WHERE name LIKE '%<texto digitado>%'
    $customers = filter("customers", "name like '%" . $_POST['customers'] . "%'");
  } else {
    // Caso contrário, retorna todos os clientes
    $customers = find_all("customers");
  }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
	global $customer;
	// Busca apenas um cliente pelo ID
	$customer = find('customers', $id);
}

/**
 *  Cadastro de Clientes
 */
function add() {

  // Se houver envio de formulário
  if (!empty($_POST['customer'])) {
    
    // Pega a data/hora atual (fuso horário de São Paulo)
    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    // Recebe os dados do formulário
    $customer = $_POST['customer'];

    // Define os campos de auditoria
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
    
    // Insere no banco
    save('customers', $customer);

    // Redireciona para a listagem
    header('location: index.php');
  }
}

/**
 *	Atualização/Edição de Cliente
 */
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  // Se recebeu um ID na URL
  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Se houve envio do formulário
    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s"); // Atualiza data de modificação

      update('customers', $id, $customer); // Atualiza registro no banco
      header('location: index.php');
    } else {
      // Caso contrário, busca o cliente para preencher o formulário
      global $customer;
      $customer = find('customers', $id);
    } 
  } else {
    // Se não recebeu ID → volta para listagem
    header('location: index.php');
  }
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id); // Exclui do banco

  // Redireciona para listagem após exclusão
  header('location: index.php');
}
?>
