<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Admin extends \Application\Entity\Admin implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * {@inheritDoc}
     * @return array
     */
    public function __sleep()
    {
        $properties = array_merge(['__isInitialized__'], parent::__sleep());

        if ($this->__isInitialized__) {
            $properties = array_diff($properties, array_keys($this->__getLazyProperties()));
        }

        return $properties;
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Admin $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setIdAdmins($id_admins)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdAdmins', [$id_admins]);

        return parent::setIdAdmins($id_admins);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdAdmins()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdAdmins', []);

        return parent::getIdAdmins();
    }

    /**
     * {@inheritDoc}
     */
    public function setJmeno($jmeno)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setJmeno', [$jmeno]);

        return parent::setJmeno($jmeno);
    }

    /**
     * {@inheritDoc}
     */
    public function getJmeno()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJmeno', []);

        return parent::getJmeno();
    }

    /**
     * {@inheritDoc}
     */
    public function setHeslo($heslo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHeslo', [$heslo]);

        return parent::setHeslo($heslo);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeslo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeslo', []);

        return parent::getHeslo();
    }

    /**
     * {@inheritDoc}
     */
    public function setUmisteni($umisteni)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUmisteni', [$umisteni]);

        return parent::setUmisteni($umisteni);
    }

    /**
     * {@inheritDoc}
     */
    public function getUmisteni()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUmisteni', []);

        return parent::getUmisteni();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelefon($telefon)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelefon', [$telefon]);

        return parent::setTelefon($telefon);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefon()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefon', []);

        return parent::getTelefon();
    }

    /**
     * {@inheritDoc}
     */
    public function setCeleJmeno($cele_jmeno)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCeleJmeno', [$cele_jmeno]);

        return parent::setCeleJmeno($cele_jmeno);
    }

    /**
     * {@inheritDoc}
     */
    public function getCeleJmeno()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCeleJmeno', []);

        return parent::getCeleJmeno();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastOnline($last_online)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastOnline', [$last_online]);

        return parent::setLastOnline($last_online);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastOnline()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastOnline', []);

        return parent::getLastOnline();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlert(\Application\Entity\Alert $alert = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlert', [$alert]);

        return parent::setAlert($alert);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlert()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlert', []);

        return parent::getAlert();
    }

    /**
     * {@inheritDoc}
     */
    public function setOnline(\Application\Entity\Online $online = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOnline', [$online]);

        return parent::setOnline($online);
    }

    /**
     * {@inheritDoc}
     */
    public function getOnline()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOnline', []);

        return parent::getOnline();
    }

}
