<?php

namespace PrayerToShare\Bundle\MainBundle\Prayer;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use PrayerToShare\Bundle\MainBundle\Entity\UserPrayerList;

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

    public function createPrayer(User $user, PrayerGroup $prayerGroup = null)
    {
        $prayer = new Prayer($user, $prayerGroup);
        $this->om->persist($prayer);

        return $prayer;
    }

    public function createUserPrayerList(User $user, Prayer $prayer)
    {
        $userPrayerList = new UserPrayerList($user, $prayer);
        $this->om->persist($userPrayerList);

        return $userPrayerList;
    }

    public function getUserPrayerList(User $user, Prayer $prayer)
    {
        return $this->getUserPrayerListRepository()->findUserPrayerList($user, $prayer);
    }

    public function getNetworkPrayers(User $user)
    {
        return $this->getPrayerRepository()->findNetworkPrayers($user);
    }

    protected function getPrayerRepository()
    {
        return $this->om->getRepository('PrayerToShareMainBundle:Prayer');
    }

    protected function getUserPrayerListRepository()
    {
        return $this->om->getRepository('PrayerToShareMainBundle:UserPrayerList');
    }
}
