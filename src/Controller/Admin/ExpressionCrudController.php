<?php

namespace App\Controller\Admin;

use App\Entity\Expression;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
        yield ChoiceField::new('language1')
            ->setChoices([
                'german' => 1,
                'spanish' => 2,
                'english' => 3,
            ]);        
        yield ChoiceField::new('language2')
            ->setChoices([
                'german' => 1,
                'spanish' => 2,
                'english' => 3,
            ]);                        
        yield ChoiceField::new('grammarType')
        ->setChoices([
            'Noun' => 1,
            'Verb' => 2,
            'Adjective' => 3,
            'Adverb' => 4,
            'Preposition' => 5,
            'Collocation' => 6,
        ]);                
        yield BooleanField::new('isLearning');
        yield DateTimeField::new('learningUpdated')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y'), date('Y')),
                'widget' => 'single_text',
            ]);
    }
    
}
