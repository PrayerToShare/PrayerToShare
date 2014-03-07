<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/user")
 */
class UserController extends BaseController
{
    /**
     * @Route("/{username}", name="user_profile")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @ParamConverter("user", options={"mapping": {"username": "username"}})
     * @Template
     */
    public function profileAction(User $user)
    {
        return array(
            'user' => $user,
        );
    }
}
