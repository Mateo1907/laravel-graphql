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
                query posts {
                    postsPaginate(limit:5, page:2) {
                        data{
                            id,
                            content
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
        $this->assertInternalType('array', $response->getData()->data->postsPaginate->data);

    }
}
