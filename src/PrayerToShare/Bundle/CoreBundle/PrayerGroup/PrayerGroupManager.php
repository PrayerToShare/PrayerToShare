<?php

namespace PrayerToShare\Bundle\CoreBundle\PrayerGroup;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;

/**
 * @DI\Service("prayergroup_manager")
 */
class PrayerGroupManager
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

    public function createPrayerGroup(User $user)
    {
        //TODO
        $prayer = new PrayerGroup($user);
        $this->om->persist($prayer);

        return $prayer;
    }
}
