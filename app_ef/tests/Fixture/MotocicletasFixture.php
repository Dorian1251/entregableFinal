<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MotocicletasFixture
 */
class MotocicletasFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'marca' => 'Lorem ipsum dolor sit amet',
                'cilindrada' => 1,
                'anio' => '',
                'color' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-04-06 01:07:16',
                'modified' => '2026-04-06 01:07:16',
            ],
        ];
        parent::init();
    }
}
