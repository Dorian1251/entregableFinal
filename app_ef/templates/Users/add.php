<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-person-plus text-success"></i> Nuevo Usuario
        </h2>
        <p class="text-muted mb-0">Agrega un nuevo usuario al sistema</p>
    </div>
    <?= $this->Html->link('<i class="bi bi-arrow-left"></i> Volver', 
        ['action' => 'index'], 
        ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white py-3">
                <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i>Datos del Usuario</h5>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'needs-validation']) ?>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person text-muted me-1"></i>Nombre <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('nombre', [
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el nombre',
                            'required' => true,
                            'autofocus' => true,
                        ]) ?>
                        <?= $this->Form->error('nombre', ['class' => 'text-danger small']) ?>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">
                            <i class="bi bi-person text-muted me-1"></i>Apellido <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('apellido', [
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el apellido',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->error('apellido', ['class' => 'text-danger small']) ?>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label for="correo" class="form-label">
                        <i class="bi bi-envelope text-muted me-1"></i>Correo Electrónico <span class="text-danger">*</span>
                    </label>
                    <?= $this->Form->email('correo', [
                        'class' => 'form-control',
                        'placeholder' => 'correo@ejemplo.com',
                        'required' => true,
                    ]) ?>
                    <?= $this->Form->error('correo', ['class' => 'text-danger small']) ?>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock text-muted me-1"></i>Contraseña <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <?= $this->Form->password('password', [
                                'class' => 'form-control',
                                'placeholder' => 'Mínimo 6 caracteres',
                                'required' => true,
                                'id' => 'password-field',
                            ]) ?>
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                <i class="bi bi-eye" id="toggle-icon"></i>
                            </button>
                        </div>
                        <?= $this->Form->error('password', ['class' => 'text-danger small']) ?>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="role" class="form-label">
                            <i class="bi bi-shield text-muted me-1"></i>Rol <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->select('role', ['user' => 'Usuario', 'admin' => 'Administrador'], [
                            'class' => 'form-select',
                            'default' => 'user',
                        ]) ?>
                        <?= $this->Form->error('role', ['class' => 'text-danger small']) ?>
                    </div>
                </div>
                
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="language" class="form-label">
                            <i class="bi bi-globe text-muted me-1"></i>Idioma
                        </label>
                        <?= $this->Form->select('language', [
                            'es' => 'Español',
                            'en' => 'English',
                        ], [
                            'class' => 'form-select',
                            'empty' => 'Seleccionar idioma',
                        ]) ?>
                        <?= $this->Form->error('language', ['class' => 'text-danger small']) ?>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="d-flex justify-content-end gap-2">
                    <?= $this->Html->link('<i class="bi bi-x-circle"></i> Cancelar', 
                        ['action' => 'index'], 
                        ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
                    <?= $this->Form->button(' Guardar', [
                        'class' => 'btn btn-success',
                        'type' => 'submit',
                        'escape' => false,
                    ]) ?>
                </div>
                
                <?= $this->Form->end() ?>
            </div>
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
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    }
});
</script>
