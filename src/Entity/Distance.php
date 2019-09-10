<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistanceRepository")
 */
class Distance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Ip(version=4)
     * @Assert\Length(max="15")
     */
    private $address_ip;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @ORM\Column(type="integer")
     */
    private $address_number;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $address_street;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @ORM\Column(type="integer")
     */
    private $address_postal_code;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=30)
     */
    private $address_city;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=30)
     */
    private $address_country;

    /**
     * @Assert\Blank
     * @ORM\Column(type="float")
     */
    private $distance_result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressIp()
    {
        return $this->address_ip;
    }

    public function setAddressIp($address_ip): self
    {
        $this->address_ip = $address_ip;

        return $this;
    }

    public function getAddressNumber(): ?int
    {
        return $this->address_number;
    }

    public function setAddressNumber(int $address_number): self
    {
        $this->address_number = $address_number;

        return $this;
    }

    public function getAddressStreet()
    {
        return $this->address_street;
    }

    public function setAddressStreet($address_street): self
    {
        $this->address_street = $address_street;

        return $this;
    }

    public function getAddressPostalCode(): ?int
    {
        return $this->address_postal_code;
    }

    public function setAddressPostalCode(int $address_postal_code): self
    {
        $this->address_postal_code = $address_postal_code;

        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->address_city;
    }

    public function setAddressCity(string $address_city): self
    {
        $this->address_city = $address_city;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->address_country;
    }

    public function setAddressCountry(string $address_country): self
    {
        $this->address_country = $address_country;

        return $this;
    }

    public function getDistanceResult(): ?float
    {
        return $this->distance_result;
    }

    public function setDistanceResult(float $distance_result): self
    {
        $this->distance_result = $distance_result;

        return $this;
    }
}
