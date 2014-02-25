<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="prayers")
 */
class Prayer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="prayers")
     */
    protected $user;

    /**
     * @ORM\Column
     */
    protected $text;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
