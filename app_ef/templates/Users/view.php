<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$identity = $this->getRequest()->getAttribute('identity');
$isAdmin = $identity && $identity->role === 'admin';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-person-circle text-primary"></i> Detalle del Usuario
        </h2>
        <p class="text-muted mb-0">Información del usuario</p>
    </div>
    <div class="btn-group">
        <?= $this->Html->link('<i class="bi bi-arrow-left"></i> Volver', 
            ['action' => 'index'], 
            ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        <?php if ($isAdmin): ?>
            <?= $this->Html->link('<i class="bi bi-pencil"></i> Editar', 
                ['action' => 'edit', $user->id], 
                ['class' => 'btn btn-warning', 'escape' => false]) ?>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-5">
                <div class="avatar bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 36px;">
                    <?= strtoupper(substr($user->nombre, 0, 1)) ?>
                </div>
                <h4><?= h($user->nombre . ' ' . $user->apellido) ?></h4>
                <p class="text-muted mb-2">
                    <i class="bi bi-envelope me-1"></i>
                    <?= h($user->correo) ?>
                </p>
                <div class="mb-2">
                    <?php if ($user->role === 'admin'): ?>
                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="bi bi-shield-star"></i> Administrador
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary px-3 py-2">
                            <i class="bi bi-person"></i> Usuario
                        </span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if ($user->active): ?>
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle"></i> Activo
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger px-3 py-2">
                            <i class="bi bi-x-circle"></i> Inactivo
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-info-circle text-primary me-2"></i>Información</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted" style="width: 150px;">
                                <i class="bi bi-hash me-2"></i>ID
                            </td>
                            <td class="fw-bold"><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-person me-2"></i>Nombre
                            </td>
                            <td><?= h($user->nombre) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-person me-2"></i>Apellido
                            </td>
                            <td><?= h($user->apellido) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-globe me-2"></i>Idioma
                            </td>
                            <td><?= h($user->language ?? 'No especificado') ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-calendar-plus me-2"></i>Fecha de creación
                            </td>
                            <td><?= $user->created->format('d/m/Y H:i') ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-pencil me-2"></i>Última modificación
                            </td>
                            <td><?= $user->modified->format('d/m/Y H:i') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php if ($isAdmin): ?>
            <div class="card-footer bg-white text-end">
                <?= $this->Form->postLink('<i class="bi bi-trash"></i> Eliminar Usuario', 
                    ['action' => 'delete', $user->id], 
                    [
                        'class' => 'btn btn-danger',
                        'escape' => false,
                        'confirm' => '¿Estás seguro de eliminar a ' . h($user->nombre) . ' ' . h($user->apellido) . '?'
                    ]) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.avatar {
    font-weight: bold;
}
</style>
