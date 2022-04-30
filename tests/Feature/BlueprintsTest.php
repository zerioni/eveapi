<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Blueprint;

class BlueprintsTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function returns_collection_of_blueprints()
    {
        $response = $this->get('/api/blueprints?limit=15')
            ->assertStatus(200)
            ->assertJsonCount(15, 'data')
            ->assertJsonStructure([
                'data' =>
                [
                    '*' => [
                    'id',
                    'name',
                    'product',
                    'materials' => [
                       '*' => [
                        'id',
                        'name',
                        'quantity',
                        'baseprice',
                       ]
                    ],
                    'basecost',
                    'baseprofit'
                ]]
            ]);
    }

    /**
     * @test
     * @return void
     */
    public function returns_single_blueprint_details()
    {
        $response = $this->get('/api/blueprints/785')
         ->assertStatus(200)
         ->assertJsonStructure([
             '*' => [
                 'id',
                 'name',
                 'product',
                 'materials' => [
                    '*' => [
                     'id',
                     'name',
                     'quantity',
                     'baseprice',
                    ]
                 ],
                 'basecost',
                 'baseprofit'
             ]
         ]);
    }

    /**
     * @test
     * @return void
     */
    public function returns_keyword_search_results()
    {
        $response = $this->get('/api/blueprints/search/miner')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                '*' => [
                    'id',
                    'name',
                    'product',
                    'materials' => [
                       '*' => [
                        'id',
                        'name',
                        'quantity',
                        'baseprice',
                       ]
                    ],
                    'basecost',
                    'baseprofit'
                ]
                ]
            ]);
    }

    //tests for error status

    /**
     * @test
     * @return void
     */
    public function invalid_limit_variable_returns_default_pagination()
    {
        $resposne = $this->get('api/blueprints?limit=badvalue')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /**
     * @test
     * @return void
     */
    public function invalid_id_returns_json_not_404()
    {
        $response = $this->get('api/blueprints/00')
            ->assertJson([
                    'message' => 'Record not found.'

                ]);
    }

    /**
     * @test
     * @return void
     */
    public function no_results_for_keyword_returns_empty_set()
    {
        $response = $this->get('/api/blueprints/search/thisisnotinthedatabase')
        ->assertStatus(200)
        ->assertJson([
            'data'=>[]
        ]);
    }
}
