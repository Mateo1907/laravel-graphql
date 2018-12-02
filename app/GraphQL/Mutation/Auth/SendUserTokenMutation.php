<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class SendUserTokenMutation extends Mutation
{
    protected $attributes = [
        'name' => 'SendUserTokenMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::boolean();
    }

    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $userService = app()->make('UserService');
        $resetPasswordService = app()->make('PasswordResetService');

        $user = $userService->where(['email' => $args['email']])->first();

        if ($user) {
            return (bool)$resetPasswordService->sendUserToken($user);
        }
        return true;
        
    }
}