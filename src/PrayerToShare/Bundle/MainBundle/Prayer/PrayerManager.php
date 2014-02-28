<?php

namespace PrayerToShare\Bundle\MainBundle\Prayer;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;

/**
 * @DI\Service("prayer_manager")
 */
class PrayerManager
{
    private $om;

    /**
     * @DI\InjectParams({
     *      "om" = @DI\Inject("doctrine.orm.default_entity_manager"),
     * })
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function createPrayer(User $user)
    {
        $prayer = new Prayer($user);
        $this->om->persist($prayer);

        return $prayer;
    }

    public function getNetworkPrayers(User $user)
    {
        return $this->getPrayerRepository()->findNetworkPrayers($user);
    }

    protected function getPrayerRepository()
    {
        return $this->om->getRepository('PrayerToShareMainBundle:Prayer');
    }
}
