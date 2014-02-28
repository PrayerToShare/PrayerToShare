<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
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
     * @ORM\Column
     * @Serialize\Expose
     */
    protected $text;

    /**
     * @ORM\Column(type="datetime")
     * @Serialize\Expose
     */
    protected $createdAt;

    public function __construct(User $user)
    {
        $this->user = $user;
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

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
