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
 * Application\Entity\Online
 *
 * @ORM\Entity(repositoryClass="OnlineRepository")
 * @ORM\Table(name="Onlines", uniqueConstraints={@ORM\UniqueConstraint(name="id_online", columns={"id_online"})})
 */
class Online
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_online;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id_admins;

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

    public function __construct()
    {
    }

    /**
     * Set the value of id_online.
     *
     * @param integer $id_online
     * @return \Application\Entity\Online
     */
    public function setIdOnline($id_online)
    {
        $this->id_online = $id_online;

        return $this;
    }

    /**
     * Get the value of id_online.
     *
     * @return integer
     */
    public function getIdOnline()
    {
        return $this->id_online;
    }

    /**
     * Set the value of id_admins.
     *
     * @param integer $id_admins
     * @return \Application\Entity\Online
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

    public function __sleep()
    {
        return array('id_online', 'id_admins', 'status', 'cas_prihlaseni', 'cas_refresh');
    }
}