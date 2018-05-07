<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuariosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create')
        ;


        $validator
                ->scalar('nome')
                ->requirePresence('nome', 'create', 'Nome é obrigatório ')
                ->notEmpty('nome', 'Preencha nome');

        $validator
                ->scalar('status')
                ->requirePresence('status', 'create', 'Status é obrigatório')
                ->notEmpty('status', 'Preencha status');

        $validator
                ->scalar('login')
                ->requirePresence('login', 'create', 'Login é obrigatório')
                ->notEmpty('login', 'Preencha login');

        $validator
                ->scalar('senha')
                ->requirePresence('senha', 'create', 'Senha é obrigatório')
                ->notEmpty('senha', 'Preencha senha');

        $validator
            ->scalar('celular')
            ->requirePresence('celular', 'create', 'Campo celular é obrigatório')
            ->notEmpty('celular', 'Preencha campo celular');

        $validator
            ->scalar('cpf')
            ->requirePresence('cpf', 'create', 'Campo cpf é obrigatório')
            ->notEmpty('cpf', 'Campo cpf deve ser preenchido');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['login', 'cpf']));

        return $rules;
    }

}
