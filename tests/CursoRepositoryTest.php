<?php

use App\Models\Curso;
use App\Repositories\CursoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CursoRepositoryTest extends TestCase
{
    use MakeCursoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CursoRepository
     */
    protected $cursoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cursoRepo = App::make(CursoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCurso()
    {
        $curso = $this->fakeCursoData();
        $createdCurso = $this->cursoRepo->create($curso);
        $createdCurso = $createdCurso->toArray();
        $this->assertArrayHasKey('id', $createdCurso);
        $this->assertNotNull($createdCurso['id'], 'Created Curso must have id specified');
        $this->assertNotNull(Curso::find($createdCurso['id']), 'Curso with given id must be in DB');
        $this->assertModelData($curso, $createdCurso);
    }

    /**
     * @test read
     */
    public function testReadCurso()
    {
        $curso = $this->makeCurso();
        $dbCurso = $this->cursoRepo->find($curso->id);
        $dbCurso = $dbCurso->toArray();
        $this->assertModelData($curso->toArray(), $dbCurso);
    }

    /**
     * @test update
     */
    public function testUpdateCurso()
    {
        $curso = $this->makeCurso();
        $fakeCurso = $this->fakeCursoData();
        $updatedCurso = $this->cursoRepo->update($fakeCurso, $curso->id);
        $this->assertModelData($fakeCurso, $updatedCurso->toArray());
        $dbCurso = $this->cursoRepo->find($curso->id);
        $this->assertModelData($fakeCurso, $dbCurso->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCurso()
    {
        $curso = $this->makeCurso();
        $resp = $this->cursoRepo->delete($curso->id);
        $this->assertTrue($resp);
        $this->assertNull(Curso::find($curso->id), 'Curso should not exist in DB');
    }
}
