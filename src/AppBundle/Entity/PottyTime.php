<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 */
class PottyTime
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPoop;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPee;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getIsPoop()
    {
        return $this->isPoop;
    }

    /**
     * @param mixed $isPoop
     */
    public function setIsPoop($isPoop)
    {
        $this->isPoop = $isPoop;
    }

    /**
     * @return mixed
     */
    public function getIsPee()
    {
        return $this->isPee;
    }

    /**
     * @param mixed $isPee
     */
    public function setIsPee($isPee)
    {
        $this->isPee = $isPee;
    }

    public function __construct()
    {
        $this->timestamp = new \DateTime("now");
    }
}
