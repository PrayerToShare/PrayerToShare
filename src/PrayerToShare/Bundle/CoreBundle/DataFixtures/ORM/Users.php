<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Users extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const NUM_USERS = 50;

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
        $userManager = $this->container->get('fos_user.user_manager');
        $faker = \Faker\Factory::create();

        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@prayertoshare.com');
        $user->setPlainPassword('password');
        $user->setEnabled(true);

        $jsuggs = new User();
        $jsuggs->setUsername('jsuggs');
        $jsuggs->setEmail('jsuggs@prayertoshare.com');
        $jsuggs->setPlainPassword('password');
        $jsuggs->setFirstName('Jonathon');
        $jsuggs->setLastName('Suggs');
        $jsuggs->setEnabled(true);

        $jnye = new User();
        $jnye->setUsername('jnye');
        $jnye->setEmail('jnye@prayertoshare.com');
        $jnye->setPlainPassword('password');
        $jnye->setFirstName('Joel');
        $jnye->setLastName('Nye');
        $jnye->setEnabled(true);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@prayertoshare.com');
        $admin->setPlainPassword('password');
        $admin->setEnabled(true);
        $admin->setRoles(array('ROLE_ADMIN'));

        $userManager->updateUser($user, true);
        $userManager->updateUser($jsuggs, true);
        $userManager->updateUser($jnye, true);
        $userManager->updateUser($admin, true);

        $manager->persist($user);
        $manager->persist($jsuggs);
        $manager->persist($jnye);
        $manager->persist($admin);

        $miscUsers = array();
        foreach (range(1, self::NUM_USERS) as $idx) {
            $u = new User();
            $u->setUsername($faker->userName);
            $u->setEmail($faker->email);
            $u->setPlainPassword('password');
            $u->setProfileImagePath(sprintf('profile-%d.jpg', rand(1, 20)));
            if ($idx % 2 == 0) {
                $u->setFirstName($faker->firstName);
                $u->setLastName($faker->lastName);
            }
            $u->setEnabled(true);

            $userManager->updateUser($u);
            $manager->persist($u);
            $this->addReference(sprintf('user-misc-%d', $idx), $u);

            $miscUsers[] = $u;
        }

        $manager->flush();

        $this->addReference('user-user', $user);
        $this->addReference('user-jsuggs', $jsuggs);
        $this->addReference('user-jnye', $jnye);
        $this->addReference('user-admin', $admin);

    }

    public function getOrder()
    {
        return 1;
    }
}
