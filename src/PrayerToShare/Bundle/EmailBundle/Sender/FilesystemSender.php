<?php

namespace PrayerToShare\Bundle\EmailBundle\Sender;

use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\EmailBundle\Email\EmailSenderInterface;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;

/**
 * @DI\Service("email_sender.file_system")
 */
class FilesystemSender extends AbstractEmailSender
{
    private $directory;

    /**
     * @DI\InjectParams({
     *      "directory" = @DI\Inject("%local_email_path%"),
     * })
     */
    public function __construct($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $this->directory = $directory;
    }

    protected function _send(EmailMessage $emailMessage)
    {
        $file = sprintf('%s/%s', $this->directory, $emailMessage->getId());
        $data = array(
            'template' => $emailMessage->getTemplate(),
            'data' => $emailMessage->getData(),
        );

        $fh = fopen($file, 'w');
        fwrite($fh, json_encode($data));
        fclose($fh);
    }
}
