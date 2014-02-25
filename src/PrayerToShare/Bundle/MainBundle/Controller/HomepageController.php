<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomepageController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @Template
     */
    public function indexAction()
    {
        $regForm = $this->getRegistrationForm();

        return array(
            'regForm' => $regForm->createView(),
            'auth_csrf_token' => $this->getAuthCsrfToken(),
        );
    }
}
