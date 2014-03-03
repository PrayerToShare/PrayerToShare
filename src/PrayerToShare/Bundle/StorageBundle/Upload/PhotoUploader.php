<?php

namespace PrayerToShare\Bundle\StorageBundle\Upload;

use Gaufrette\Filesystem;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @DI\Service("photo_uploader")
 */
class PhotoUploader
{
    private static $allowedMimeTypes = array('image/jpeg', 'image/png', 'image/gif');

    private $filesystem;

    /**
     * @DI\InjectParams({
     *      "filesystem" = @DI\Inject("photo_storage_filesystem"),
     * })
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(UploadedFile $file)
    {
        // Check if the file's mime type is in the list of allowed mime types.
        if (!in_array($file->getClientMimeType(), self::$allowedMimeTypes)) {
            throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
        }

        // Generate a unique filename based on the date and add file extension of the uploaded file
        $filename = sprintf('%s/%s/%s/%s.%s', date('Y'), date('m'), date('d'), uniqid(), $file->getClientOriginalExtension());

        return $this->uploadNamedFile($file, $filename);
    }

    public function uploadNamedFile(UploadedFile $file, $filename)
    {
        $adapter = $this->filesystem->getAdapter();
        $adapter->setMetadata($filename, array('contentType' => $file->getClientMimeType()));
        $adapter->write($filename, file_get_contents($file->getPathname()));

        return $filename;
    }
}
