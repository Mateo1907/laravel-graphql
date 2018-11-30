<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LoginMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => [
                    'required'
                ]
            ], 
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
                'rules' => [
                    'required'
                ]
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return \Auth::guard()->attempt([
            'email' => $args['email'], 
            'password' => $args['password']
        ]);
    }
}