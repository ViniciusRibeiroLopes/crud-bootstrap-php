<?php

include("../config.php");
include(DBAPI);

$funcionarios = null;
$funcionario = null;

/**
 *  Listagem de Funcionários
 */
function index()
{
  global $funcionarios;
  $funcionarios = find_all("funcionarios");
}

/**
 *  Visualização de um Funcionário
 */
function view($id = null)
{
  global $funcionario;
  $funcionario = find('funcionarios', $id);
}

/**
 *  Cadastro de Funcionários
 */
function add()
{
  if (!empty($_POST['funcionario'])) {
    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
    $funcionario = $_POST['funcionario'];
    $funcionario['created'] = $now->format("Y-m-d H:i:s");
    $funcionario['modified'] = $now->format("Y-m-d H:i:s");

    // Caminho absoluto para o diretório 'imagens'
    $uploadDir = dirname(__DIR__) . '/fotos/'; // Corrige o caminho adicionando a barra '/'

    // Verifica se o diretório existe, se não existir, cria-o
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true); // Cria o diretório com permissões de leitura e escrita
    }

    // Processamento da imagem
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      $imageName = basename($_FILES['foto']['name']);
      $imagePath = $uploadDir . $imageName;

      // Move a imagem para o diretório 'imagens'
      if (move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath)) {
        $funcionario['foto'] = $imageName; // Armazena o caminho relativo no banco de dados
      } else {
        $_SESSION['message'] = "Erro ao carregar a imagem.";
        $_SESSION['type'] = 'danger';
        return;
      }
    }

    // Função 'save' para salvar os dados no banco de dados
    save('funcionarios', $funcionario);
    header('location: index.php');
    exit(); // Adiciona exit() para garantir que o script pare após o redirecionamento
  }
}

/**
 *	Atualizacao/Edicao de Funcionário
 */
function edit()
{
  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera o funcionário existente
    $funcionarioV = find('funcionarios', $id);

    // Se existe a variável POST 'funcionario', processa a edição
    if (isset($_POST['funcionario'])) {
      $funcionario = $_POST['funcionario'];
      $funcionario['modified'] = $now->format("Y-m-d H:i:s");

      // Processa a imagem enviada
      if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploadDir = dirname(__DIR__) . '/fotos/';
        $imageName = basename($_FILES['foto']['name']);
        $imagePath = $uploadDir . $imageName;

        // Move a nova imagem para o diretório
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath)) {
          // Apaga a imagem antiga, se existir
          if (!empty($funcionarioV['foto'])) {
            unlink($uploadDir . $funcionarioV['foto']);
          }
          $funcionario['foto'] = $imageName; // Atualiza a nova imagem
        } else {
          $_SESSION['message'] = "Erro ao atualizar a imagem.";
          $_SESSION['type'] = 'danger';
          return;
        }
      } else {
        // Mantém a imagem existente se nenhuma nova for enviada
        $funcionario['foto'] = $funcionarioV['foto'];
      }

      // Atualiza o funcionário no banco de dados
      update('funcionarios', $id, $funcionario);
      header('location: index.php');
      exit(); // Garante que o script seja finalizado após o redirecionamento
    } else {
      global $funcionario;
      $funcionario = $funcionarioV;
    }
  } else {
    header('location: index.php');
    exit(); // Garante que o script pare se o ID não estiver definido
  }
}



/**
 *  Exclusão de um Funcionário
 */
function delete($id = null)
{

  $funcionarioV = find('funcionarios', $id);
  unlink("../fotos/" . $funcionarioV["foto"]);

  global $funcionario;
  $funcionario = remove('funcionarios', $id);

  header('location: index.php');
}

function calcularIdade($birthdate)
{
  $birthDate = new DateTime($birthdate);
  $today = new DateTime();
  $age = $today->diff($birthDate);
  return $age->y;
}
