<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication', [
            'logoutRedirect' => '/login',
        ]);
    }

    protected function isAdmin(): bool
    {
        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            return false;
        }
        return $identity->role === 'admin';
    }

    protected function isAuthenticated(): bool
    {
        return $this->Authentication->getIdentity() !== null;
    }
}
