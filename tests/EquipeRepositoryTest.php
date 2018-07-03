<?php

use App\Models\Equipe;
use App\Repositories\EquipeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EquipeRepositoryTest extends TestCase
{
    use MakeEquipeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EquipeRepository
     */
    protected $equipeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->equipeRepo = App::make(EquipeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEquipe()
    {
        $equipe = $this->fakeEquipeData();
        $createdEquipe = $this->equipeRepo->create($equipe);
        $createdEquipe = $createdEquipe->toArray();
        $this->assertArrayHasKey('id', $createdEquipe);
        $this->assertNotNull($createdEquipe['id'], 'Created Equipe must have id specified');
        $this->assertNotNull(Equipe::find($createdEquipe['id']), 'Equipe with given id must be in DB');
        $this->assertModelData($equipe, $createdEquipe);
    }

    /**
     * @test read
     */
    public function testReadEquipe()
    {
        $equipe = $this->makeEquipe();
        $dbEquipe = $this->equipeRepo->find($equipe->id);
        $dbEquipe = $dbEquipe->toArray();
        $this->assertModelData($equipe->toArray(), $dbEquipe);
    }

    /**
     * @test update
     */
    public function testUpdateEquipe()
    {
        $equipe = $this->makeEquipe();
        $fakeEquipe = $this->fakeEquipeData();
        $updatedEquipe = $this->equipeRepo->update($fakeEquipe, $equipe->id);
        $this->assertModelData($fakeEquipe, $updatedEquipe->toArray());
        $dbEquipe = $this->equipeRepo->find($equipe->id);
        $this->assertModelData($fakeEquipe, $dbEquipe->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEquipe()
    {
        $equipe = $this->makeEquipe();
        $resp = $this->equipeRepo->delete($equipe->id);
        $this->assertTrue($resp);
        $this->assertNull(Equipe::find($equipe->id), 'Equipe should not exist in DB');
    }
}
