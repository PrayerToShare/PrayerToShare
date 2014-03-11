<?php

namespace PrayerToShare\Bundle\MainBundle\Invite;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\MainBundle\Entity\Invite;

/**
 * @DI\Service("invite_manager")
 */
class InviteManager
{
    private $om;

    /**
     * @DI\InjectParams({
     *      "om" = @DI\Inject("doctrine.orm.default_entity_manager"),
     * })
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function sendInvitesToEmails(User $user, array $emails)
    {
        foreach ($emails as $email) {
            $this->sendInviteToEmail($user, $email);
        }
    }

    public function sendInviteToEmail(User $user, $email)
    {
        $invite = $this->createInvite($user, $email);
    }

    protected function createInvite(User $user, $email)
    {
        $invite = new Invite($user, $email);
        $this->om->persist($invite);

        return $invite;
    }
}
