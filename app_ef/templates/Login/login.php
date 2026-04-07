<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
?>

<style>
.login-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    max-width: 420px;
    width: 100%;
}

.login-header {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    padding: 40px 30px;
    text-align: center;
    color: white;
}

.login-header i {
    font-size: 48px;
    margin-bottom: 10px;
}

.login-body {
    padding: 40px 30px;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.form-control {
    border-left: none;
    padding-left: 0;
}

.form-control:focus {
    border-color: #ced4da;
    box-shadow: none;
}

.input-group:focus-within .input-group-text {
    border-color: #0d6efd;
}

.input-group:focus-within .form-control:focus {
    border-color: #ced4da;
}

.form-control.is-invalid:focus {
    box-shadow: none;
}

.btn-login {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    border: none;
    padding: 12px;
    font-weight: 600;
    font-size: 16px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
}

.footer-text {
    text-align: center;
    margin-top: 20px;
    color: #6c757d;
    font-size: 14px;
}
</style>

<div class="login-page">
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-shield-lock"></i>
            <h3 class="mb-1">Bienvenido</h3>
            <p class="mb-0 opacity-75">Ingresa tus credenciales</p>
        </div>
        
        <div class="login-body">
            <?= $this->Flash->render() ?>
            
            <?= $this->Form->create(null, ['class' => 'needs-validation']) ?>
            
            <div class="mb-4">
                <label for="correo" class="form-label text-muted fw-medium">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-envelope text-primary"></i>
                    </span>
                    <?= $this->Form->text('correo', [
                        'class' => 'form-control border-start-0 ps-0',
                        'placeholder' => 'tu@correo.com',
                        'required' => true,
                        'autofocus' => true,
                    ]) ?>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-muted fw-medium">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-lock text-primary"></i>
                    </span>
                    <?= $this->Form->password('password', [
                        'class' => 'form-control border-start-0 border-end-0 ps-0',
                        'placeholder' => '••••••••',
                        'required' => true,
                        'id' => 'password-field',
                    ]) ?>
                    <button class="btn btn-outline-secondary border-start-0" type="button" id="toggle-password">
                        <i class="bi bi-eye text-muted" id="toggle-icon"></i>
                    </button>
                </div>
            </div>

            <?= $this->Form->button('Iniciar Sesión', [
                'class' => 'btn btn-primary btn-login w-100 text-white',
                'type' => 'submit',
                'escape' => false,
            ]) ?>

            <?= $this->Form->end() ?>
            
            <p class="footer-text">
                <i class="bi bi-info-circle me-1"></i>
                Sistema de Gestión de Usuarios
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password-field');
    const toggleIcon = document.getElementById('toggle-icon');
    
    if (toggleBtn && passwordField && toggleIcon) {
        toggleBtn.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            if (type === 'text') {
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
    }
});
</script>
