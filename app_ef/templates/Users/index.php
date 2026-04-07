<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */

$identity = $this->getRequest()->getAttribute('identity');
$isAdmin = $identity && $identity->role === 'admin';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-people text-primary"></i> Gestión de Usuarios
        </h2>
        <p class="text-muted mb-0">Administra los usuarios del sistema</p>
    </div>
    <?php if ($isAdmin): ?>
        <?= $this->Html->link('<i class="bi bi-plus-lg"></i> Nuevo Usuario', 
            ['action' => 'add'], 
            ['class' => 'btn btn-primary', 'escape' => false]) ?>
    <?php endif; ?>
</div>

<?php if ($users->isEmpty()): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3 text-muted">No hay usuarios registrados</h5>
            <?php if ($isAdmin): ?>
                <p class="text-muted">Comienza agregando el primer usuario</p>
                <?= $this->Html->link('<i class="bi bi-plus-lg"></i> Agregar Usuario', 
                    ['action' => 'add'], 
                    ['class' => 'btn btn-primary mt-2', 'escape' => false]) ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <span class="badge bg-primary rounded-pill">
                        <i class="bi bi-people"></i> <?= $this->Paginator->counter('{{count}}') ?> usuarios
                    </span>
                </div>
                <div class="col-auto">
                    <?= $this->Paginator->counter('Página {{page}} de {{pages}}') ?>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <?php if ($isAdmin): ?>
                                <th class="text-center pe-4">Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="ps-4 text-muted"><?= $this->Number->format($user->id) ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <?= strtoupper(substr($user->nombre, 0, 1)) ?>
                                    </div>
                                    <div>
                                        <strong><?= h($user->nombre . ' ' . $user->apellido) ?></strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-envelope text-muted me-1"></i>
                                <?= h($user->correo) ?>
                            </td>
                            <td>
                                <?php if ($user->role === 'admin'): ?>
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-shield-star"></i> Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-person"></i> Usuario
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($user->active): ?>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Activo
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Inactivo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small">
                                <?= $user->created->format('d/m/Y') ?>
                            </td>
                            <?php if ($isAdmin): ?>
                                <td class="text-center pe-4">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?= $this->Html->link('<i class="bi bi-eye"></i>', 
                                            ['action' => 'view', $user->id], 
                                            ['class' => 'btn btn-outline-primary', 'title' => 'Ver', 'escape' => false]) ?>
                                        <?= $this->Html->link('<i class="bi bi-pencil"></i>', 
                                            ['action' => 'edit', $user->id], 
                                            ['class' => 'btn btn-outline-warning', 'title' => 'Editar', 'escape' => false]) ?>
                                        <?= $this->Form->postLink('<i class="bi bi-trash"></i>', 
                                            ['action' => 'delete', $user->id], 
                                            [
                                                'class' => 'btn btn-outline-danger', 
                                                'title' => 'Eliminar',
                                                'escape' => false,
                                                'confirm' => '¿Eliminar a ' . h($user->nombre) . ' ' . h($user->apellido) . '?'
                                            ]) ?>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($this->Paginator->params()['pageCount'] > 1): ?>
        <div class="card-footer bg-white">
            <nav>
                <ul class="pagination justify-content-center mb-0">
                    <?= $this->Paginator->first('<i class="bi bi-chevron-double-left"></i>', ['escape' => false, 'class' => 'page-item', 'tag' => 'li']) ?>
                    <?= $this->Paginator->prev('<i class="bi bi-chevron-left"></i>', ['escape' => false, 'class' => 'page-item', 'tag' => 'li']) ?>
                    <?= $this->Paginator->numbers(['class' => 'page-item', 'tag' => 'li', 'currentTag' => 'span', 'currentClass' => 'active']) ?>
                    <?= $this->Paginator->next('<i class="bi bi-chevron-right"></i>', ['escape' => false, 'class' => 'page-item', 'tag' => 'li']) ?>
                    <?= $this->Paginator->last('<i class="bi bi-chevron-double-right"></i>', ['escape' => false, 'class' => 'page-item', 'tag' => 'li']) ?>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<style>
.avatar {
    font-size: 14px;
    font-weight: bold;
}
.pagination .page-link {
    color: #0d6efd;
}
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
