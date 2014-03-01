<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PrayerGroups extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const NUM_PRAYER_GROUPS = 10;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $prayerGroupManager = $this->container->get('prayergroup_manager');
        $faker = \Faker\Factory::create();

        $firstBaptist = new PrayerGroup();
        $firstBaptist->setName('First Baptist Nashville');
        $firstBaptist->setPublic(true);

        $johnDoe = new PrayerGroup();
        $johnDoe->setName('John Doe\'s Small Group');
        $johnDoe->setPublic(false);

        $manager->persist($firstBaptist);
        $manager->persist($johnDoe);

        $miscGroups = array();
        foreach (range(1, self::NUM_PRAYER_GROUPS) as $idx) {
            $g = new PrayerGroup();
            $g->setName($faker->company);
            if ($idx % 2 == 0) {
                $g->setPublic(true);
            }

            $manager->persist($g);
            $this->addReference(sprintf('group-misc-%d', $idx), $g);

            $miscGroups[] = $g;
        }
        $manager->flush();

        $this->addReference('group-fb', $firstBaptist);
        $this->addReference('group-johndoe', $johnDoe);

        // Add some members to the groups
        $prayerGroupManager->createPrayerGroupMember($this->getReference('user-jsuggs'), $firstBaptist);
        $prayerGroupManager->createPrayerGroupMember($this->getReference('user-jnye'), $firstBaptist);
        foreach (range(1, 50) as $idx) {
            $prayerGroupManager->createPrayerGroupMember($this->getReference(sprintf('user-misc-%d', $idx)), $firstBaptist);
            $prayerGroupManager->createPrayerGroupMember($this->getReference(sprintf('user-misc-%d', $idx)), $this->getReference(sprintf('group-misc-%d', rand(1, self::NUM_PRAYER_GROUPS))));
            if ($idx % 5 == 0) {
                $prayerGroupManager->createPrayerGroupMember($this->getReference(sprintf('user-misc-%d', $idx)), $johnDoe);
            }
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
