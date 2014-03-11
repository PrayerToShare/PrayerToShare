<?php

namespace PrayerToShare\Bundle\EmailBundle\Email;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\EmailBundle\Entity\EmailMessage;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * @DI\Service("email_manager")
 */
class EmailManager
{
    protected $om;
    protected $logger;

    /**
     * @DI\InjectParams({
     *      "om" = @DI\Inject("doctrine.orm.default_entity_manager"),
     *      "logger" = @DI\Inject("logger"),
     * })
     */
    public function __construct(ObjectManager $om, LoggerInterface $logger)
    {
        $this->om = $em;
        $this->logger = $logger;
    }

    public function createEmailMessage($template, array $data = array())
    {
        $emailMessage = new EmailMessage($template, $data);
        $this->om->persist($emailMessage);
        $this->logger->info(sprintf('EmailMessage - Creating Message - %s %s', $message->getTemplate(), $message->getJsonData()));

        return $emailMessage;
    }
}
