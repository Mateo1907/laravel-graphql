<?php

namespace App\GraphQL\Query\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\User;

class UsersPaginatedQuery extends Query
{
    protected $attributes = [
        'name' => 'UsersQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::paginate('user');
    }

    public function args()
    {
        return [
            'perPage' => [
                'name' => 'perPage',
                'type' => Type::int()
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $service = app()->make('UserService');

        if (!count($args)) {
            $args['perPage'] = 10;
            $args['page'] = 1;
        }

        return $service->paginate($args['perPage'], ['*'], 'page', $args['page']);
    }
}