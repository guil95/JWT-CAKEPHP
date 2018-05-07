<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $login
 * @property string $senha
 */
class Usuario extends AppEntity {

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 0;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        "*" => "*"
    ];

    protected function _setSenha($senha) {
        return (new DefaultPasswordHasher)->hash($senha);
    }

}
