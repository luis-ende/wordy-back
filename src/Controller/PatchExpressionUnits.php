<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Expression;
use App\Entity\LearningUnit;

class PatchExpressionUnits {
    public function __invoke(Request $request, $format, SerializerInterface $serializer, 
        ValidatorInterface $validator, ManagerRegistry $registry, Expression $expression) {

        $content = $request->getContent();                
        $unitsReq = json_decode($content, true);
        if (!$unitsReq || !isset($unitsReq['learningUnits'])) {
            return new JsonResponse("No learning units to patch.", 400);
        }

        $unitsReq = $unitsReq['learningUnits'];
        $unitsExp = $expression->getLearningUnits()->map(function ($unit) { return $unit->getId(); })->toArray();

        $unitsAdd = array_diff($unitsReq, $unitsExp);
        $unitsRemove = array_diff($unitsExp, $unitsReq);

        $lu_em = $registry->getManagerForClass(LearningUnit::class);
        foreach ($unitsAdd as $unit) {
            $learningUnit = $lu_em->find(LearningUnit::class, $unit);
            if ($learningUnit) {
                $expression->addLearningUnits($learningUnit);
            }
        }

        foreach ($unitsRemove as $unit) {
            $learningUnit = $lu_em->find(LearningUnit::class, $unit);
            if ($learningUnit) {
                $expression->removeLearningUnits($learningUnit);
            }
        }

        $em = $registry->getManagerForClass(Expression::class);
        $em->persist($expression);
        $em->flush();

        return $expression;
    }
}