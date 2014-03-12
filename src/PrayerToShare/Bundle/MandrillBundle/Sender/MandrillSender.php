<?php

namespace PrayerToShare\Bundle\MandrillBundle\Sender;

use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;
use PrayerToShare\Bundle\EmailBundle\Sender\AbstractEmailSender;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("email_sender.mandrill")
 */
class MandrillSender extends AbstractEmailSender
{
    private $mandrill;
    private $logger;

    /**
     * @DI\InjectParams({
     *      "mandrill" = @DI\Inject("mandrill.client"),
     *      "logger" = @DI\Inject("logger"),
     * })
     */
    public function __construct(\Mandrill $mandrill, LoggerInterface $logger)
    {
        $this->mandrill = $mandrill;
        $this->logger = $logger;
    }

    protected function _send(EmailMessage $emailMessage)
    {
        $params = array(
            'to' => array(
                array(
                    'email' => $emailMessage->getEmail(),
                    'type' => 'to',
                ),
            ),
        );

        $response = $this->mandrill->messages->sendTemplate(
            $emailMessage->getTemplate(),
            $emailMessage->getData(),
            $params
        );

        $this->logger->info(sprintf(
            'MandrillSender - Message: %d - Response: %s',
            $emailMessage->getId(),
            json_encode($response)
        ));
    }
}
