<?php

namespace PrayerToShare\Bundle\EmailBundle\Sender;

use PrayerToShare\Bundle\EmailBundle\Email\EmailSenderInterface;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;

class AbstractEmailSender implements EmailSenderInterface
{
    public function send(EmailMessage $emailMessage)
    {
        $this->_send($emailMessage);
    }

    abstract protected function _send(EmailMessage $emailMessage);
}
