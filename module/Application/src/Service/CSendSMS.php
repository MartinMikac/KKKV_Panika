<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Service;


/*
 *   (c) 2004 Dango s.r.o.
 *
 *   @author Marek Palatinus
 *   
 *   PHP trida pro odesilani SMS pres HTTP rozhrani serveru SMS Midlet.
 *   Vice informaci o sluzbe na http://www.smsmidlet.com
 *
 */


/*

  TODO:
  -----
  - Overovani spravnosti syntaxe cisla
  - odebrani prebytecnych znaku v tel.cislech
  - konverze diakritiky nebo odmitnuti zpravy s nepovolenymi znaky
  - urlencode
  - komunikace pres HTTPS ?
  - Podpora ukladani SMS do SQL DB
  
  Navratove kody funkce CSendSMS::SendSMS():
  ------------------------------------
  1 - Uspesne odeslano
  2 - Zarazeno do serverove fronty (SMS bude odeslana co nejdrive, za 1 minutu)
  3 - Neznama chyba na rozhrani
  9 - Spatne zadane nebo neexistujici telefonni cislo
  10 - Nedostatecny kredit na uctu SMS Midlet
  11 - Spatne heslo nebo username
  12 - Pristup z nepovoleneho IP
  13 - Spatny md5 hash
  14 - Neni zadany text (telo zpravy)
  15 - Nelze navazat spojeni se serverem smsmidlet.com
  16 - Neni zadan smstype
  17 - Nepovolena operace

  
*/
  
  class CSendSMS {
    
    var $link;      //resource spojeni se serverem
    var $server_default;	//vychozi IP/URL serveru, na ktery se pripojovat
    var $queue;     //lokalni fronta SMS
    var $queue_len; //pocet SMS v lokalni fronte
    var $results;		//resulty vracene jednotlivym smskam pri odesilani

    var $https;     //komunikovat pres HTTP(==0) nebo HTTPS(==1)
    var $username;  //username SMS Midlet
    var $textpassw; //heslo pro GUI SMS Midlet
    var $hashpassw; //HASH heslo ziskane ze stranek SMS Midlet

    var $opt_https;	//komunikace via HTTP(0) nebo HTTPS(1)
    var $opt_debug;	//realna komunikace(0) nebo pouze simulovani odesilani(1)
    var $opt_print;	//nevypisovat(0)/vypisovat(1) SMS na STDOUT
    var $opt_holdfail;//neuchovavat(0)/uchovavat(1) ve fronte SMS, ktere se nepovedlo odeslat(fce SendAllSMS())
    var $opt_server;		//IP/URL serveru, na ktery se pripojovat (Pozn: pouze pro ladici ucely teto tridy)

    //konstruktor
    function CSendSMS(){

      $this->link=null;

      $this->results=array();
      $this->queue=array();
      $this->queue_len=0;
      $this->server_default='smsmidlet.com';	//smsmidlet.com

      $this->opt_https=0;
      $this->opt_debug=0;
      $this->opt_print=0;
      $this->opt_holdfail=0;

      $this->SetOption('SERVER',$this->server_default);
    }

    //Nastavi vlastnost tridy
    function SetOption($name,$newvalue){
      switch(strtoupper($name)){
        case 'HTTPS': $this->opt_https=(eregi('^[01]$',$newvalue)?$newvalue:0); break;
        case 'DEBUG': $this->opt_debug=(eregi('^[01]$',$newvalue)?$newvalue:0); break;
        case 'PRINT': $this->opt_print=(eregi('^[01]$',$newvalue)?$newvalue:0); break;
        case 'HOLDFAIL': $this->opt_holdfail=(eregi('^[01]$',$newvalue)?$newvalue:0); break;
        case 'SERVER':
					if($newvalue)$this->opt_server=$newvalue;
          else $this->opt_server=$this->server_default;
        break;
        default: return false; break;
      }
      return true;
    }

    //Nastavi prihlasovaci informace pro pripojeni ke sluzbe a otevre spojeni
    function Connect($username,$textpassw,$hashpassw){

      if($this->link)$this->Disconnect();

      $this->username=$username;
      $this->textpassw=$textpassw;
      $this->hashpassw=$hashpassw;

      echo $this->opt_server;
      
      
              
      @$this->link = fsockopen("smsmidlet.com",80,$errno,$errstr,10);
      if(!$this->link)return 15;

      return true;
    }

    //Uzavre existujici spojeni se serverem
    function Disconnect(){
      @fclose($this->link);
      $this->link=null;
      return true;
    }

    //Vrati, jestli je otevrene pripojeni k serveru.
    //Pokud ne, je treba pred volanim Send(All)SMS zavolat Connect!
    function IsConnected(){
			return @$this->link?1:0;
    }

    //Zaradi SMS do lokalni fronty, vrati pocet SMS k odeslani
    function AddSMS($number,$text,$display,$sender=''){
    
      $this->queue[$this->queue_len]['number']=$number;
      $this->queue[$this->queue_len]['text']=$text;
      $this->queue[$this->queue_len]['display']=$display;
      $this->queue[$this->queue_len]['sender']=$sender;
      $this->queue_len++;

      return $this->queue_len;
    }

    //Smaze vsechny SMS z lokalni fronty
    function DeleteSMS(){

      $this->queue=array();
      $this->queue_len=0;  
      return true;
    }

    //Vrati SMS ulozene ve fronte
    function GetSMS(){
			return $this->queue;
    }

    //Vrati resulty jednotlivym SMSkam odeslanym pri poslednim volani SendAllSMS()
    function GetResults(){
			return $this->results;
    }

    //Okamzite odesle jednu SMS (predbehne SMS zarazene do lokalni fronty)
    function SendSMS($number,$text,$display,$sender=''){

      if(!$this->link)return 15;

      $number			=	$number;	//osetrit format cisla
      $sender			=	urlencode($sender);
  		$text       = urlencode(substr($text,0,160));
  		$md5        = md5("{$this->textpassw}{$this->username}");
  		$display    = ($display>0)&&($display<3)?$display:1;
  		$get_query  = "username={$this->username}&password={$this->hashpassw}&hash=$md5&smscount=1&show_SMSID=1";
  		$post_query = "text0=$text&number0=$number&smstype0=$display&sender0=$sender";
			$result			= 3;	//predpokladam, ze od serveru neziskam odezvu

      if($this->opt_https)$URL="https://smsmidlet.com/post_new/";  //HTTPS
      else $URL="/post_new/";                                      //HTTP
      if($this->opt_print)echo "SendSMS(): $number:$display:$sender:$text<br />\r\n";
      if(!$this->opt_debug){

	      //odeslani SMS na server
        fwrite($this->link,"POST {$URL}?{$get_query} HTTP/1.0\r\n".
        									 "Connection: Close\r\n".
                           "Host: smsmidlet.com\r\n".
                           "Content-Type: application/x-www-form-urlencoded\r\n".
                           "Content-Length: ".strlen($post_query)."\r\n".
                           "Cache-Control: no-cache\r\n".
                           "User-Agent: Mozilla/4.72 [en] (Win98; I)\r\n\r\n".$post_query);

        //zpracovani navratove hodnoty
        /*$disconnect=false;
        while(!feof($this->link)){
  	      $res=fgets($this->link,4096);
          if(preg_match("Connection: Close\r\n",$res,$regs))$disconnect=true;  //server uzavrel spojeni
    	    if(preg_match("result0=(.*)\r\n",$res,$regs))$result=$regs[1];
        }*/
        //if($disconnect)$this->Disconnect();
			} else $result=1; //pri DEBUG modu vracet vzdy 'ODESLANO OK'
      $this->Disconnect();
      return $result;

    }	//end of SendSMS()

  }	//end of class

?>
