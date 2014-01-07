<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="prayer_requests")
 */
class PrayerRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="prayerRequests")
     */
    protected $user;

    /**
     * @ORM\Column
     */
    protected $text;

    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
