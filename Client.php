<?php

class Client
{
  public $codeClient;
  public $firstname;
  public $lastname;
  public $email;
  public $username;
  public $password;

  public function __construct($codeClient, $firstname, $lastname, $email, $username, $password)
  {
    $this->codeClient = $codeClient;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->username = $username;
    $this->password = $password;
  }
}
