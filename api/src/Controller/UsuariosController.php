<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security as Security;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[] paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login']);
$this->Auth->allow(['add']);

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $data = $this->paginate($this->Usuarios);

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }


    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                $this->set([
                    'success' => true,
                    'data' => [
                        'token' => $token = \Firebase\JWT\JWT::encode([
                            'sub' => $user['login'],
                            'exp' => time() + 604800,
                                ], Security::salt()),
                    ],
                    '_serialize' => ['success', 'data'],
                ]);
            } else {
                $this->response = $this->response->withStatus(400);
                $message[] = 'Usuário ou senha inválidos';
                $this->set(compact('message'));
                $this->set('_serialize', ['message']);
            }
        }
    }
	
 public function add() {
        $usuario = $this->Usuarios->newEntity($this->request->getData());

        if (!$this->Usuarios->save($usuario)) {
            $this->response = $this->response->withStatus(400);
            $message[] = $usuario->getValidationErrors();
            $this->set(compact('message'));
            $this->set('_serialize', ['message']);
            return;
        }

        $message[] = "Usuário salvo com sucesso!";
        $data['id'] = $usuario->id;
        $this->set(compact('message', 'data'));
        $this->set('_serialize', ['message', 'data']);
    }


}
