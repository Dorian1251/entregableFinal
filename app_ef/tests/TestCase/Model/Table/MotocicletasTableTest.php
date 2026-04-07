<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MotocicletasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MotocicletasTable Test Case
 */
class MotocicletasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MotocicletasTable
     */
    protected $Motocicletas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Motocicletas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Motocicletas') ? [] : ['className' => MotocicletasTable::class];
        $this->Motocicletas = $this->getTableLocator()->get('Motocicletas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Motocicletas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\MotocicletasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
