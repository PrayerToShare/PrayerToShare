<?php

namespace PrayerToShare\Bundle\StorageBundle\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\StorageBundle\Upload\PhotoUploader;

/**
 * @DI\DoctrineListener(
 *     events = {"prePersist", "preUpdate"},
 * )
 */
class UserProfileImageListener
{
    protected $uploader;

    /**
     * @DI\InjectParams({
     *      "photoUploader" = @DI\Inject("photo_uploader"),
     * })
     */
    public function __construct(PhotoUploader $photoUploader)
    {
        $this->uploader = $photoUploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->uploadProfileImage($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->uploadProfileImage($args);
    }

    private function uploadProfileImage(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User && $args->hasChangedField('profileImage')) {
            $profileImage = $entity->getProfileImage();
            $fileName = sprintf('%s.%d.jpg', $entity->getUsername(), time());
            $this->uploader->uploadNamedFile($profileImage, $fileName);

            $entity->setProfileImagePath($fileName);
        }
    }
}
