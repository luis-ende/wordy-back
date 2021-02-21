<?php

namespace App\Controller\Admin;

use App\Entity\Expression;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ExpressionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Expression::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('learningUnit'));
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('learningUnit');
        yield TextAreaField::new('textLanguage1');
        yield TextAreaField::new('textLanguage2');  
        yield NumberField::new('language1');
        yield NumberField::new('language2');
        yield NumberField::new('grammarType');
        yield BooleanField::new('isLearning');
        yield DateTimeField::new('learningUpdated')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y'), date('Y')),
                'widget' => 'single_text',
            ]);
    }
    
}
