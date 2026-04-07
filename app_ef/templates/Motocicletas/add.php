<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Motocicleta $motocicleta
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-bicycle text-primary"></i> Nueva Motocicleta
        </h2>
        <p class="text-muted mb-0">Agrega una nueva motorcycles al sistema</p>
    </div>
    <?= $this->Html->link('<i class="bi bi-arrow-left"></i> Volver', 
        ['action' => 'index'], 
        ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="bi bi-bicycle me-2"></i>Datos de la Motocicleta</h5>
            </div>
            <div class="card-body">
                <?= $this->Form->create($motocicleta, ['type' => 'file']) ?>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="marca" class="form-label">
                            <i class="bi bi-tag text-muted me-1"></i>Marca <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('marca', [
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa la marca',
                            'required' => true,
                            'autofocus' => true,
                        ]) ?>
                        <?= $this->Form->error('marca', ['class' => 'text-danger small']) ?>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="cilindrada" class="form-label">
                            <i class="bi bi-gear text-muted me-1"></i>Cilindrada <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('cilindrada', [
                            'class' => 'form-control',
                            'placeholder' => 'Ej: 150',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->error('cilindrada', ['class' => 'text-danger small']) ?>
                    </div>
                </div>
                
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="anio" class="form-label">
                            <i class="bi bi-calendar text-muted me-1"></i>Año <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('anio', [
                            'class' => 'form-control',
                            'placeholder' => 'Ej: 2024',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->error('anio', ['class' => 'text-danger small']) ?>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="color" class="form-label">
                            <i class="bi bi-palette text-muted me-1"></i>Color <span class="text-danger">*</span>
                        </label>
                        <?= $this->Form->text('color', [
                            'class' => 'form-control',
                            'placeholder' => 'Ej: Negro',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->error('color', ['class' => 'text-danger small']) ?>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">
	                    <i class="bi bi-image text-muted me-1"></i>Imagen
                        </label>
                        <?= $this->Form->file('imagen', [
	                    'class' => 'form-control',
	                    'accept' => 'image/*',
                        ]) ?>
                        <?= $this->Form->error('imagen', ['class' => 'text-danger small']) ?>
                        <small class="text-muted">Formats: JPG, PNG, GIF</small>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="d-flex justify-content-end gap-2">
                    <?= $this->Html->link('<i class="bi bi-x-circle"></i> Cancelar', 
                        ['action' => 'index'], 
                        ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
                    <?= $this->Form->button(' Guardar', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit',
                        'escape' => false,
                    ]) ?>
                </div>
                
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>