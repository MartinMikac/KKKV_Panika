<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-12-27 13:36:56.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Setting
 *
 * @ORM\Entity(repositoryClass="Application\Repository\SettingRepository")
 * @ORM\Table(name="setting", indexes={@ORM\Index(name="fk_Admins_user1_idx", columns={"user_id"})})
 */
class Setting
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $jmeno;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $heslo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $umisteni;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $telefon;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $cele_jmeno;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_online;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_id;

    /**
     * @ORM\OneToOne(targetEntity="\User\Entity\User", inversedBy="setting")
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
     * @return \Application\Entity\Setting
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
     * Set the value of jmeno.
     *
     * @param string $jmeno
     * @return \Application\Entity\Setting
     */
    public function setJmeno($jmeno)
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    /**
     * Get the value of jmeno.
     *
     * @return string
     */
    public function getJmeno()
    {
        return $this->jmeno;
    }

    /**
     * Set the value of heslo.
     *
     * @param string $heslo
     * @return \Application\Entity\Setting
     */
    public function setHeslo($heslo)
    {
        $this->heslo = $heslo;

        return $this;
    }

    /**
     * Get the value of heslo.
     *
     * @return string
     */
    public function getHeslo()
    {
        return $this->heslo;
    }

    /**
     * Set the value of umisteni.
     *
     * @param string $umisteni
     * @return \Application\Entity\Setting
     */
    public function setUmisteni($umisteni)
    {
        $this->umisteni = $umisteni;

        return $this;
    }

    /**
     * Get the value of umisteni.
     *
     * @return string
     */
    public function getUmisteni()
    {
        return $this->umisteni;
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     * @return \Application\Entity\Setting
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of telefon.
     *
     * @param string $telefon
     * @return \Application\Entity\Setting
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get the value of telefon.
     *
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set the value of cele_jmeno.
     *
     * @param string $cele_jmeno
     * @return \Application\Entity\Setting
     */
    public function setCeleJmeno($cele_jmeno)
    {
        $this->cele_jmeno = $cele_jmeno;

        return $this;
    }

    /**
     * Get the value of cele_jmeno.
     *
     * @return string
     */
    public function getCeleJmeno()
    {
        return $this->cele_jmeno;
    }

    /**
     * Set the value of last_online.
     *
     * @param \DateTime $last_online
     * @return \Application\Entity\Setting
     */
    public function setLastOnline($last_online)
    {
        $this->last_online = $last_online;

        return $this;
    }

    /**
     * Get the value of last_online.
     *
     * @return \DateTime
     */
    public function getLastOnline()
    {
        return $this->last_online;
    }

    /**
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\Setting
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
     * Set User entity (one to one).
     *
     * @param \User\Entity\User $user
     * @return \Application\Entity\Setting
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (one to one).
     *
     * @return \User\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __sleep()
    {
        return array('id', 'jmeno', 'heslo', 'umisteni', 'email', 'telefon', 'cele_jmeno', 'last_online', 'user_id');
    }
}