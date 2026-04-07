<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Motocicleta $motocicleta
 */

$identity = $this->getRequest()->getAttribute('identity');
$isAdmin = $identity && $identity->role === 'admin';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-bicycle text-primary"></i> Detalle de Motocicleta
        </h2>
        <p class="text-muted mb-0">Información de la motorcycles</p>
    </div>
    <div class="btn-group">
        <?= $this->Html->link('<i class="bi bi-arrow-left"></i> Volver', 
            ['action' => 'index'], 
            ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        <?php if ($isAdmin): ?>
            <?= $this->Html->link('<i class="bi bi-pencil"></i> Editar', 
                ['action' => 'edit', $motocicleta->id], 
                ['class' => 'btn btn-warning', 'escape' => false]) ?>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-5">
                <?php if (!empty($motocicleta->imagen)): ?>
                    <img src="<?= $this->Url->build('/img/motocicletas/' . $motocicleta->imagen) ?>" 
                         alt="<?= h($motocicleta->marca) ?>" 
                         class="rounded mx-auto mb-3 d-block" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                <?php else: ?>
                    <div class="avatar bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 36px;">
                        <?= strtoupper(substr($motocicleta->marca, 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <h4><?= h($motocicleta->marca) ?></h4>
                <p class="text-muted mb-2">
                    <i class="bi bi-gear me-1"></i>
                    <?= h($motocicleta->cilindrada) ?> cc
                </p>
                <div class="mb-2">
                    <span class="badge bg-secondary px-3 py-2">
                        <i class="bi bi-calendar"></i> <?= h($motocicleta->anio) ?>
                    </span>
                </div>
                <div>
                    <span class="badge px-3 py-2" style="background-color: <?= h(strtolower($motocicleta->color)) ?>; color: <?= in_array(strtolower($motocicleta->color), ['white', 'blanco', '#fff', '#ffffff']) ? '#000' : '#fff' ?>;">
                        <i class="bi bi-palette"></i> <?= h($motocicleta->color) ?>
                    </span>
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
                            <td class="fw-bold"><?= $this->Number->format($motocicleta->id) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-tag me-2"></i>Marca
                            </td>
                            <td><?= h($motocicleta->marca) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-gear me-2"></i>Cilindrada
                            </td>
                            <td><?= h($motocicleta->cilindrada) ?> cc</td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-calendar me-2"></i>Año
                            </td>
                            <td><?= h($motocicleta->anio) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-palette me-2"></i>Color
                            </td>
                            <td><?= h($motocicleta->color) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-calendar-plus me-2"></i>Fecha de creación
                            </td>
                            <td><?= $motocicleta->created->format('d/m/Y H:i') ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <i class="bi bi-pencil me-2"></i>Última modificación
                            </td>
                            <td><?= $motocicleta->modified->format('d/m/Y H:i') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php if ($isAdmin): ?>
            <div class="card-footer bg-white text-end">
                <?= $this->Form->postLink('<i class="bi bi-trash"></i> Eliminar Motocicleta', 
                    ['action' => 'delete', $motocicleta->id], 
                    [
                        'class' => 'btn btn-danger',
                        'escape' => false,
                        'confirm' => '¿Estás seguro de eliminar la motorcycles ' . h($motocicleta->marca) . '?'
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