<?php

namespace PrayerToShare\Bundle\EmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendEmailCommand extends ContainerAwareCommand
{
    protected $em;
    protected $sender;

    protected function configure()
    {
        $this
            ->setName('email:send-email')
            ->setDescription('Send an email')
            ->addArgument('id', InputArgument::REQUIRED, 'The email message id')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->sender = $container->get('email_sender');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailMessage = $this->getEmailMessage($input->getArgument('id'));
        if (!$emailMessage) {
            $output->writeln(sprintf('No Email Message with id "%s" found', $input->getArgument('id')));
            return;
        }

        $this->sender->send($emailMessage);

        $this->em->flush();
    }

    protected function getEmailMessage($id)
    {
        return $this->em->getRepository('PrayerToShareEmailBundle:EmailMessage')->find($id);
    }
}
