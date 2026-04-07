<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Motocicleta> $motocicletas
 */

$identity = $this->getRequest()->getAttribute('identity');
$isAdmin = $identity && $identity->role === 'admin';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-bicycle text-primary"></i> Gestión de Motocicletas
        </h2>
        <p class="text-muted mb-0">Administra las motorcycles del sistema</p>
    </div>
    <?php if ($isAdmin): ?>
        <?= $this->Html->link('<i class="bi bi-plus-lg"></i> Nueva Motocicleta', 
            ['action' => 'add'], 
            ['class' => 'btn btn-primary', 'escape' => false]) ?>
    <?php endif; ?>
</div>

<?php if ($motocicletas->isEmpty()): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3 text-muted">No hay motorcycles registradas</h5>
            <?php if ($isAdmin): ?>
                <p class="text-muted">Comienza agregando la primera motorcycles</p>
                <?= $this->Html->link('<i class="bi bi-plus-lg"></i> Agregar Motocicleta', 
                    ['action' => 'add'], 
                    ['class' => 'btn btn-primary mt-2', 'escape' => false]) ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($motocicletas as $motocicleta): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center">
                            <?php if (!empty($motocicleta->imagen)): ?>
                                <img src="<?= $this->Url->build('/img/motocicletas/' . $motocicleta->imagen) ?>" 
                                     alt="<?= h($motocicleta->marca) ?>" 
                                     class="rounded me-3" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                                <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 20px;">
                                    <?= strtoupper(substr($motocicleta->marca, 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h5 class="mb-0"><?= h($motocicleta->marca) ?></h5>
                                <small class="text-muted"><?= h($motocicleta->anio) ?></small>
                            </div>
                        </div>
                        <span class="badge" style="background-color: <?= h(strtolower($motocicleta->color)) ?>; color: <?= in_array(strtolower($motocicleta->color), ['white', 'blanco', '#fff', '#ffffff']) ? '#000' : '#fff' ?>;">
                            <i class="bi bi-palette"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-gear me-1"></i>Cilindrada</span>
                        <span class="fw-bold"><?= h($motocicleta->cilindrada) ?> cc</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-calendar me-1"></i>Año</span>
                        <span class="fw-bold"><?= h($motocicleta->anio) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted"><i class="bi bi-palette me-1"></i>Color</span>
                        <span class="badge bg-secondary"><?= h($motocicleta->color) ?></span>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <?= $this->Html->link('<i class="bi bi-eye"></i> Ver', 
                            ['action' => 'view', $motocicleta->id], 
                            ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                        <?php if ($isAdmin): ?>
                        <div class="btn-group btn-group-sm">
                            <?= $this->Html->link('<i class="bi bi-pencil"></i>', 
                                ['action' => 'edit', $motocicleta->id], 
                                ['class' => 'btn btn-outline-warning', 'title' => 'Editar', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="bi bi-trash"></i>', 
                                ['action' => 'delete', $motocicleta->id], 
                                [
                                    'class' => 'btn btn-outline-danger', 
                                    'title' => 'Eliminar',
                                    'escape' => false,
                                    'confirm' => '¿Eliminar la motorcycles ' . h($motocicleta->marca) . '?'
                                ]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php if ($this->Paginator->params()['pageCount'] > 1): ?>
    <div class="card shadow-sm border-0">
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
    </div>
    <?php endif; ?>
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