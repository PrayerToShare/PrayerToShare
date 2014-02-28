<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="PrayerGroupRepository")
 * @ORM\Table(name="prayer_groups")
 * @Serialize\ExclusionPolicy("all")
 */
class PrayerGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank
     * @Serialize\Expose
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="PrayerGroupMember", mappedBy="prayerGroup")
     */
    protected $members;

    /**
     * @ORM\OneToMany(targetEntity="PrayerToShare\Bundle\MainBundle\Entity\Prayer", mappedBy="prayerGroup")
     */
    protected $prayers;

    /**
     * @ORM\Column(type="boolean")
     * @Serialize\Expose
     */
    protected $public;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->prayers = new ArrayCollection();
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

    public function addPrayer(Prayer $prayer)
    {
        if (!$this->prayers->contains($prayer)) {
            $this->prayers->add($prayer);
        }
    }

    public function getPrayers()
    {
        return $this->prayers;
    }

    public function setPublic($public)
    {
        $this->public = $public;
    }

    public function isPublic()
    {
        return $this->public;
    }
}
