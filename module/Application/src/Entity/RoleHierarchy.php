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
 * Application\Entity\RoleHierarchy
 *
 * @ORM\Entity(repositoryClass="Application\Repository\RoleHierarchyRepository")
 * @ORM\Table(name="role_hierarchy", indexes={@ORM\Index(name="IDX_AB8EFB72A44B56EA", columns={"parent_role_id"}), @ORM\Index(name="IDX_AB8EFB72B4B76AB7", columns={"child_role_id"})})
 */
class RoleHierarchy
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $parent_role_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $child_role_id;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="roleHierarchyRelatedByParentRoleIds")
     * @ORM\JoinColumn(name="parent_role_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $roleRelatedByParentRoleId;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="roleHierarchyRelatedByChildRoleIds")
     * @ORM\JoinColumn(name="child_role_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $roleRelatedByChildRoleId;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\RoleHierarchy
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
     * Set the value of parent_role_id.
     *
     * @param integer $parent_role_id
     * @return \Application\Entity\RoleHierarchy
     */
    public function setParentRoleId($parent_role_id)
    {
        $this->parent_role_id = $parent_role_id;

        return $this;
    }

    /**
     * Get the value of parent_role_id.
     *
     * @return integer
     */
    public function getParentRoleId()
    {
        return $this->parent_role_id;
    }

    /**
     * Set the value of child_role_id.
     *
     * @param integer $child_role_id
     * @return \Application\Entity\RoleHierarchy
     */
    public function setChildRoleId($child_role_id)
    {
        $this->child_role_id = $child_role_id;

        return $this;
    }

    /**
     * Get the value of child_role_id.
     *
     * @return integer
     */
    public function getChildRoleId()
    {
        return $this->child_role_id;
    }

    /**
     * Set Role entity related by `parent_role_id` (many to one).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\RoleHierarchy
     */
    public function setRoleRelatedByParentRoleId(Role $role = null)
    {
        $this->roleRelatedByParentRoleId = $role;

        return $this;
    }

    /**
     * Get Role entity related by `parent_role_id` (many to one).
     *
     * @return \Application\Entity\Role
     */
    public function getRoleRelatedByParentRoleId()
    {
        return $this->roleRelatedByParentRoleId;
    }

    /**
     * Set Role entity related by `child_role_id` (many to one).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\RoleHierarchy
     */
    public function setRoleRelatedByChildRoleId(Role $role = null)
    {
        $this->roleRelatedByChildRoleId = $role;

        return $this;
    }

    /**
     * Get Role entity related by `child_role_id` (many to one).
     *
     * @return \Application\Entity\Role
     */
    public function getRoleRelatedByChildRoleId()
    {
        return $this->roleRelatedByChildRoleId;
    }

    public function __sleep()
    {
        return array('id', 'parent_role_id', 'child_role_id');
    }
}