<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-11-15 13:12:13.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Alert
 *
 * @ORM\Entity(repositoryClass="AlertRepository")
 * @ORM\Table(name="Alerts", indexes={@ORM\Index(name="fk_Alerts_Admins_idx", columns={"Admins_id_admins"})})
 */
class Alert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id_alert;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $Admins_id_admins;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_konec;

    /**
     * @ORM\Column(name="`status`", type="string", length=100)
     */
    protected $status;

    /**
     * @ORM\OneToOne(targetEntity="Admin", inversedBy="alert")
     * @ORM\JoinColumn(name="Admins_id_admins", referencedColumnName="id_admins", nullable=false)
     */
    protected $admin;

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
     * Set the value of Admins_id_admins.
     *
     * @param integer $Admins_id_admins
     * @return \Application\Entity\Alert
     */
    public function setAdminsIdAdmins($Admins_id_admins)
    {
        $this->Admins_id_admins = $Admins_id_admins;

        return $this;
    }

    /**
     * Get the value of Admins_id_admins.
     *
     * @return integer
     */
    public function getAdminsIdAdmins()
    {
        return $this->Admins_id_admins;
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

    /**
     * Set Admin entity (one to one).
     *
     * @param \Application\Entity\Admin $admin
     * @return \Application\Entity\Alert
     */
    public function setAdmin(Admin $admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get Admin entity (one to one).
     *
     * @return \Application\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    public function __sleep()
    {
        return array('id_alert', 'Admins_id_admins', 'cas_start', 'cas_konec', 'status');
    }
}