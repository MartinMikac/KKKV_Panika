<?php

namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager {

    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;

    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;

    /**
     * RBAC manager.
     * @var User\Service\RbacManager
     */
    private $rbacManager;

    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper, $rbacManager) {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
        $this->rbacManager = $rbacManager;
    }

    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems() {
        $url = $this->urlHelper;
        $items = [];



        /*        $items[] = [
          'id' => 'about',
          'label' => 'about',
          'link'  => $url('about')
          ];
         */
        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        if (!$this->authService->hasIdentity()) {
            $items[] = [
                'id' => 'login',
                'label' => 'Přihlásit',
                'link' => $url('login'),
                'float' => 'right'
            ];
        } else {
            $items[] = [
                'id' => 'home',
                'label' => 'Domů',
                'link' => $url('home')
            ];

            // Determine which items must be displayed in Admin dropdown.
            $adminDropdownItems = [];

            if ($this->rbacManager->isGranted(null, 'user.manage')) {
                $adminDropdownItems[] = [
                    'id' => 'users',
                    'label' => 'Manage Users',
                    'link' => $url('users')
                ];
            }

            if ($this->rbacManager->isGranted(null, 'permission.manage')) {
                $adminDropdownItems[] = [
                    'id' => 'permissions',
                    'label' => 'Manage Permissions',
                    'link' => $url('permissions')
                ];
            }

            if ($this->rbacManager->isGranted(null, 'role.manage')) {
                $adminDropdownItems[] = [
                    'id' => 'roles',
                    'label' => 'Manage Roles',
                    'link' => $url('roles')
                ];
            }


            if ($this->rbacManager->isGranted(null, 'permission.smsUsers')) {
                $adminDropdownItems[] = [
                    'id' => 'smsUsers',
                    'label' => 'SMS List uživatelů',
                    'link' => $url('smsUsers')
                ];
            }

            if (count($adminDropdownItems) != 0) {
                $items[] = [
                    'id' => 'admin',
                    'label' => 'Administrace',
                    'dropdown' => $adminDropdownItems
                ];
            }


            // Katalogizace + Akvizice
            // Determine which items must be displayed in Admin dropdown.
            $catalogDropdownItems = [];

            if ($this->rbacManager->isGranted(null, 'katalog.import_020')) {
                $catalogDropdownItems[] = [
                    'id' => 'import-020',
                    'label' => 'Reimport 020',
                    'link' => $url('import-020')
                ];
            }

            if (count($catalogDropdownItems) != 0) {
                $items[] = [
                    'id' => 'catalog',
                    'label' => 'Katalogizace',
                    'dropdown' => $catalogDropdownItems
                ];
            }



            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'nastaveni',
                        'label' => 'Nastavení',
                        'link' => $url('nastaveni')
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Odhlásit',
                        'link' => $url('logout')
                    ],
                ]
            ];
        }

        return $items;
    }

}
