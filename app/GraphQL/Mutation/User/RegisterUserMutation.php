<?php

namespace App\GraphQL\Mutation\User;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RegisterUserMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return \GraphQL::type('user');
    }

    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'userName' => [
                'name' => 'userName',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'confirmPassword' => [
                'name' => 'confirmPassword',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'userName' => [
                'required'
            ],
            'password' =>[
                'required'
            ],
            'confirmPassword' => [
                'required',
                'same:password'
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $userService = app()->make('UserService');

        $payload = [
            'email' => $args['email'],
            'user_name' => $args['userName'],
            'password' => \Hash::make($args['password'])
        ];

        return $userService->register($payload);
    }
}