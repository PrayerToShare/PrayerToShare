<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

class PrayerRepository extends EntityRepository
{
    const NETWORK_PRAYER_DQL =<<<DQL
SELECT p
FROM PrayerToShare\Bundle\MainBundle\Entity\Prayer p
WHERE
    (
        p.user = :user
        OR
        p.prayerGroup IN (
            SELECT pg1
            FROM PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup pg1
            JOIN pg1.members m1
            WHERE m1.user = :user
        )
    )
    AND NOT EXISTS (
        SELECT 1
        FROM PrayerToShare\Bundle\MainBundle\Entity\ArchivedPrayer ap2
        WHERE ap2.prayer = p
        AND ap2.user = :user
    )
DQL;

    public function findNetworkPrayers(User $user)
    {
        return $this->_em->createQuery(self::NETWORK_PRAYER_DQL)
            ->setParameters(array('user' => $user))
            ->getResult();
    }
}
