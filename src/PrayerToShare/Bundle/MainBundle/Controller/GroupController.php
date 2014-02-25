<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/groups")
 */
class GroupController extends BaseController
{
    /**
     * @Route("/list", name="group_list")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @Template
     */
    public function listAction()
    {
        $user = $this->getUser();
        $publicGroups = $this->getRepository('PrayerToShareCoreBundle:PrayerGroup')->findAllPublicGroups();

        return array(
            'groups' => $user->getPrayerGroups(),
            'publicGroups' => $publicGroups,
        );
    }
}
