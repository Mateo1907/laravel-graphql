<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGraphQL()
    {
        $response = $this->call('GET','/graphql',[
            'query' => "
                query users {
                    users(perPage:5, page:1) {
                        data{
                            id,
                            user_name,
                            email
                        },
                        total,
                        per_page,
                        current_page
                    }
                }
            "
        ]);

        $response->assertStatus(200);
        $this->assertObjectHasAttribute('data', $response->getData());
        $this->assertInternalType('array', $response->getData()->data->users->data);

    }
}
