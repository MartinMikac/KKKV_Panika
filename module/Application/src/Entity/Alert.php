<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-11-15 12:44:46.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Alert
 *
 * @ORM\Entity(repositoryClass="AlertRepository")
 * @ORM\Table(name="Alerts", indexes={@ORM\Index(name="Relationship3", columns={"id_admins"})})
 */
class Alert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_alert;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_konec;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id_admins;

    /**
     * @ORM\Column(name="`status`", type="string", length=100)
     */
    protected $status;

    public function __construct()
    {
    }

    /**
     * Set the value of id_alert.
     *
     * @param integer $id_alert
     * @return \Application\Entity\Alert
     */
    public function setIdAlert($id_alert)
    {
        $this->id_alert = $id_alert;

        return $this;
    }

    /**
     * Get the value of id_alert.
     *
     * @return integer
     */
    public function getIdAlert()
    {
        return $this->id_alert;
    }

    /**
     * Set the value of cas_start.
     *
     * @param \DateTime $cas_start
     * @return \Application\Entity\Alert
     */
    public function setCasStart($cas_start)
    {
        $this->cas_start = $cas_start;

        return $this;
    }

    /**
     * Get the value of cas_start.
     *
     * @return \DateTime
     */
    public function getCasStart()
    {
        return $this->cas_start;
    }

    /**
     * Set the value of cas_konec.
     *
     * @param \DateTime $cas_konec
     * @return \Application\Entity\Alert
     */
    public function setCasKonec($cas_konec)
    {
        $this->cas_konec = $cas_konec;

        return $this;
    }

    /**
     * Get the value of cas_konec.
     *
     * @return \DateTime
     */
    public function getCasKonec()
    {
        return $this->cas_konec;
    }

    /**
     * Set the value of id_admins.
     *
     * @param integer $id_admins
     * @return \Application\Entity\Alert
     */
    public function setIdAdmins($id_admins)
    {
        $this->id_admins = $id_admins;

        return $this;
    }

    /**
     * Get the value of id_admins.
     *
     * @return integer
     */
    public function getIdAdmins()
    {
        return $this->id_admins;
    }

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return \Application\Entity\Alert
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function __sleep()
    {
        return array('id_alert', 'cas_start', 'cas_konec', 'id_admins', 'status');
    }
}