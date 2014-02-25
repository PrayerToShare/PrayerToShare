<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/prayer")
 */
class PrayerController extends BaseController
{
    /**
     * @Route("/", name="prayer_create")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     * @Template
     */
    public function createAction()
    {
        $user = $this->getUser();
        $prayer = $this->getPrayerManager()->createPrayer($user);

        $form = $this->getPrayerForm($prayer);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $this->getEntityManager()->flush();
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
