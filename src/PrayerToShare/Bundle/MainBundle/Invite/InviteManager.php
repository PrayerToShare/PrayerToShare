<?php

namespace PrayerToShare\Bundle\MainBundle\Invite;

use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;

/**
 * @DI\Service("invite_manager")
 */
class InviteManager
{
    public function sendInvitesToEmails(User $user, array $emails)
    {
        foreach ($emails as $email) {
            $this->sendInviteToEmail($user, $email);
        }
    }

    public function sendInviteToEmail(User $user, $email)
    {
        //TODO
    }
}
