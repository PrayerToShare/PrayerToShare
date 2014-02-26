<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
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

    /**
     * @Route("/view/{id}", name="group_view")
     * @Method({"GET"})
     * @Template
     */
    public function viewAction(PrayerGroup $group)
    {
        return array(
            'group' => $group,
        );
    }

    /**
     * @Route("/new", name="group_new")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @Template
     */
    public function newAction()
    {
        $user = $this->getUser();
        $prayerGroup = $this->getPrayerGroupManager()->createPrayerGroup($user);
        $form = $this->getPrayerGroupForm($prayerGroup);

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/create", name="group_create")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     * @Template("PrayerToShareMainBundle:Group:new.html.twig")
     */
    public function createAction()
    {
        $user = $this->getUser();
        $prayerGroup = $this->getPrayerGroupManager()->createPrayerGroup($user);
        $form = $this->getPrayerGroupForm($prayerGroup);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $this->getEntityManager()->flush();

            return $this->redirect($this->generateUrl('group_edit', array(
                'id' => $prayerGroup->getId(),
            )));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/edit/{id}", name="group_edit")
     * @Secure(roles="ROLE_USER")
     * @Method({"GET"})
     * @Template
     */
    public function editAction(PrayerGroup $prayerGroup)
    {
        $form = $this->getPrayerGroupForm($prayerGroup);

        return array(
            'form' => $form->createView(),
            'prayerGroup' => $prayerGroup,
        );
    }

    /**
     * @Route("/update/{id}", name="group_update")
     * @Secure(roles="ROLE_USER")
     * @Method({"POST"})
     * @Template("PrayerToShareMainBundle:Group:edit.html.twig")
     */
    public function updateAction(PrayerGroup $prayerGroup)
    {
        $form = $this->getPrayerGroupForm($prayerGroup);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $this->getEntityManager()->flush();

            return $this->redirect($this->generateUrl('group_edit', array(
                'id' => $prayerGroup->getId(),
            )));
        }

        return array(
            'form' => $form->createView(),
            'prayerGroup' => $prayerGroup,
        );
    }
}
