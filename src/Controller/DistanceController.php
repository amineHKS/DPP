<?php

namespace App\Controller;

use App\Entity\Distance;
use App\Form\DistanceType;
use App\Processor\DistanceFormProcessor;
use App\Services\FormatObject;
use App\Repository\DistanceRepository;
use App\Model\DistanceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/distance")
 */
class DistanceController extends AbstractController
{
    /**
     * @Route("/", name="distance_index", methods={"GET"})
     */
    public function index(DistanceRepository $distanceRepository, FormatObject $formatObject): Response
    {
        $distancesObject = $distanceRepository->findAll();
        $objects = array();
        foreach($distancesObject as $value) {
            array_push($objects, $formatObject->constructDistanceObject($value));
        }

        return new JsonResponse($objects, 200);
    }

    /**
     * @Route("/new", name="distance_new", methods={"GET","POST"})
     */
    public function new(Request $request, ValidatorInterface $validator, DistanceFormProcessor $processor, DistanceManager $manager): Response
    {
        $processor->processForm($request, $validator);
        $errors = $processor->getErrors();
        $distance = $processor->getDistance();

        if (!empty($errors) && count($errors) > 0) {
            $errorsString = (string) $errors;

            return new JsonResponse($errorsString);
        }
        $manager->add($distance);

        return $this->redirectToRoute('distance_index');
    }

    /**
     * @Route("/{id}", name="distance_show", methods={"GET"})
     */
    public function show(Distance $distance): Response
    {
        return new JsonResponse($this->constructDistanceObject($distance), 200);
    }

    /**
     * @Route("/{id}/edit", name="distance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Distance $distance, ValidatorInterface $validator, DistanceManager $manager): Response
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        $form = $this->createForm(DistanceType::class, $distance);
        $form->submit($data);

        $errors = $validator->validate($distance);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new JsonResponse($errorsString);
        }

        $manager->edit();

        return $this->redirectToRoute('distance_index');
    }

    /**
     * @Route("/delete/{id}", name="distance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Distance $distance, DistanceManager $manager): Response
    {
        $manager->delete($distance);

        return $this->redirectToRoute('distance_index');
    }
}
