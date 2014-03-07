<?php

namespace PrayerToShare\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PrayerGroupMemberRepository extends EntityRepository
{
    public function getPrayerGroupMember(User $user, PrayerGroup $prayerGroup)
    {
        return $this->createQueryBuilder('pgm')
            ->where('pgm.user = :user')
            ->andWhere('pgm.prayerGroup = :prayerGroup')
            ->setParameters(array(
                'user' => $user,
                'prayerGroup' => $prayerGroup,
            ))
            ->getQuery()
            ->getSingleResult();
    }
}
