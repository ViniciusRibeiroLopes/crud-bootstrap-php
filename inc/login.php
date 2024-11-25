<?php
// Esse é o login.php
include('../config.php');
include(HEADER_TEMPLATE);
?>
<div id="login-form" class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="valida.php" method="post">
                        <!-- User input -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="log" placeholder="Usuário" name="login" required>
                            <label for="log">Usuário</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="pass" placeholder="Senha" name="senha" required>
                            <label for="pass">Senha</label>
                        </div>
                        <!-- Submit button -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-user-check"></i> Conectar
                            </button>
                            <a href="<?php echo BASEURL; ?>" class="btn btn-light">
                                <i class="fa-solid fa-rotate-left"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>