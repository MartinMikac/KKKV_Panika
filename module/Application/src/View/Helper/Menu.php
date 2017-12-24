<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays a menu bar.
 */
class Menu extends AbstractHelper {

    /**
     * Menu items array.
     * @var array 
     */
    protected $items = [];

    /**
     * Active item's ID.
     * @var string  
     */
    protected $activeItemId = '';

    /**
     * Constructor.
     * @param array $items Menu items.
     */
    public function __construct($items = []) {
        $this->items = $items;
    }

    /**
     * Sets menu items.
     * @param array $items Menu items.
     */
    public function setItems($items) {
        $this->items = $items;
    }

    /**
     * Sets ID of the active items.
     * @param string $activeItemId
     */
    public function setActiveItemId($activeItemId) {
        $this->activeItemId = $activeItemId;
    }

    /**
     * Renders the menu.
     * @return string HTML code of the menu.
     */
    public function render() {
        if (count($this->items) == 0)
            return ''; // Do nothing if there are no items.

        $result = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mb-3 col-md-8 offset-md-2">';
        
        /**
         * Pokud je logo webu. Nastavit zde
         */
        //<a class="navbar-brand" href="#">Logo</a>
        
        $result .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
        $result .= '<span class="navbar-toggler-icon"></span>';
        $result .= '</button>';

        $result .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
        $result .= '<ul class="navbar-nav mr-auto">';

        // Render items
        foreach ($this->items as $item) {
            if (!isset($item['float']) || $item['float'] == 'left')
                $result .= $this->renderItem($item);
        }

        $result .= '</ul>';
        $result .= '<ul class="nav navbar-nav navbar-right">';

        // Render items
        foreach ($this->items as $item) {
            if (isset($item['float']) && $item['float'] == 'right')
                $result .= $this->renderItem($item);
        }

        $result .= '</ul>';
        $result .= '</div>';

        /*
         * Box pro hledání na webu
         * 
          $result .= '<form class="form-inline my-2 my-lg-0">';
          $result .= '  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">';
          $result .= '  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>';
          $result .= '</form>';
         */

        /**
         * Způsob jak ukázat zablokované menu
         */
        /*
          <li class = "nav-item">
          <a class = "nav-link disabled" href = "#">Disabled</a>
          </li >
         */
        
        $result .= '</nav>';

        return $result;
    }

    /**
     * Renders an item.
     * @param array $item The menu item info.
     * @return string HTML code of the item.
     */
    protected function renderItem($item) {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id == $this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';

        $result = '';

        $escapeHtml = $this->getView()->plugin('escapeHtml');


        if (isset($item['dropdown'])) {

            $dropdownItems = $item['dropdown'];

            $result .= '<li class="dropdown ' . ($isActive ? 'active' : '') . '">';
            $result .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $result .= $escapeHtml($label) . ' <b class="caret"></b>';
            $result .= '</a>';

            $result .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';


            foreach ($dropdownItems as $item) {
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';

                $result .= '<a class="dropdown-item" href="' . $escapeHtml($link) . '">' . $escapeHtml($label) . '</a>';
            }
            $result .= '</div>';
            $result .= '</li>';
        } else {

            $link = isset($item['link']) ? $item['link'] : '#';

            $result .= $isActive ? '<li class="active">' : '<li>';
            $result .= '<a class="nav-link" href="' . $escapeHtml($link) . '">' . $escapeHtml($label) . '</a>';
            $result .= '</li>';
        }

        return $result;
    }
    

}
