<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_prayer_list")
 */
class UserPrayerList
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="prayerList")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Prayer", inversedBy="prayerList")
     * @ORM\JoinColumn(name="prayer_id", referencedColumnName="id")
     */
    protected $prayer;

    public function __construct(User $user, Prayer $prayer)
    {
        $this->user = $user;
        $this->prayer = $prayer;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPrayer()
    {
        return $this->prayer;
    }
}
