<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as Serialize;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use PrayerToShare\Bundle\MainBundle\Entity\UserPrayerList;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @Serialize\ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(
     *      minWidth=300,
     *      minHeight=300,
     *      allowLandscape=false,
     *      allowPortrait=false,
     * )
     */
    protected $profileImage;

    /**
     * @ORM\OneToMany(targetEntity="PrayerToShare\Bundle\MainBundle\Entity\Prayer", mappedBy="user")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    protected $prayers;

    /**
     * @ORM\OneToMany(targetEntity="PrayerToShare\Bundle\MainBundle\Entity\ArchivedPrayer", mappedBy="user")
     */
    protected $archivedPrayers;

    /**
     * @ORM\OneToMany(targetEntity="PrayerGroupMember", mappedBy="user")
     */
    protected $prayerGroups;

    /**
     * @ORM\OneToMany(targetEntity="PrayerToShare\Bundle\MainBundle\Entity\UserPrayerList", mappedBy="user")
     */
    protected $prayerList;

    public function __construct()
    {
        parent::__construct();

        $this->prayers = new ArrayCollection();
        $this->prayerGroups = new ArrayCollection();
        $this->prayerList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setProfileImage(File $file)
    {
        // Filepath will be set via listener
        $this->profileImage = $file;
    }

    public function setProfileImagePath($filepath)
    {
        $this->profileImage = $filepath;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function getFullName()
    {
        return sprintf(
            '%s%s%s',
            $this->firstName,
            strlen($this->firstName) && strlen($this->lastName) ? ' ' : '',
            $this->lastName
        );
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

    public function getMostRecentPrayer()
    {
        return $this->prayers->first();
    }

    public function addPrayerGroup(PrayerGroupMember $group)
    {
        $this->prayerGroups->add($group);
    }

    public function getPrayerGroups()
    {
        return $this->prayerGroups;
    }

    public function isPrayingFor(Prayer $prayer)
    {
        return $this->prayerList->exists(function($idx, UserPrayerList $upl) use ($prayer) {
            return $upl->getPrayer()->getId() == $prayer->getId();
        });
    }
}
