<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Prayers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const NUM_PRAYERS = 100;

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
        $prayerManager = $this->container->get('prayer_manager');
        $faker = \Faker\Factory::create();

        foreach (range(1, self::NUM_PRAYERS) as $idx) {
            $prayerGroup = $idx % 3 == 0
                ? $this->getReference(sprintf('group-misc-%d', rand(1, PrayerGroups::NUM_PRAYER_GROUPS)))
                : null;

            $p = $prayerManager->createPrayer($this->getReference(sprintf('user-misc-%d', rand(1, Users::NUM_USERS))), $prayerGroup);
            $p->setText($faker->paragraph(rand(1, 3)));
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
