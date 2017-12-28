<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-12-28 22:21:56.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application\Entity\Online
 *
 * @ORM\Entity(repositoryClass="Application\Repository\OnlineRepository")
 * @ORM\Table(name="`online`", indexes={@ORM\Index(name="fk_Onlines_user1_idx", columns={"user_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="id_online", columns={"id"})})
 */
class Online
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

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
     * @ORM\Column(type="integer")
     */
    protected $user_id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="online")
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
     * @return \Application\Entity\Online
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
     * Set the value of user_id.
     *
     * @param integer $user_id
     * @return \Application\Entity\Online
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
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Online
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
        return array('id', 'status', 'cas_prihlaseni', 'cas_refresh', 'user_id');
    }
}