<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use PrayerToShare\Bundle\MainBundle\Entity\Invite;
use PrayerToShare\Bundle\MainBundle\Form\InviteFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/invite")
 */
class InviteController extends BaseController
{
    /**
     * @Route("/list", name="invite_list")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @Template
     */
    public function listAction()
    {
        $form = $this->getInviteForm();

        return array(
            'form' => $form->createView(),
        );
    }

    protected function getInviteForm()
    {
        return $this->createForm(new InviteFormType());
    }
}
