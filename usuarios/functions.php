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
 *  Criptografia
 */
function criptografia($senha)
{
    //==> Criptografia Blowfish
    //http://www.linhadecodigo.com.br/artigo/3332/criptografando-senhas-usando-bcrypt-blowfish-no-php.aspx

    // Aplicando criptografia na senha
    $custo = "08";
    $salt = "CflfllePArKlBJomMOF6aJ";

    // Gera um hash baseado em bcrypt
    $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

    return $hash; // retorna a senha criptografada
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
                $_SESSION['message'] = "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi armazenado.";
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
        $usuario = $_POST['usuario'];

        try {
            if (!empty($_FILES["foto"]["name"])) {
                // Upload da foto
                $pasta_destino = "fotos/"; //pasta onde ficam as fotos
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); //Caminho completo até o arquivo que será gravado
                $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                $nome_temp = $_FILES["foto"]["tmp_name"]; //nome e caminho do arquivo no servidor
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); //extensão do arquivo

                // Chamada da função upload para gravar a imagem
                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                $usuario['foto'] = $nomearquivo;
            }

            //criptografando a senha
            if (!empty($_POST['password'])) {
                $senha = criptografia($usuario['password']);
                $usuario['password'] = $senha;
            }

            save('usuarios', $usuario);
            header('Location: index.php');
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

            if (isset($_POST['usuario'])) {
                $usuario = $_POST['usuario'];

                //criptografando a senha
                if (!empty($_POST['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "fotos/"; //pasta onde ficam as fotos
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]); //Caminho completo até o arquivo que será gravado
                    $nomearquivo = basename($_FILES["foto"]["name"]); // nome do arquivo
                    $check = getimagesize($_FILES["foto"]["tmp_name"]);
                    $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["tmp_name"]; //nome e caminho do arquivo no servidor
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); //extensão do arquivo

                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                    $usuario['foto'] = $nomearquivo;
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
    $usuarios = remove('usuarios', $id);

    header('Location: index.php');
}

?>