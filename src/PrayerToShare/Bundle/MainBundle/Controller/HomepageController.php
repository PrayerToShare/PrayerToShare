<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use PrayerToShare\Bundle\MainBundle\Entity\PrayerRequest;
use PrayerToShare\Bundle\MainBundle\Form\PrayerRequestFormType;
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
        $form = $this->getPrayerRequestForm();

        return array(
            'form' => $form->createView(),
        );
    }

    protected function getPrayerRequestForm(PrayerRequest $prayerRequest = null)
    {
        return $this->createForm(new PrayerRequestFormType(), $prayerRequest);
    }
}
