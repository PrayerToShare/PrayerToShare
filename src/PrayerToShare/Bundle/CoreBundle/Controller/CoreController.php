<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    protected function getAuthCsrfToken()
    {
        return $this->get('form.csrf_provider')->generateCsrfToken('authenticate');
    }

    protected function getRegistrationForm()
    {
        return $this->get('fos_user.registration.form.factory')->createForm();
    }
}
