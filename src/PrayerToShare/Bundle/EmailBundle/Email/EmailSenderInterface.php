<?php

namespace PrayerToShare\Bundle\EmailBundle\Email;

use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;

interface EmailSenderInterface
{
    public function send(EmailMessage $emailMessage);
}
