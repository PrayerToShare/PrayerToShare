<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * This is just a crutch to create the routes needed
 */
class TempController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction()
    {
        return array();
    }

    /**
     * @Route("/account", name="account")
     */
    public function accountAction()
    {
        return array();
    }

    /**
     * @Route("/help", name="help")
     */
    public function helpAction()
    {
        return array();
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settingsAction()
    {
        return array();
    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function privacyAction()
    {
        return array();
    }
}
