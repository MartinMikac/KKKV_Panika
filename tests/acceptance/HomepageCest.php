<?php


class HomepageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
        //echo $test;
    }
    

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        
        /*
        $I->fillField("form input[id=\"fulltext-field\"]", "php");  //do vyhledávacího políčka se zadá php
        $I->click("form button.button--submit");
        $I->waitForElement("div.searchpage", 3);                //počkáme, než se stránka s výsledky načte, ale max. 3 sekundy
        $I->seeNumberOfElements("div.results > div", 13);       //13 výsledků yhledávání
        $I->see("1 filipínské peso", "div.results > div");      //ve výsledcích je kurz filipínského pesa
        $I->click("#navGoods");                                 //překliknu na záložku zboží
        $I->waitForElement("main header", 3);                   //počkám na načtení
        $I->see("Informatika a výpočetní technika", "main header > h1");    //zjistím, že  php spadá pod výpočetní techniku
        $I->click("Zobrazit podrobnosti", "main article");                  //prokliknu se na detail prvního zboží
        $I->seeInCurrentUrl("vyrobek/php-nejen-pro-zacatecniky-cd");        //zkontroluji slug v url    
         
         */
    }
    
    public function tryToCheckWhereIam(AcceptanceTester $I){
        $I->amOnPage('/');
    }

    public function testujiLoginStranku  (AcceptanceTester $I){
        
        $I->amOnPage('/');
        $I->amOnPage('/login');
        // button of form
        $I->fillField("/html/body/div[2]/div/div/form/input[1]", "admin@example.com");
        $I->fillField("/html/body/div[2]/div/div/form/input[2]", "Secur1ty");
        $I->click('//*[@id="poslat"]');
        //$I->wait(2);
    }





    
}

