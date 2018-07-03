<?php

use Faker\Factory as Faker;
use App\Models\Curso;
use App\Repositories\CursoRepository;

trait MakeCursoTrait
{
    /**
     * Create fake instance of Curso and save it in database
     *
     * @param array $cursoFields
     * @return Curso
     */
    public function makeCurso($cursoFields = [])
    {
        /** @var CursoRepository $cursoRepo */
        $cursoRepo = App::make(CursoRepository::class);
        $theme = $this->fakeCursoData($cursoFields);
        return $cursoRepo->create($theme);
    }

    /**
     * Get fake instance of Curso
     *
     * @param array $cursoFields
     * @return Curso
     */
    public function fakeCurso($cursoFields = [])
    {
        return new Curso($this->fakeCursoData($cursoFields));
    }

    /**
     * Get fake data of Curso
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCursoData($cursoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $cursoFields);
    }
}
