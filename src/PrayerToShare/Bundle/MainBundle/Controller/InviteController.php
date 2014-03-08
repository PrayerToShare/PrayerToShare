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

    /**
     * @Route("/send", name="invite_send")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     * @Template
     */
    public function sendAction()
    {
        $form = $this->getInviteForm();
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $data = $form->getData();
            $emails = $this->getEmailInputParser()->parseEmails($data['emails']);

            $user = $this->getUser();
            $this->getInviteManager()->sendInvitesToEmails($user, $emails);

            return $this->redirectToRoute('invite_list');
        }

        return array(
            'form' => $form->createView(),
        );
    }

    protected function getInviteForm()
    {
        return $this->createForm(new InviteFormType());
    }
}
