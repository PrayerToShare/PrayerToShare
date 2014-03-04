<?php

namespace PrayerToShare\Bundle\StorageBundle\Twig\Extension;

use JMS\DiExtraBundle\Annotation as DI;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * UserExtension
 *
 * @DI\Service("storage.twig.image")
 * @DI\Tag("twig.extension")
 */
class ImageExtension extends \Twig_Extension
{
    private $container;

    /**
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'profile_image' => new \Twig_Function_Method($this, 'profileImage'),
        );
    }

    public function profileImage(User $user)
    {
        return $this->getPhotoViewer()->getUserProfileImage($user);
    }

    protected function getPhotoViewer()
    {
        return $this->container->get('photo_viewer');
    }

    public function getName()
    {
        return 'storage.image';
    }
}
