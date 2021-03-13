<?php

namespace App\Controller\Admin;

use App\Entity\LearningUnit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LearningUnitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LearningUnit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
    }    
}
