<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="PrayerRepository")
 * @ORM\Table(name="prayers")
 * @Serialize\ExclusionPolicy("all")
 */
class Prayer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="prayers")
     * @Serialize\Expose
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup", inversedBy="prayers")
     * @ORM\JoinColumn(name="prayer_group_id", referencedColumnName="id", nullable=true)
     * @Serialize\Expose
     */
    protected $prayerGroup;

    /**
     * @ORM\OneToMany(targetEntity="UserPrayerList", mappedBy="prayer")
     */
    protected $prayerList;

    /**
     * @ORM\Column(type="text")
     * @Serialize\Expose
     */
    protected $text;

    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     * @Serialize\Expose
     */
    protected $anonymous = false;

    /**
     * @ORM\Column(type="datetime")
     * @Serialize\Expose
     */
    protected $createdAt;

    public function __construct(User $user, PrayerGroup $prayerGroup = null)
    {
        $this->user = $user;
        $this->prayerGroup = $prayerGroup;
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

    public function getPrayerGroup()
    {
        return $this->prayerGroup;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setAnonymous($anonymous)
    {
        $this->anonymous = $anonymous;
    }

    public function isAnonymous()
    {
        return $this->anonymous;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
