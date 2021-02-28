<?php

namespace App\Controller;

use App\Entity\Expression;
use Symfony\Component\Routing\Annotation\Route;

class AssignExpressionToLearningUnit 
{
    public function __construct() {}
    
    #[Route(        
        name: 'expressions_post_units',
        path: '/expressions/{id}/units',
        defaults: [
            '_api_resource_class' => Expression::class,
            '_api_collection_operation_name' => 'post'
        ],
        methods: ['POST'],
    )]
    public function __invoke(Expression $data): Expression 
    {
        return $data;
    }    
}