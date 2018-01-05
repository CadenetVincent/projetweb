<?php

Class User
{

protected $_id;
protected $_civilite;
protected $_nom;
protected $_prenom;
protected $_cp;
protected $_ville;

protected $_adresse;
protected $_naissance;
protected $_mail;
protected $_inscription;
protected $_acces;

protected $_rang;
protected $_place;
protected $_equipeadv;
protected $_rencontre;
protected $_validation;

  public function __construct($_civilite, $_nom, $_prenom, $_cp, $_ville, $_adresse, $_naissance, $_mail, $_inscription, $_acces, $_rang, $_place, $_equipeadv, $_rencontre, $_validation, $_id) 
  {

  $this->setId($_id);
  $this->setCivilite($_civilite);
  $this->setNom($_nom);
  $this->setPrenom($_prenom);
  $this->setCp($_cp);
  $this->setVille($_ville);

  $this->setAdresse($_adresse);
  $this->setNaissance($_naissance);
  $this->setMail($_mail);
  $this->setInscription($_inscription);
  $this->setAcces($_acces);

  $this->setRang($_rang);
  $this->setPlace($_place);
  $this->setEquipeadv($_equipeadv);
  $this->setRencontre($_rencontre);
  $this->setValidation($_validation);
  }

// LISTE DES GETTERS

public function getId()
{
return $this->_id;
}

public function getCivilite()
{
return $this->_civilite;
}

public function getNom()
{
return $this->_nom;
}

public function getPrenom()
{
return $this->_prenom;
}

public function getCp()
{
return $this->_cp;
}

public function getVille()
{
return $this->_ville;
}

public function getAdresse()
{
return $this->_adresse;
}

public function getNaissance()
{
return $this->_naissance;
}

public function getMail()
{
return $this->_mail;
}

public function getInscription()
{
return $this->_inscription;
}

public function getAcces()
{
return $this->_acces;
}

public function getRang()
{
return $this->_rang;
}

public function getPlace()
{
return $this->_place;
}

public function getEquipeadv()
{
return $this->_equipeadv;
}

public function getRencontre()
{
return $this->_rencontre;
}

public function getValidation()
{
return $this->_validation;
}


  public function setId($_id)
  {

    $_id=(int)$_id;

    $this->_id = $_id;
  }


  public function setCivilite($_civilite)
  {
    $_civilite = (string) $_civilite;

    if ($_civilite == "Monsieur" || $_civilite == "Madame" || $_civilite == "Mademoiselle")
    {
      $this->_civilite = $_civilite;
    }
  }


  public function setNom($_nom)
  {
    $_nom = (string) $_nom;

    if (strlen($_nom)>=2 && strlen($_nom)<26)
    {
      $this->_nom = $_nom;
    }
  }

  public function setPrenom($_prenom)
  {
    $_prenom = (string) $_prenom;

    if (strlen($_prenom)>=2 && strlen($_prenom)<26)
    {
      $this->_prenom = $_prenom;
    }
  }

   public function setCp($_cp)
  {
    $_cp = (string) $_cp;

    if (strlen($_cp)==5 || strlen($_cp)==6)
    {
      $this->_cp = $_cp;
    }
  }

   public function setVille($_ville)
  {
    $_ville = (string) $_ville;

    if (strlen($_ville)>=2 && strlen($_ville)<=26)
    {
      $this->_ville = $_ville;
    }
  }

   public function setAdresse($_adresse)
  {
    $_adresse = (string) $_adresse;

    if (strlen($_adresse)>=4 && strlen($_adresse)<=30)
    {
      $this->_adresse = $_adresse;
    }
  }

   public function setNaissance($_naissance)
  {
    $_naissance = (string) $_naissance;

    if (strlen($_naissance)==10 && $this->validateDate($_naissance))
    {
      $this->_naissance = $_naissance;
    }
  }

   public function setMail($_mail)
  {
    $_mail = (string) $_mail;

    if (strlen($_mail)>=4 && strlen($_mail)<=30)
    {
      $this->_mail = $_mail;
    }
  }

   public function setInscription($_inscription)
  {
      $this->_inscription = $_inscription;
  }

   public function setAcces($_acces)
  {
    $_acces = (string) $_acces;

    if (strlen($_acces) == 1)
    {
      $this->_acces = $_acces;
    }
  }

  public function setRang($_rang)
  {
    $_rang = (int) $_rang;

    if ($_rang <= 201 && $_rang >=1 )
    {
      $this->_rang = $_rang;
    }
  }

   public function setPlace($_place)
  {
    $_place = (int) $_place;

    if ($_place <= 4020 && $_place >= 0 )
    {
      $this->_place = $_place;
    }
  }

    public function setEquipeadv($_equipeadv)
  {
    $_equipeadv = (string) $_equipeadv;

    if (strlen($_equipeadv) >= 4 && strlen($_equipeadv) < 16)
    {
      $this->_equipeadv = $_equipeadv;
    }
  }

  

  public function setRencontre($_rencontre)
  {
    $_rencontre = (string) $_rencontre;

    if (strlen($_rencontre)== 10 && $this->validateDate($_rencontre))
    {
      $this->_rencontre = $_rencontre;
    }
  }

// VALIDATION ok

  public function setValidation($_validation)
  {
    $_validation = (int) $_validation;

    if ($_validation == 0 || $_validation == 1 || $_validation == 2 )
    {
      $this->_validation = $_validation;
    }
  }

// Check format date 1

function validateDate($date, $format = 'Y-m-d')
{
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}



}


?>
