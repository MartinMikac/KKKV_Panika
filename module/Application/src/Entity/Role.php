<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2018-01-10 21:50:37.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Application\Entity\Role
 *
 * @ORM\Entity(repositoryClass="Application\Repository\RoleRepository")
 * @ORM\Table(name="`role`", uniqueConstraints={@ORM\UniqueConstraint(name="name_idx", columns={"`name`"})})
 */
class Role
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
     * @ORM\OneToMany(targetEntity="RoleHierarchy", mappedBy="roleRelatedByChildRoleId")
     * @ORM\JoinColumn(name="id", referencedColumnName="child_role_id", nullable=false, onDelete="CASCADE")
     */
    protected $roleHierarchyRelatedByChildRoleIds;

    /**
     * @ORM\OneToMany(targetEntity="RoleHierarchy", mappedBy="roleRelatedByParentRoleId")
     * @ORM\JoinColumn(name="id", referencedColumnName="parent_role_id", nullable=false, onDelete="CASCADE")
     */
    protected $roleHierarchyRelatedByParentRoleIds;

    /**
     * @ORM\OneToMany(targetEntity="RolePermission", mappedBy="role")
     * @ORM\JoinColumn(name="id", referencedColumnName="role_id", nullable=false, onDelete="CASCADE")
     */
    protected $rolePermissions;

    /**
     * @ORM\OneToMany(targetEntity="UserRole", mappedBy="role")
     * @ORM\JoinColumn(name="id", referencedColumnName="role_id", nullable=false, onDelete="CASCADE")
     */
    protected $userRoles;

    public function __construct()
    {
        $this->roleHierarchyRelatedByChildRoleIds = new ArrayCollection();
        $this->roleHierarchyRelatedByParentRoleIds = new ArrayCollection();
        $this->rolePermissions = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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
     * Add RoleHierarchy entity related by `child_role_id` to collection (one to many).
     *
     * @param \Application\Entity\RoleHierarchy $roleHierarchy
     * @return \Application\Entity\Role
     */
    public function addRoleHierarchyRelatedByChildRoleId(RoleHierarchy $roleHierarchy)
    {
        $this->roleHierarchyRelatedByChildRoleIds[] = $roleHierarchy;

        return $this;
    }

    /**
     * Remove RoleHierarchy entity related by `child_role_id` from collection (one to many).
     *
     * @param \Application\Entity\RoleHierarchy $roleHierarchy
     * @return \Application\Entity\Role
     */
    public function removeRoleHierarchyRelatedByChildRoleId(RoleHierarchy $roleHierarchy)
    {
        $this->roleHierarchyRelatedByChildRoleIds->removeElement($roleHierarchy);

        return $this;
    }

    /**
     * Get RoleHierarchy entity related by `child_role_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoleHierarchyRelatedByChildRoleIds()
    {
        return $this->roleHierarchyRelatedByChildRoleIds;
    }

    /**
     * Add RoleHierarchy entity related by `parent_role_id` to collection (one to many).
     *
     * @param \Application\Entity\RoleHierarchy $roleHierarchy
     * @return \Application\Entity\Role
     */
    public function addRoleHierarchyRelatedByParentRoleId(RoleHierarchy $roleHierarchy)
    {
        $this->roleHierarchyRelatedByParentRoleIds[] = $roleHierarchy;

        return $this;
    }

    /**
     * Remove RoleHierarchy entity related by `parent_role_id` from collection (one to many).
     *
     * @param \Application\Entity\RoleHierarchy $roleHierarchy
     * @return \Application\Entity\Role
     */
    public function removeRoleHierarchyRelatedByParentRoleId(RoleHierarchy $roleHierarchy)
    {
        $this->roleHierarchyRelatedByParentRoleIds->removeElement($roleHierarchy);

        return $this;
    }

    /**
     * Get RoleHierarchy entity related by `parent_role_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoleHierarchyRelatedByParentRoleIds()
    {
        return $this->roleHierarchyRelatedByParentRoleIds;
    }

    /**
     * Add RolePermission entity to collection (one to many).
     *
     * @param \Application\Entity\RolePermission $rolePermission
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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

    /**
     * Add UserRole entity to collection (one to many).
     *
     * @param \Application\Entity\UserRole $userRole
     * @return \Application\Entity\Role
     */
    public function addUserRole(UserRole $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Remove UserRole entity from collection (one to many).
     *
     * @param \Application\Entity\UserRole $userRole
     * @return \Application\Entity\Role
     */
    public function removeUserRole(UserRole $userRole)
    {
        $this->userRoles->removeElement($userRole);

        return $this;
    }

    /**
     * Get UserRole entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    public function __sleep()
    {
        return array('id', 'name', 'description', 'date_created');
    }
}