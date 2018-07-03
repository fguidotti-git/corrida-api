<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EquipeApiTest extends TestCase
{
    use MakeEquipeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEquipe()
    {
        $equipe = $this->fakeEquipeData();
        $this->json('POST', '/api/v1/equipes', $equipe);

        $this->assertApiResponse($equipe);
    }

    /**
     * @test
     */
    public function testReadEquipe()
    {
        $equipe = $this->makeEquipe();
        $this->json('GET', '/api/v1/equipes/'.$equipe->id);

        $this->assertApiResponse($equipe->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEquipe()
    {
        $equipe = $this->makeEquipe();
        $editedEquipe = $this->fakeEquipeData();

        $this->json('PUT', '/api/v1/equipes/'.$equipe->id, $editedEquipe);

        $this->assertApiResponse($editedEquipe);
    }

    /**
     * @test
     */
    public function testDeleteEquipe()
    {
        $equipe = $this->makeEquipe();
        $this->json('DELETE', '/api/v1/equipes/'.$equipe->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/equipes/'.$equipe->id);

        $this->assertResponseStatus(404);
    }
}
