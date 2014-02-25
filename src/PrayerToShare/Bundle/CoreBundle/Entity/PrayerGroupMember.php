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
     */
    protected $group;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $admin;

    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getGroup()
    {
        return $this->group;
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
