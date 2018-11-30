<?php

namespace App\GraphQL\Query\Post;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use App\Post;

class PostsPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'PostsPaginateQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::paginate('post');
    }

    public function args()
    {
        return [
            'limit' => [
                'name' => 'limit',
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
        $service = app()->make('PostService');

        return $service->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}