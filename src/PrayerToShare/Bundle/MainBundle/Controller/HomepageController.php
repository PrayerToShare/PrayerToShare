<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use PrayerToShare\Bundle\MainBundle\Form\PrayerFormType;
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
        $form = $this->getPrayerForm();

        return array(
            'form' => $form->createView(),
        );
    }

    protected function getPrayerForm(Prayer $prayer = null)
    {
        return $this->createForm(new PrayerFormType(), $prayer);
    }
}
