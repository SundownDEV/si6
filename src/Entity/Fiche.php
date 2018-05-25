<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheRepository")
 */
class Fiche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $food_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recommandations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prices;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fb_link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $insta_link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getFoodType(): ?string
    {
        return $this->food_type;
    }

    public function setFoodType(string $food_type): self
    {
        $this->food_type = $food_type;

        return $this;
    }

    public function getRecommandations(): ?string
    {
        return $this->recommandations;
    }

    public function setRecommandations(string $recommandations): self
    {
        $this->recommandations = $recommandations;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getPrices(): ?string
    {
        return $this->prices;
    }

    public function setPrices(string $prices): self
    {
        $this->prices = $prices;

        return $this;
    }

    public function getFbLink(): ?string
    {
        return $this->fb_link;
    }

    public function setFbLink(string $fb_link): self
    {
        $this->fb_link = $fb_link;

        return $this;
    }

    public function getInstaLink(): ?string
    {
        return $this->insta_link;
    }

    public function setInstaLink(string $insta_link): self
    {
        $this->insta_link = $insta_link;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
}
