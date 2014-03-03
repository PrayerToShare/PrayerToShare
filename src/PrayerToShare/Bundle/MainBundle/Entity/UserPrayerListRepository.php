<?php

namespace PrayerToShare\Bundle\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

class UserPrayerListRepository extends EntityRepository
{
    public function findUserPrayerList(User $user, Prayer $prayer)
    {
        return $this->createQueryBuilder('upl')
            ->where('upl.user = :user')
            ->andWhere('upl.prayer = :prayer')
            ->setParameters(array(
                'user' => $user,
                'prayer' => $prayer,
            ))
            ->getQuery()
            ->getSingleResult();
    }
}
