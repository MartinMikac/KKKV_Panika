<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2018-01-10 21:50:37.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Alert
 *
 * @ORM\Entity(repositoryClass="Application\Repository\AlertRepository")
 * @ORM\Table(name="alert", indexes={@ORM\Index(name="fk_Alerts_user1_idx", columns={"user_id"})})
 */
class Alert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cas_konec;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vyresil;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    protected $poznamka;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="alert")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Alert
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set the value of isActive.
     *
     * @param boolean $isActive
     * @return \Application\Entity\Alert
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of isActive.
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\Alert
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of user_id.
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of vyresil.
     *
     * @param string $vyresil
     * @return \Application\Entity\Alert
     */
    public function setVyresil($vyresil)
    {
        $this->vyresil = $vyresil;

        return $this;
    }

    /**
     * Get the value of vyresil.
     *
     * @return string
     */
    public function getVyresil()
    {
        return $this->vyresil;
    }

    /**
     * Set the value of poznamka.
     *
     * @param string $poznamka
     * @return \Application\Entity\Alert
     */
    public function setPoznamka($poznamka)
    {
        $this->poznamka = $poznamka;

        return $this;
    }

    /**
     * Get the value of poznamka.
     *
     * @return string
     */
    public function getPoznamka()
    {
        return $this->poznamka;
    }

    /**
     * Set User entity (one to one).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Alert
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (one to one).
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __sleep()
    {
        return array('id', 'cas_start', 'cas_konec', 'isActive', 'user_id', 'vyresil', 'poznamka');
    }
}