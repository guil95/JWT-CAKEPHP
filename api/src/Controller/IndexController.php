<?php
namespace App\Controller;

use App\Controller\AppController;


class IndexController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index']);

    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $message = "JWT";

        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }
}
