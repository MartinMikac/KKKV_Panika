<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-12-17 20:04:20.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Online
 *
 * @ORM\Entity(repositoryClass="Application\Repository\OnlineRepository")
 * @ORM\Table(name="Onlines", indexes={@ORM\Index(name="fk_Onlines_Admins1_idx", columns={"Admins_id_admins"})}, uniqueConstraints={@ORM\UniqueConstraint(name="id_online", columns={"id_Online"})})
 */
class Online
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id_Online;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $Admins_id_admins;

    /**
     * @ORM\Column(name="`status`", type="string", length=100, nullable=true)
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_prihlaseni;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_refresh;

    /**
     * @ORM\OneToOne(targetEntity="Admin", inversedBy="online")
     * @ORM\JoinColumn(name="Admins_id_admins", referencedColumnName="id_admins", nullable=false)
     */
    protected $admin;

    public function __construct()
    {
    }

    /**
     * Set the value of id_Online.
     *
     * @param integer $id_Online
     * @return \Application\Entity\Online
     */
    public function setIdOnline($id_Online)
    {
        $this->id_Online = $id_Online;

        return $this;
    }

    /**
     * Get the value of id_Online.
     *
     * @return integer
     */
    public function getIdOnline()
    {
        return $this->id_Online;
    }

    /**
     * Set the value of Admins_id_admins.
     *
     * @param integer $Admins_id_admins
     * @return \Application\Entity\Online
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
     * Set the value of status.
     *
     * @param string $status
     * @return \Application\Entity\Online
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
     * Set the value of cas_prihlaseni.
     *
     * @param \DateTime $cas_prihlaseni
     * @return \Application\Entity\Online
     */
    public function setCasPrihlaseni($cas_prihlaseni)
    {
        $this->cas_prihlaseni = $cas_prihlaseni;

        return $this;
    }

    /**
     * Get the value of cas_prihlaseni.
     *
     * @return \DateTime
     */
    public function getCasPrihlaseni()
    {
        return $this->cas_prihlaseni;
    }

    /**
     * Set the value of cas_refresh.
     *
     * @param \DateTime $cas_refresh
     * @return \Application\Entity\Online
     */
    public function setCasRefresh($cas_refresh)
    {
        $this->cas_refresh = $cas_refresh;

        return $this;
    }

    /**
     * Get the value of cas_refresh.
     *
     * @return \DateTime
     */
    public function getCasRefresh()
    {
        return $this->cas_refresh;
    }

    /**
     * Set Admin entity (one to one).
     *
     * @param \Application\Entity\Admin $admin
     * @return \Application\Entity\Online
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
        return array('id_Online', 'Admins_id_admins', 'status', 'cas_prihlaseni', 'cas_refresh');
    }
}