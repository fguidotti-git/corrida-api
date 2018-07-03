<?php

use Faker\Factory as Faker;
use App\Models\Equipe;
use App\Repositories\EquipeRepository;

trait MakeEquipeTrait
{
    /**
     * Create fake instance of Equipe and save it in database
     *
     * @param array $equipeFields
     * @return Equipe
     */
    public function makeEquipe($equipeFields = [])
    {
        /** @var EquipeRepository $equipeRepo */
        $equipeRepo = App::make(EquipeRepository::class);
        $theme = $this->fakeEquipeData($equipeFields);
        return $equipeRepo->create($theme);
    }

    /**
     * Get fake instance of Equipe
     *
     * @param array $equipeFields
     * @return Equipe
     */
    public function fakeEquipe($equipeFields = [])
    {
        return new Equipe($this->fakeEquipeData($equipeFields));
    }

    /**
     * Get fake data of Equipe
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEquipeData($equipeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'imagem' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $equipeFields);
    }
}
