<?php

namespace PrayerToShare\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PrayerToShareUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
