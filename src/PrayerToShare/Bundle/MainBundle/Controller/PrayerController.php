<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
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

        return $this->redirect($this->generateUrl('dashboard_index'));
    }

    /**
     * @Route("/group/{id}", name="prayer_create_group")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     */
    public function createGroupPrayerAction(PrayerGroup $prayerGroup)
    {
        $user = $this->getUser();
        $prayer = $this->getPrayerManager()->createPrayer($user, $prayerGroup);

        $form = $this->getPrayerForm($prayer);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $this->getEntityManager()->flush();
        }

        return $this->redirect($this->generateUrl('group_view', array(
            'id' => $prayerGroup->getId(),
        )));
    }

    /**
     * @Route("/{id}/user-list/create", name="prayer_create_user_list")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     */
    public function createUserPrayerList(Prayer $prayer)
    {
        $user = $this->getUser();
        $prayer = $this->getPrayerManager()->createUserPrayerList($user, $prayer);
        $this->getEntityManager()->flush();

        return $this->returnJson(array('success' => true));
    }

    /**
     * @Route("/{id}/user-list/delete", name="prayer_remove_user_list")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     */
    public function removeUserPrayerList(Prayer $prayer)
    {
        $user = $this->getUser();
        $userPrayerList = $this->getPrayerManager()->getUserPrayerList($user, $prayer);
        $this->getEntityManager()->remove($userPrayerList);
        $this->getEntityManager()->flush();

        return $this->returnJson(array('success' => true));
    }

    /**
     * @Route("/{id}/archive", name="prayer_archive")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     */
    public function archiveAction(Prayer $prayer)
    {
        $user = $this->getUser();
        $this->getPrayerManager()->archivePrayer($user, $prayer);
        $this->getEntityManager()->flush();

        return $this->returnJson(array('success' => true));
    }

    /**
     * @Route("/", name="prayer_list")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $user = $this->getUser();
        $prayers = $this->getPrayerManager()->getNetworkPrayers($user);
        $serializedPrayers = $this->getSerializer()->serialize($prayers, 'json');

        return $this->returnJson(json_decode($serializedPrayers));
    }
}
