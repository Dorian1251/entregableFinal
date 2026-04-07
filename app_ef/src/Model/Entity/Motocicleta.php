<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Motocicleta Entity
 *
 * @property int $id
 * @property string $marca
 * @property int $cilindrada
 * @property string $anio
 * @property string $color
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class Motocicleta extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'marca' => true,
        'cilindrada' => true,
        'anio' => true,
        'color' => true,
        'imagen' => true,
        'created' => true,
        'modified' => true,
    ];
}
