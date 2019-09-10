<?php

namespace App\Processor;

use App\Entity\Distance;
use App\Services\CalculateDistance;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DistanceType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Forms;

class DistanceFormProcessor implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    protected $distance;
    protected $form;
    protected $errors;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function createForm()
    {
        $this->distance = new Distance();
        $formFactory = Forms::createFormFactory();
        $this->form = $formFactory->create(DistanceType::class, $this->distance);
        return $this->form;
    }

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return bool
     */
    public function processForm(Request $request, ValidatorInterface $validator)
    {
        $cleanForm = $this->createForm();
        $data = $request->getContent();
        $data = json_decode($data, true);
        $cleanForm->submit($data);

        $errors = $validator->validate($this->distance);
        if (!empty($errors) && count($errors) > 0) {
            $this->errors = $errors;

            return false;
        }

        $service = new CalculateDistance();
        // get Distance from python micro service
        $calculateDistance = $service->calculateDistance($this->distance);
        $distanceValue = 'null';
        if (array_key_exists('distance', $calculateDistance)) {
            $distanceValue = $calculateDistance['distance'];
        }
        $this->distance->setDistanceResult($distanceValue);
    }


    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

}