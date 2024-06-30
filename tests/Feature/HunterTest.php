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
        $response = $this->post('/create-hunter', $hunter);
        $response->assertStatus(201);
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
        $response = $this->patch("/update-hunter/$hunter->_id", $atualizar_hunter);
        $response->assertStatus(200);
    }

    public function test_delete_hunter(): void
    {
        $id = "value_id";
        $hunter = HunterModel::find($id);
        $response = $this->delete("/delete-hunter/$hunter->_id");
        $response->assertStatus(204);
    }

    public function test_restore_hunter(): void
    {
        $id = "value_id";
        $hunter = HunterModel::onlyTrashed()->find($id);
        $response = $this->get("/restore-register-hunter/$hunter->_id");
        $response->assertStatus(200);
    }

}
