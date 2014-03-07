<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PrayerGroupRepository extends EntityRepository
{
    public function findAllPublicGroups()
    {
        return $this->createQueryBuilder('pg')
            ->where('pg.public = true')
            ->getQuery()
            ->getResult();
    }

    public function getAvailablePublicGroups(User $user)
    {
        return $this->createQueryBuilder('pg')
            ->where('pg.public = true')
            ->andWhere('NOT EXISTS(SELECT 1 FROM PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroupMember pgm WHERE pgm.user = :user AND pgm.prayerGroup = pg)')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
