<?php

namespace PrayerToShare\Bundle\MainBundle\Invite;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\EmailBundle\Email\EmailManager;
use PrayerToShare\Bundle\MainBundle\Entity\Invite;

/**
 * @DI\Service("invite_manager")
 */
class InviteManager
{
    private $om;
    private $em;

    /**
     * @DI\InjectParams({
     *      "om" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "em" = @DI\Inject("email_manager"),
     * })
     */
    public function __construct(ObjectManager $om, EmailManager $em)
    {
        $this->om = $om;
        $this->em = $em;
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
        $this->sendInviteEmail($invite);
    }

    protected function sendInviteEmail(Invite $invite)
    {
        $emailMessage = $this->em->createEmailMessage('invite', $invite->getEmail());

        $this->em->sendEmailMessage($emailMessage);
    }

    protected function createInvite(User $user, $email)
    {
        $invite = new Invite($user, $email);
        $this->om->persist($invite);

        return $invite;
    }
}
