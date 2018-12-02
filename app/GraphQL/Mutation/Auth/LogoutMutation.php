<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LogoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LogoutMutation',
        'description' => 'A mutation'
    ];

    public function authorize(array $args)
    {
        return (bool)auth()->user();
    }

    public function type()
    {
        return Type::boolean();
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return (bool)auth()->guard()->logout();
    }
}