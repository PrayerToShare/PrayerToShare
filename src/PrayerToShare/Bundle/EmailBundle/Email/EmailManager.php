<?php

namespace PrayerToShare\Bundle\EmailBundle\Email;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\EmailBundle\Email\EmailSenderInterface;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("email_manager")
 */
class EmailManager
{
    protected $om;
    protected $sender;
    protected $logger;

    /**
     * @DI\InjectParams({
     *      "om" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "sender" = @DI\Inject("email_sender"),
     *      "logger" = @DI\Inject("logger"),
     * })
     */
    public function __construct(ObjectManager $om, EmailSenderInterface $sender, LoggerInterface $logger)
    {
        $this->om = $om;
        $this->sender = $sender;
        $this->logger = $logger;
    }

    public function createEmailMessage($template, $email, array $data = null)
    {
        $emailMessage = new EmailMessage($template, $email);
        $emailMessage->setData($data);
        $this->om->persist($emailMessage);

        return $emailMessage;
    }

    public function sendEmailMessage(EmailMessage $message)
    {
        $this->logger->info(sprintf('EmailManager::sendEmailMessage - %s %s', $message->getTemplate(), $message->getJsonData()));
        $this->sender->send($message);
    }
}
