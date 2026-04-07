<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;

class LoginController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['login', 'index']);
    }

    public function login()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $redirect = $this->request->getQuery('redirect', '/motocicletas');
            return $this->redirect($redirect);
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Correo o contraseña incorrectos.');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        $this->Flash->success('Has cerrado sesión correctamente.');
        return $this->redirect(['controller' => 'Login', 'action' => 'login']);
    }
    public function index()
    {
        return $this->redirect(['action' => 'login']);
    }
}
