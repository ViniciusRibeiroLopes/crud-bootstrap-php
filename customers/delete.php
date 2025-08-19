<?php
require_once('functions.php'); // Importa o arquivo com funções auxiliares (provavelmente CRUD)

// Inicia a sessão, se ainda não tiver sido iniciada
if (!isset($_SESSION))
  session_start();

// ---------------- VERIFICAÇÃO DE LOGIN ----------------
if(isset($_SESSION['user'])){ // Se existir um usuário logado na sessão
  // Verifica se foi passado um ID pela URL
  if (isset($_GET['id'])) {
    delete($_GET['id']); // Chama a função 'delete' para excluir o registro com o ID informado
  } else {
    die("ERRO: ID não definido."); // Interrompe a execução e mostra erro se não houver ID
  }
} else {
  // Se o usuário NÃO estiver logado, redireciona para a página inicial
  header("Location: index.php");
}
?>
