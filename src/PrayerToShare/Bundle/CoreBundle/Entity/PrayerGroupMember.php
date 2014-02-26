<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prayer_group_members")
 */
class PrayerGroupMember
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="prayerGroups")
     */
    protected $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PrayerGroup", inversedBy="members")
     * @ORM\JoinColumn(name="prayer_group_id", referencedColumnName="id")
     */
    protected $prayerGroup;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $admin;

    public function __construct(User $user, PrayerGroup $prayerGroup)
    {
        $this->user = $user;
        $this->prayerGroup = $prayerGroup;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPrayerGroup()
    {
        return $this->prayerGroup;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function isAdmin()
    {
        return $this->admin;
    }
}
