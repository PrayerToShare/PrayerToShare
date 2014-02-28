<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/dashboard")
 */
class DashboardController extends BaseController
{
    /**
     * @Route("/", name="dashboard_index")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @Template
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $prayers = $this->getPrayerManager()->getNetworkPrayers($user);
        $serializedPrayers = $this->getSerializer()->serialize($prayers, 'json');

        $form = $this->getPrayerForm();

        return array(
            'form' => $form->createView(),
            'prayers' => $prayers,
            'serializedPrayers' => $serializedPrayers,
        );
    }
}
