<?php

namespace PrayerToShare\Bundle\StorageBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadProfilePictureCommand extends ContainerAwareCommand
{
    protected $em;
    protected $uploader;

    protected function configure()
    {
        $this->setName('prayer-to-share:upload-user-profile')
            ->setDescription('Upload a profile picture')
            ->addArgument('email', InputArgument::REQUIRED, 'The users email')
            ->addArgument('file', InputArgument::REQUIRED, 'The file')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->uploader = $this->getContainer()->get('photo_uploader');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $this->findUser($input->getArgument('email'));
        if (!$user) {
            $output->writeln(sprintf('No user with email "%s" was found', $input->getArgument('email')));
            return;
        }
        $filePath = $input->getArgument('file');

        if (!file_exists($filePath)) {
            $output->writeln(sprintf('File "%s" does not exist', $filePath));
            return;
        }

        $uploadedFile = new UploadedFile($filePath, basename($filePath));
        $this->uploader->uploadNamedFile($uploadedFile, sprintf('test.%d.jpg', time()));
    }

    protected function findUser($email)
    {
        return $this->em->getRepository('PrayerToShareCoreBundle:User')->findOneByEmailCanonical($email);
    }
}
