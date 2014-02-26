<?php

namespace PrayerToShare\Bundle\CoreBundle\PrayerGroup;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroupMember;

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
        $prayerGroup = new PrayerGroup();
        $this->om->persist($prayerGroup);

        return $prayerGroup;
    }

    public function createPrayerGroupMember(User $user, PrayerGroup $prayerGroup)
    {
        $prayerGroupMember = new PrayerGroupMember($user, $prayerGroup);
        $this->om->persist($prayerGroupMember);

        return $prayerGroupMember;
    }
}
