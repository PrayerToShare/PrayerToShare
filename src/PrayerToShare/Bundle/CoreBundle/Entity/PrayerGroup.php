<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prayer_groups")
 */
class PrayerGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="PrayerGroupMember", mappedBy="group")
     */
    protected $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addMember(PrayerGroupMember $member)
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
        }
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getAdmins()
    {
        return $this->members->filter(function($member) {
            return $member->isAdmin();
        });
    }

    public function isAdmin(User $user)
    {
        return $this->getAdmins()->exists(function() use ($user) {
            return $member->getUser() == $user;
        });
    }
}
