<?php
//esse é o functions.php
include("../config.php");
include(DBAPI);

$usuario = null;
$usuarios = null;

/**
 *  Listagem de Usuários
 */
function index()
{
    global $usuarios;
    if (!empty($_POST['users'])) {
        $usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'"); //"nome like '%{$_POST['users']}%'"
    } else {
        $usuarios = find_all("usuarios");
    }
}

/**
 *  Upload de imagens
 */
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo)
{
    /**
     *  Upload de arquivos no PHP
     *  http://www.w3schools.com/php/php_file_upload.asp
     */

    // Upload da foto
    try {
        $nomearquivo = basename($arquivo_destino); // nome do arquivo
        $uploadOk = 1;

        // Verificando se o arquivo é uma imagem
        if (isset($_POST["submit"])) {
            $check = getimagesize($nome_temp);
            if ($check !== false) {
                $_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
                $_SESSION['type'] = "info";
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                throw new Exception("O arquivo não é uma imagem!");
            }
        }

        // Verificando se o arquivo já existe na pasta
        if (file_exists($arquivo_destino)) {
            $uploadOk = 0;
            throw new Exception("Desculpe, o arquivo já existe!");
            //echo "Desculpe, o arquivo já existe.";
        }

        // Verificando se o tamanho do arquivo
        if ($tamanho_arquivo > 5000000) {
            $uploadOk = 0;
            throw new Exception("Desculpe, mas o arquivo é muito grande!");
            //echo "Desculpe, mas o arquivo é muito grande.";
        }

        // Allow certain file formats
        if (
            $tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg"
            && $tipo_arquivo != "gif"
        ) {
            $uploadOk = 0;
            throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
            //echo "Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
            //echo "Desculpe, mas o arquivo não pode ser enviado.";
        } else {
            // Se tudo estiver OK, tentamos fazer o upload do arquivo
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $arquivo_destino)) {
                //colocando o nome do arquivo da foto do usuário no vetor
                $_SESSION['message'] = "O arquivo " . htmlspecialchars(basename($nomearquivo)) . " foi armazenado.";
                $_SESSION['type'] = "success";
                //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
                //echo "Sorry, there was an error uploading your file.";
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}
/**
 *  Cadastro de Usuários
 */
function add()
{
    if (!empty($_POST['usuario'])) {
        try {
            $usuario = $_POST['usuario'];

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
                    $usuario['foto'] = $imageName; // Armazena o caminho relativo no banco de dados
                } else {
                    $_SESSION['message'] = "Erro ao carregar a imagem.";
                    $_SESSION['type'] = 'danger';
                    return;
                }
            }

            //criptografando a senha
            if (!empty($usuario['password'])) {
                $senha = criptografia($usuario['password']);
                $usuario['password'] = $senha;
            }

            save('usuarios', $usuario);
            header('Location: index.php');
            exit(); // Adiciona exit() para garantir que o script pare após o redirecionamento
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

/**
 *  Atualizacao/Edicao de Usuarios
 */
function edit()
{
    //$now = new DateTime("now");
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $usuarioV = find('usuarios', $id);

            if (isset($_POST['usuario'])) {
                $usuario = $_POST['usuario'];

                //criptografando a senha
                if (!empty($_POST['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                // Processa a imagem enviada
                if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                    $uploadDir = dirname(__DIR__) . '/fotos/';
                    $imageName = basename($_FILES['foto']['name']);
                    $imagePath = $uploadDir . $imageName;

                    // Move a nova imagem para o diretório
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath)) {
                        // Apaga a imagem antiga, se existir
                        if (!empty($usuarioV['foto'])) {
                            unlink($uploadDir . $usuarioV['foto']);
                        }
                        $usuario['foto'] = $imageName; // Atualiza a nova imagem
                    } else {
                        $_SESSION['message'] = "Erro ao atualizar a imagem.";
                        $_SESSION['type'] = 'danger';
                        return;
                    }
                } else {
                    // Mantém a imagem existente se nenhuma nova for enviada
                    $usuario['foto'] = $usuarioV['foto'];
                }

                update('usuarios', $id, $usuario);
                header('Location: index.php');
            } else {
                global $usuario;
                $usuario = find("usuarios", $id);
            }
        } else {
            header('Location: index.php');
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
 *  Visualizacao de um Usuários
 */
function view($id = null)
{
    global $usuario;
    $usuario = find('usuarios', $id);
}

/**
 *  Exclusão de um Usuário
 */
function delete($id = null)
{
    global $usuarios;
    $usuarios = remove("usuarios", $id);

    header('Location: index.php');
}
