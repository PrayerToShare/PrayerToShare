<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

class PrayerRepository extends EntityRepository
{
    public function findNetworkPrayers(User $user)
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }
}
