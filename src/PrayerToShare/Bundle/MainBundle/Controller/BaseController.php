<?php

namespace PrayerToShare\Bundle\MainBundle\Controller;

use PrayerToShare\Bundle\CoreBundle\Controller\CoreController;
use PrayerToShare\Bundle\CoreBundle\Entity\PrayerGroup;
use PrayerToShare\Bundle\CoreBundle\Form\PrayerGroupFormType;
use PrayerToShare\Bundle\MainBundle\Entity\Prayer;
use PrayerToShare\Bundle\MainBundle\Form\PrayerFormType;

class BaseController extends CoreController
{
    protected function getPrayerManager()
    {
        return $this->get('prayer_manager');
    }

    protected function getPrayerForm(Prayer $prayer = null)
    {
        return $this->createForm(new PrayerFormType(), $prayer);
    }

    protected function getPrayerGroupForm(PrayerGroup $prayerGroup = null)
    {
        return $this->createForm(new PrayerGroupFormType(), $prayerGroup);
    }
}
