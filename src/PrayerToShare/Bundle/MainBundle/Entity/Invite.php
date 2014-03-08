<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="invites")
 */
class Invite
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="invites")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="PrayerToShare\Bundle\CoreBundle\Entity\User", inversedBy="invites")
     * @ORM\JoinColumn(name="joined_user_id", referencedColumnName="id", nullable=true)
     */
    protected $joinedUser;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct(User $user, $email)
    {
        $this->user = $user;
        $this->email = $email;
        $this->createdAt = new \DateTime();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getJoinedUser()
    {
        return $this->joinedUser;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
