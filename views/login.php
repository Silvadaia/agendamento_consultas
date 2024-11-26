<?php
// Inicia a sessão
session_start();

// Verifica se já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: lista_usuarios.php");
    exit;
}

// Mensagem de erro para exibir no formulário (opcional)
$erro = isset($_GET['erro']) ? htmlspecialchars($_GET['erro']) : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center">Login</h2>
      
      <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro; ?></div>
      <?php endif; ?>

      <form action="../controllers/LoginController.php" method="POST">

        <div class="mb-3">
          <label for="email" class="form-label">E-mail:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <div class="mb-3">
          <label for="senha" class="form-label">Senha:</label>
          <input type="password" id="senha" name="senha" class="form-control" required>
        </div>
        
        <button type="submit" name="action" value="login" class="btn btn-primary w-100">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
