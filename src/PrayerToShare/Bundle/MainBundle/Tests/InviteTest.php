<?php

namespace PrayerToShare\Bundle\MainBundle\Tests\Entity;

use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\CoreBundle\Tests\PrayerToShareTest;
use PrayerToShare\Bundle\MainBundle\Entity\Invite;

class InviteTest extends PrayerToShareTest
{
    public function testCode()
    {
        $email = 'test@test.com';
        $user = new User();

        $invite = new Invite($user, $email);

        $this->assertEquals(32, strlen($invite->getCode()));
    }
}
