<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Expression;
use App\Entity\LearningUnit;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    )
    {
    }


    public function load(ObjectManager $manager): void
    {   
        $testPass = 'test';
        

        $testUser = new Admin();
        $testUser->setUsername('test');
        $testUser->setRoles(array('ROLE_ADMIN'));
        $password = $this->passwordEncoder->hashPassword($testUser, $testPass);
        $testUser->setPassword($password);
        $manager->persist($testUser);        
        

        $learning_unit = new LearningUnit();
        $learning_unit->setName('Essen und Trinken');                 
        
        $expression1 = new Expression();        
        $expression1->setTextLanguage1('essen');
        $expression1->setTextLanguage2('comer');        
        $expression1->setLanguage1(1);
        $expression1->setLanguage2(2);
        $expression1->setGrammarType(1);
        $expression1->setIsLearning(true);            
        $expression1->addLearningUnits($learning_unit);

        $expression2 = new Expression();
        $expression2->setTextLanguage1('trinken');
        $expression2->setTextLanguage2('beber');        
        $expression2->setLanguage1(1);
        $expression2->setLanguage2(2);
        $expression2->setGrammarType(1);
        $expression2->setIsLearning(true);             
        $expression2->addLearningUnits($learning_unit);   
        
        $manager->persist($learning_unit);
        $manager->persist($expression1);        
        $manager->persist($expression2);          
              
        $manager->flush();            
    }
}
