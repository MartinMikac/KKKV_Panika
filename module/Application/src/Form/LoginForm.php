<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Application\Entity\Post;

/**
 * Description of LoginForm
 *
 * @author Martin Mikač <martin.mikac at gmail.com>
 */
class LoginForm extends Form {
    //put your code here

    /**
     * Constructor.     
     */
    public function __construct() {
        // Define form name
        parent::__construct('signin-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // (Optionally) set action for this form
        //$this->setAttribute('action', '/login');

        //$this->addElements();
        //$this->addInputFilter();  
    }

}
