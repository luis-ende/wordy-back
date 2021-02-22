<?php

namespace App\Controller\Admin;

use App\Entity\Example;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;


class ExampleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Example::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('expression');
        yield TextAreaField::new('phrase');
    }    
}
