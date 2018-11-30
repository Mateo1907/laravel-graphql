<?php

namespace App\GraphQL\Type;

use App\Post;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'A type',
        'model' => Post::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            'content' => [
                'type' => Type::string()
            ]
        ];
    }
}