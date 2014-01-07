<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use PrayerToShare\Bundle\MainBundle\Entity\PrayerRequest;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
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
     * @ORM\OneToMany(targetEntity="PrayerToShare\Bundle\MainBundle\Entity\PrayerRequest", mappedBy="user")
     */
    protected $prayerRequests;

    public function __construct()
    {
        parent::__construct();

        $this->prayerRequests = new ArrayCollection();
    }

    public function addPrayerRequest(PrayerRequest $prayerRequest)
    {
        if (!$this->prayerRequests->contains($prayerRequest)) {
            $this->prayerRequests->add($prayerRequest);
        }
    }

    public function getPrayerRequests()
    {
        return $this->prayerRequests;
    }
}
