<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'A type',
        'model' => User::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user',
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post'))
            ]
        ];
    }
}