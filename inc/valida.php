<?php
// Esse é o valida.php
include("../config.php");
require_once(DBAPI);

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) and (empty($_POST['login']) OR empty($_POST['senha']))) {
    header('Location: ' . BASEURL . 'index.php');
    exit;
}

// Tenta se conectar a um banco de dados MySQL
$bd = open_database();
try {

    $bd->select_db(DB_NAME);
    // Pegando o login e senha digitado no form
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];
    // Testando para ver se o login e senha digitado no form não estão vazios
    if (!empty($usuario) && !empty($senha)) {
        // Agora pegamos a senha digitada e criptografamos ela para poder comparar
        // Para essa criptografia FOI MOVIDA para o arquivo database.php (DBAPI)
        $senha = criptografia($_POST['senha']);

        // Validar o usuário/senha digitados
        $sql = "SELECT id, nome, user, password, foto FROM usuarios WHERE (user = '" . $usuario . "') AND (password = '" . $senha . "') LIMIT 1;";
        $query = $bd->query($sql);
        // Verificamos se retornou algo
        if ($query->num_rows > 0) {
            // Pegamos os dados
            $dados = $query->fetch_assoc();
            echo "<b>";
            echo "</b>";
            $id = $dados['id'];
            $nome = $dados['nome'];
            $user = $dados['user'];
            $password = $dados['password'];
            $foto = $dados['foto'];

            // Verifica se user não está vazio
            if (!empty($user)) {
                if (!isset($_SESSION)) session_start();
                $_SESSION['message'] = "Seja bem vindo " . $nome . "!";
                $_SESSION['type'] = "info";
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $user;
                $_SESSION['foto'] = $foto;
                echo "<b>";

                echo "<b/>";
            } else {
                // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
                throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
            }
            // Direciona para o index do site
            header('Location: ' . BASEURL . 'index.php');
        } else {
            // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
            throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
        }
    } else {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Ocorreu um erro: " . $e->GetMessage();
    $_SESSION['type'] = "danger";
}

include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php clear_messages(); ?>
<?php endif; ?>
<hr>
<header>
    <a href="<?php echo BASEURL; ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
</header>

<?php include(FOOTER_TEMPLATE); ?>