<?php

namespace App\Controller\Admin;

use App\Entity\LearningUnit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LearningUnitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LearningUnit::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
