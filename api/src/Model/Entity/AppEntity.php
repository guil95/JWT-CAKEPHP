<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class AppEntity extends Entity {

    public function getValidationErrors() {
        $message = [];
        foreach ($this->errors() as $campo => $regra) {
            foreach ($regra as $nome => $msg) {
                $nomeSoLetras = preg_replace('/[^a-zA-Z0-9]+/', '', $nome);
                $message[$campo][$nomeSoLetras] = $msg;
            }
        }
        return $message;
    }

    public function getValidationErrorsString() {
        $errors = $this->getValidationErrors();
        $msg = [];
        foreach ($errors as $campo => $regra) {
            foreach ($regra as $message) {
                $msg[] = strtoupper($campo) . ': ' . nl2br($message);
            }
        }
        return join('<br>', $msg);
    }

}
