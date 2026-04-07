<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Motocicletas Model
 *
 * @method \App\Model\Entity\Motocicleta newEmptyEntity()
 * @method \App\Model\Entity\Motocicleta newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Motocicleta> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Motocicleta get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Motocicleta findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Motocicleta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Motocicleta> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Motocicleta|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Motocicleta saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Motocicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Motocicleta>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Motocicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Motocicleta> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Motocicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Motocicleta>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Motocicleta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Motocicleta> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MotocicletasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('motocicletas');
        $this->setDisplayField('marca');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('marca')
            ->maxLength('marca', 100)
            ->requirePresence('marca', 'create')
            ->notEmptyString('marca');

        $validator
            ->integer('cilindrada')
            ->requirePresence('cilindrada', 'create')
            ->notEmptyString('cilindrada');

        $validator
            ->requirePresence('anio', 'create')
            ->notEmptyString('anio');

        $validator
            ->scalar('color')
            ->maxLength('color', 50)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');
        $validator
            ->scalar('imagen')
            ->maxLength('imagen', 255)
            ->allowEmptyFile('imagen');

        return $validator;
    }
}
