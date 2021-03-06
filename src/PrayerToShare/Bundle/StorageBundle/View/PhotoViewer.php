<?php

namespace PrayerToShare\Bundle\StorageBundle\View;

use Gaufrette\Adapter\AwsS3;
use Gaufrette\Filesystem;
use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @DI\Service("photo_viewer")
 */
class PhotoViewer
{
    private $filesystem;

    /**
     * @DI\InjectParams({
     *      "filesystem" = @DI\Inject("profile_storage_filesystem"),
     * })
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function getUserProfileImage($user)
    {
        $imagePath = $user->getProfileImage();
        $imagePath = $imagePath ?: 'noprofileimage.jpg';

        $adapter = $this->filesystem->getAdapter();

        return $adapter instanceof AwsS3
            ? $adapter->getUrl($imagePath)
            : sprintf('%s/%s', '/uploads/local', $imagePath);
    }
}

