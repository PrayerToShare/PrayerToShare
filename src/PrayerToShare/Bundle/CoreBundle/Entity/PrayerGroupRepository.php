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
}
