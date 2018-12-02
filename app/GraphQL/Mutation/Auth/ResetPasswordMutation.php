<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class ResetPasswordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'ResetPasswordMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::boolean();
    }

    public function args()
    {
        return [
            'token' => [
                'name' => 'token',
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
            'token' => [
                'required',
                'exists:password_resets,token'
            ],
            'password' => [
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
        $passwordResetService = app()->make('PasswordResetService');

        try {
            $token = $passwordResetService->where(['token' => $args['token']])->first();
        
            if (!$token) {
                return true;
            }
            $token->user()->update([
                'password' => \Hash::make($args['password'])
            ]);
            return true;
        } catch (\Exception $e) {
            \Log::debug('[ResetPasswordMutation] error', ['msg' => $e->getMessage()]);
            return true;
        }
        
    }
}