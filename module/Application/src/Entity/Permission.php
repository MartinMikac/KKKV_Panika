<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2018-01-04 07:59:45.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Permission
 *
 * @ORM\Entity(repositoryClass="Application\Repository\PermissionRepository")
 * @ORM\Table(name="permission", uniqueConstraints={@ORM\UniqueConstraint(name="name_idx", columns={"`name`"})})
 */
class Permission
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_created;

    /**
     * @ORM\OneToMany(targetEntity="RolePermission", mappedBy="permission")
     * @ORM\JoinColumn(name="id", referencedColumnName="permission_id", nullable=false, onDelete="CASCADE")
     */
    protected $rolePermissions;

    public function __construct()
    {
        $this->rolePermissions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Permission
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
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Permission
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of description.
     *
     * @param string $description
     * @return \Application\Entity\Permission
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of date_created.
     *
     * @param \DateTime $date_created
     * @return \Application\Entity\Permission
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;

        return $this;
    }

    /**
     * Get the value of date_created.
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Add RolePermission entity to collection (one to many).
     *
     * @param \Application\Entity\RolePermission $rolePermission
     * @return \Application\Entity\Permission
     */
    public function addRolePermission(RolePermission $rolePermission)
    {
        $this->rolePermissions[] = $rolePermission;

        return $this;
    }

    /**
     * Remove RolePermission entity from collection (one to many).
     *
     * @param \Application\Entity\RolePermission $rolePermission
     * @return \Application\Entity\Permission
     */
    public function removeRolePermission(RolePermission $rolePermission)
    {
        $this->rolePermissions->removeElement($rolePermission);

        return $this;
    }

    /**
     * Get RolePermission entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRolePermissions()
    {
        return $this->rolePermissions;
    }

    public function __sleep()
    {
        return array('id', 'name', 'description', 'date_created');
    }
}