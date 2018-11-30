<?php

namespace App\GraphQL\Mutation\Post;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreatePostMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return \GraphQL::type('post');
    }

    public function authorize(array $args)
    {
        return (bool)auth()->user() && auth()->user()->hasRole('editor');
    }

    public function args()
    {
        return [
            'content' => [
                'name' => 'content',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $repository = app()->make('PostRepository');
        return $repository->create([
            'content' => $args['content'],
            'user_id' => auth()->user()->id
        ]);
    }
}