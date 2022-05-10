<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ImagesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('images');
        $this->setDisplayField('path');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('path')
            ->maxLength('path', 50)
            ->allowEmptyString('path');

        $validator
            ->email('description')
            ->maxLength('description', 1024)
            ->allowEmptyString('description');

        $validator
            ->integer('width')
            ->allowEmptyString('width');

        $validator
            ->integer('height')
            ->allowEmptyString('height');

        $validator
            ->scalar('author')
            ->maxLength('author', 50)
            ->allowEmptyString('author');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['path']), ['errorField' => 'path']);

        return $rules;
    }
}
