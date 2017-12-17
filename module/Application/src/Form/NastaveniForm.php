<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Form;

use Zend\Form\Form;

/**
 * Description of NastaveniForm
 *
 * @author miki
 */
class NastaveniForm extends Form {
    //put your code here

    /**
     * Constructor.     
     */
    public function __construct() {
        // Define form name
        parent::__construct('nastaveni-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // (Optionally) set action for this form
        //$this->setAttribute('action', '/login');
        
        // Add form elements
        $this->addElements();


        //$this->addInputFilter();  
    }
    
    
    // This method adds elements to form (input fields and 
    // submit button).
    private function addElements() {

        // Přidání pole jméno
        $this->add([
            'type' => 'text',
            'name' => 'cele_jmeno',
            'attributes' => [
                'id' => 'inputCeleJmeno'
            ],
            'options' => [
                'label' => 'Celé jméno',
                'placeholder' => 'Celé jméno',
                'class' => 'form-control'
            ],
        ]);
        
        // Přidání pole jméno
        $this->add([
            'type' => 'text',
            'name' => 'umisteni',
            'attributes' => [
                'id' => 'inputUmisteni'
            ],
            'options' => [
                'label' => 'Oddělení',
                'placeholder' => 'Oddělení',
                'class' => 'form-control'
            ],
        ]);        

        // Přidání pole jméno
        $this->add([
            'type' => 'email',
            'name' => 'email',
            'attributes' => [
                'id' => 'inputEmail'
            ],
            'options' => [
                'label' => 'E-mail',
                'placeholder' => 'E-mail',
                'class' => 'form-control'
            ],
        ]);        

        // Přidání pole jméno
        $this->add([
            'type' => 'text',
            'name' => 'jmeno',
            'attributes' => [
                'id' => 'inputJmeno'
            ],
            'options' => [
                'label' => 'Přihlašovací jméno',
                'placeholder' => 'jmeno',
                'class' => 'form-control'
            ],
        ]);            
        
        
        // Přidání pole telefon
        $this->add([
            'type' => 'text',
            'name' => 'telefon',
            'attributes' => [
                'id' => 'inputTelefon'
            ],
            'options' => [
                'label' => 'Telefon',
                'placeholder' => 'telefon',
                'class' => 'form-control'
            ],
        ]);

        // přidání pole Heslo
        $this->add([
            'type' => 'password',
            'name' => 'heslo',
            'attributes' => [
                'id' => 'inputHeslo'
            ],
            'options' => [
                'label' => 'Heslo',
            ],
        ]);


        // Odesílací tlačítko
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Přihlásit se',
            ],
        ]);
    }    

}
