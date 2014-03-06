<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_archived_prayers")
 */
class ArchivedPrayer
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="archivedPrayers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Prayer")
     * @ORM\JoinColumn(name="prayer_id", referencedColumnName="id")
     */
    protected $prayer;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(User $user, Prayer $prayer)
    {
        $this->user = $user;
        $this->prayer = $prayer;
        $this->createdAt = new \DateTime();
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
