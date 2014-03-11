<?php

namespace PrayerToShare\Bundle\EmailBundle\Sender;

use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\EmailBundle\Email\EmailSenderInterface;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;

/**
 * @DI\Service("email_sender.file_system")
 */
class FilesystemEmailSender extends AbstractEmailSender
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    protected function _send(EmailMessage $emailMessage)
    {
        $file = sprintf('%s/%s', $this->directory, $emailMessage->getCode());
        $data = array(
            'template' => $emailMessage->getTemplate(),
            'data' => $emailMessage->getData(),
        );

        $fh = fopen($file, 'w');
        fwrite($fh, json_encode($data));
        fclose($fh);
    }
}
