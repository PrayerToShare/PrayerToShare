<?php

namespace PrayerToShare\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Put any commonly used methods here
 * All application controllers will extend this class
 */
class CoreController extends Controller
{
    protected function getPrayerGroupManager()
    {
        return $this->get('prayergroup_manager');
    }

    public function getEmailInputParser()
    {
        return $this->get('email.input_parser');
    }

    /**
     * getEntityManager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    /**
     * getRepository
     *
     * @param string $entityName The entity name (ex. PrayerToShareCoreBundle:User)
     *
     * @return Doctrine\ORM\EntityRepository
     */
    protected function getRepository($entityName)
    {
        return $this->getEntityManager()->getRepository($entityName);
    }

    protected function getSecurityContext()
    {
        return $this->get('security.context');
    }

    protected function getSession()
    {
        return $this->get('session');
    }

    protected function getSerializer()
    {
        return $this->get('jms_serializer');
    }

    protected function getFlashBag()
    {
        return $this->getSession()->getFlashBag();
    }

    protected function addMessage($type, $message)
    {
        $this->getFlashBag()->add($type, $message);
    }

    protected function getAuthCsrfToken()
    {
        return $this->get('form.csrf_provider')->generateCsrfToken('authenticate');
    }

    protected function getRegistrationForm()
    {
        return $this->get('fos_user.registration.form.factory')->createForm();
    }

    protected function returnJson($data)
    {
        return new JsonResponse($data);
    }

    protected function redirectToRoute($route, array $params = array())
    {
        return $this->redirect($this->generateUrl($route, $params));
    }
}
