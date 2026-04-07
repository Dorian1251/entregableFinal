<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 */

$cakeDescription = 'Moto Center';
$identity = $this->getRequest()->getAttribute('identity');
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        }
        
        body {
            background-color: #f5f6fa;
            min-height: 100vh;
        }
        
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 600;
        }
        
        .nav-link {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 3px;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2);
        }
        
        .user-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 15px 15px 0 0 !important;
        }
        
        footer {
            background: white;
            border-top: 1px solid #f0f0f0;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }
        
        .btn-primary:hover {
            background: var(--primary-gradient);
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            border-bottom: 2px solid #f0f0f0;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        .pagination .page-link {
            color: #0d6efd;
            border-radius: 8px;
            margin: 0 3px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        
        .badge {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <?php if ($this->getRequest()->getParam('controller') === 'Login'): ?>
        <?= $this->fetch('content') ?>
    <?php else: ?>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?= $this->Url->build('/') ?>">
                    <i class="bi bi-bicycle me-2"></i>
                    <?= $cakeDescription ?>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php if ($identity): ?>
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <?php $isActive = ($currentController === 'Motocicletas') ? 'active' : ''; ?>
                                <?= $this->Html->link('<i class="bi bi-bicycle me-1"></i> Motocicletas', 
                                    ['controller' => 'Motocicletas', 'action' => 'index'], 
                                    ['class' => 'nav-link ' . $isActive, 'escape' => false]) ?>
                            </li>
                            <?php if ($identity->role === 'admin'): ?>
                            <li class="nav-item">
                                <?php $isActive = ($currentController === 'Users') ? 'active' : ''; ?>
                                <?= $this->Html->link('<i class="bi bi-people me-1"></i> Usuarios', 
                                    ['controller' => 'Users', 'action' => 'index'], 
                                    ['class' => 'nav-link ' . $isActive, 'escape' => false]) ?>
                            </li>
                            <!--<li class="nav-item">
                                <?= $this->Html->link('<i class="bi bi-plus-circle me-1"></i> Nueva Motocicleta', 
                                    ['controller' => 'Motocicletas', 'action' => 'add'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>-->
                            <?php endif; ?>
                        </ul>
                        
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown user-dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                    <div class="user-avatar me-2">
                                        <?= strtoupper(substr($identity->nombre, 0, 1)) ?>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <small class="d-block"><?= h($identity->nombre) ?></small>
                                        <span class="badge bg-<?= $identity->role === 'admin' ? 'warning text-dark' : 'light text-dark' ?>">
                                            <?= $identity->role === 'admin' ? '<i class="bi bi-shield-star"></i>' : '<i class="bi bi-person"></i>' ?>
                                            <?= ucfirst($identity->role) ?>
                                        </span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li class="px-3 py-2">
                                        <small class="text-muted"><?= h($identity->correo) ?></small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <?= $this->Html->link('<i class="bi bi-person me-2"></i>Mi Perfil', 
                                            ['controller' => 'Users', 'action' => 'view', $identity->id], 
                                            ['class' => 'dropdown-item', 'escape' => false]) ?>
                                    </li>
                                    <?php if ($identity->role === 'admin'): ?>
                                    <li>
                                        <?= $this->Html->link('<i class="bi bi-gear me-2"></i>Configuración', 
                                            ['controller' => 'Users', 'action' => 'edit', $identity->id], 
                                            ['class' => 'dropdown-item', 'escape' => false]) ?>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <?php endif; ?>
                                    <li>
                                        <?= $this->Html->link('<i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión', 
                                            ['controller' => 'Login', 'action' => 'logout'], 
                                            ['class' => 'dropdown-item text-danger', 'escape' => false]) ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión', 
                                    ['controller' => 'Login', 'action' => 'login'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>
            <?= $this->fetch('content') ?>
        </main>

        <footer>
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            <?= $cakeDescription ?> &copy; <?= date('Y') ?>
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">
                            <?php if ($identity): ?>
                                Última conexión: <?= date('d/m/Y H:i') ?>
                            <?php else: ?>
                                Sesión no iniciada
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            </div>
        </footer>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->fetch('script') ?>
</body>
</html>
