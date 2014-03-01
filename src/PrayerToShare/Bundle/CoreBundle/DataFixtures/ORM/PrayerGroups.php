<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;

class PrayerGroups extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $firstBaptist = new PrayerGroup();
        $firstBaptist->setName('First Baptist Nashville');
        $firstBaptist->setPublic(true);

        $johnDoe = new PrayerGroup();
        $johnDoe->setName('John Doe\'s Small Group');
        $johnDoe->setPublic(false);

        $manager->persist($firstBaptist);
        $manager->flush();

        $this->addReference('group-fb', $firstBaptist);
        $this->addReference('group-johndoe', $firstBaptist);
    }

    public function getOrder()
    {
        return 2;
    }
}
