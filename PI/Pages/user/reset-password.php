<?php
require_once __DIR__ . '/../../App/DB/Database.php';
require_once __DIR__ . '/../../App/Entity/PasswordReset.php';


if(isset($_GET['email']) && isset($_GET['key']) ){
  $email = $_GET['email'];
  $key   = $_GET['key'];
}

$error = '';
$success = '';

// Early check
if (!$email || !$key) {
    $error = '<h2>Invalid or Expired Link</h2>';
} else {
    $db = new Database(realpath(__DIR__));
    $pr = new PasswordReset($db, $email, $key);

    // Validate link on GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !$pr->isLinkValid()) {
        $error = '<h2>Invalid or Expired Link</h2>';
    }

    // Handle POST update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update') {
        $p1 = $_POST['pass1'] ?? '';
        $p2 = $_POST['pass2'] ?? '';

        if (strlen($p1) < 8) {
            $error = '<p>Password must be at least 8 characters long.</p>';
        } elseif ($p1 !== $p2) {
            $error = '<p>Passwords don\'t match!</p>';
        } elseif ($pr->updatePassword($p1)) {
            $success = '<p>Password updated! <a href="login.php">Login here</a></p>';
        } else {
            $error = '<p>Update failed. Please try again later.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Redefinição de Senha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { font-family:Poppins,sans-serif; background:#f8f9fa; display:flex;
      align-items:center; justify-content:center; min-height:100vh; }
    .signup-form { background:#fff; padding:2rem; border-radius:.5rem;
      box-shadow:0 .5rem 1rem rgba(0,0,0,.1); max-width:420px; width:100%; }
    .toggle-password { cursor:pointer; }
  </style>
</head><body>
<div class="signup-form">
  <h2 class="text-center mb-4">Redefinição de senha</h2>
  <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div>
  <?php elseif ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

  <?php if (!$success): ?>
  <form id="resetForm" method="post" novalidate>
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>">

    <?php foreach (['pass1'=>'Nova Senha','pass2'=>'Confirme a nova Senha'] as $name=>$label): ?>
    <div class="mb-3">
      <label class="form-label" for="<?= $name ?>"><?= $label ?></label>
      <div class="input-group">
        <input type="password" id="<?= $name ?>" name="<?= $name ?>" class="form-control"
               placeholder="Digite sua senha" required minlength="8">
        <span class="input-group-text toggle-password"><i class="fa fa-eye"></i></span>
      </div>
    </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-danger w-100">Enviar</button>
  </form>
  <?php endif; ?>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggle = () => {
  document.querySelectorAll('.toggle-password').forEach(el=>el.addEventListener('click',()=>{
    const i=el.closest('.input-group').querySelector('input');
    const ic=el.querySelector('i');
    ic.classList.toggle('fa-eye-slash');
    i.type = i.type==='password'?'text':'password';
  }));
}; toggle();

const toast = (t,tit,msg) => {
  const d=document.createElement('div');
  d.className=`toast align-items-center text-bg-${t} border-0`;
  d.setAttribute('role','alert');d.setAttribute('aria-live','assertive');d.setAttribute('aria-atomic','true');
  d.innerHTML=`<div class="d-flex"><div class="toast-body"><strong>${tit}:</strong> ${msg}</div>`+
              `<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
  document.getElementById('toastContainer').append(d);
  new bootstrap.Toast(d,{delay:5000}).show();
};

// Validate
document.getElementById('resetForm').addEventListener('submit',e=>{
  const p1= e.target.pass1.value.trim(), p2= e.target.pass2.value.trim();
  if(p1.length<8){e.preventDefault();toast('danger','Erro','Senha deve ter ao menos 8 caracteres.');}
  else if(p1!==p2){e.preventDefault();toast('danger','Erro','As senhas não correspondem.');}
});
</script></body></html>