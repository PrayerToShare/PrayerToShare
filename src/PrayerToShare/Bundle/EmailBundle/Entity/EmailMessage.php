<?php

namespace PrayerToShare\Bundle\EmailBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PrayerToShare\Bundle\CoreBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="emails")
 */
class EmailMessage
{
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_ERROR = 'error';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $template;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $data;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $status = self::STATUS_PENDING;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct($template, $email)
    {
        $this->template = $template;
        $this->email = $email;
        $this->createdAt = new \DateTime();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setData(array $data = null)
    {
        $this->data = json_encode($data);
    }

    public function getData()
    {
        return json_decode($this->data, true);
    }

    public function getJsonData()
    {
        return $this->data;
    }

    public function setJsonData($jsonData)
    {
        $this->data = $jsonData;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
