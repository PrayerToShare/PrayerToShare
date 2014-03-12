<?php

namespace PrayerToShare\Bundle\EmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateEmailCommand extends ContainerAwareCommand
{
    protected $em;
    protected $manager;

    protected function configure()
    {
        $this
            ->setName('email:create-email')
            ->setDescription('Create an email')
            ->addArgument('email',    InputArgument::REQUIRED, 'The email address to send to')
            ->addArgument('template', InputArgument::REQUIRED, 'The template')
            ->addArgument('data',     InputArgument::OPTIONAL, 'The data for the template (JSON formatted)')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->manager = $container->get('email_manager');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $input->getArgument('data');

        $this->manager->createEmailMessage(
            $input->getArgument('template'),
            $input->getArgument('email'),
            $data ? json_decode($data, true) : null
        );

        $this->em->flush();
    }
}
