<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\{RefreshDatabase,WithFaker};
use Tests\TestCase;
use App\Models\HunterModel;

class HunterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_list_hunters(): void
    {
        $hunters = HunterModel::all();
        $hunters->each(function ($hunter) {
            echo "ID: {$hunter->_id} | Nome: {$hunter->nome_hunter} | Idade: {$hunter->idade_hunter} | Altura: {$hunter->altura_hunter} | Peso: {$hunter->peso_hunter} | Tipo de Hunter: {$hunter->tipo_hunter_id} | Tipo de Nen: {$hunter->tipo_nen_id} | Tipo sanguíneo: {$hunter->tipo_sangue_id}\n";
        });
    }

    public function test_create_hunter(): void
    {
        $hunter = [
            'nome_hunter' => "Gon Freecs",
            'idade_hunter' => 13,
            'altura_hunter' => 1.50,
            'peso_hunter' => 60.50,
            'tipo_hunter_id' => "value_id",
            'tipo_nen_id' => "value_id",
            'tipo_sangue_id' => "value_id",
            'inicio' => "2024-07-01",
            'termino' => "2025-01-01",
        ];
        $this->post('/create-hunter', $hunter);
        //$response->assertStatus(201);
    }

    public function test_update_hunter(): void
    {
        $id = "value_id";
        $hunter = HunterModel::find($id);
        $atualizar_hunter = [
            'nome_hunter' => "Gon Freecs",
            'idade_hunter' => 15,
            'altura_hunter' => 1.50,
            'peso_hunter' => 60.50,
            'tipo_hunter_id' => "value_id",
            'tipo_nen_id' => "value_id",
            'tipo_sangue_id' => "value_id",
            'inicio' => "2024-07-01",
            'termino' => "2025-01-01",
        ];
        $this->patch("/update-hunter/$hunter->_id", $atualizar_hunter);
        //$response->assertStatus(200);
    }

    public function test_delete_hunter(): void
    {
        $id = "value_id";
        $hunter = HunterModel::find($id);
        $this->delete("/delete-hunter/$hunter->_id");
        //$response->assertStatus(204);
    }

    public function test_search_hunter(): void
    {
        $filtro = "Gon";
        $this->get("/search-hunter?search=$filtro");
        $hunters = HunterModel::where('nome_hunter', 'regex', "/$filtro/i")->get();
        $hunters->each(function ($hunter) {
            echo "ID: {$hunter->_id} | Nome: {$hunter->nome_hunter} | Idade: {$hunter->idade_hunter} | Altura: {$hunter->altura_hunter} | Peso: {$hunter->peso_hunter} | Tipo de Hunter: {$hunter->tipo_hunter_id} | Tipo de Nen: {$hunter->tipo_nen_id} | Tipo sanguíneo: {$hunter->tipo_sangue_id}\n";
        });
    }

    public function test_list_trash_hunters(): void
    {
        $hunters = HunterModel::onlyTrashed()->get();
        $hunters->each(function ($hunter) {
            echo "ID: {$hunter->_id} | Nome: {$hunter->nome_hunter} | Idade: {$hunter->idade_hunter} | Altura: {$hunter->altura_hunter} | Peso: {$hunter->peso_hunter} | Tipo de Hunter: {$hunter->tipo_hunter_id} | Tipo de Nen: {$hunter->tipo_nen_id} | Tipo sanguíneo: {$hunter->tipo_sangue_id} | Data de exclusão: {$hunter->deleted_at}\n";
        });
    }

    public function test_restore_hunter(): void
    {
        $id = "value_id";
        $hunter = HunterModel::onlyTrashed()->find($id);
        $this->get("/restore-register-hunter/$hunter->_id");
        //$response->assertStatus(200);
    }

    public function test_search_trash_hunter(): void
    {
        $filtro = "value";
        $this->get("/search-hunter-trash?search=$filtro");
        $hunters = HunterModel::onlyTrashed()->where('nome_hunter', 'regex', "/$filtro/i")->get();
        $hunters->each(function ($hunter) {
            echo "ID: {$hunter->_id} | Nome: {$hunter->nome_hunter} | Idade: {$hunter->idade_hunter} | Altura: {$hunter->altura_hunter} | Peso: {$hunter->peso_hunter} | Tipo de Hunter: {$hunter->tipo_hunter_id} | Tipo de Nen: {$hunter->tipo_nen_id} | Tipo sanguíneo: {$hunter->tipo_sangue_id} | Data de exclusão: {$hunter->deleted_at}\n";
        });
    }

}
