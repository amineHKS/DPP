<?php

namespace App\Model;

use App\Entity\Distance;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DistanceManager
{
    private $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add(Distance $distance)
    {
        $em = $this->doctrine->getManager();
        $em->persist($distance);
        $em->flush();
    }

    public function edit()
    {
        $em = $this->doctrine->getManager();
        $em->flush();
    }

    public function delete(Distance $distance)
    {
        $em = $this->doctrine->getManager();
        $em->remove($distance);
        $em->flush();
    }
}