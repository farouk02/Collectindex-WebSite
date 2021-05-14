<?php

class DataBaseConfig
{
    public $servername;
    public $username;
    public $password;
    public $databasename;

    public function __construct()
    {

        $this->servername = 'http://127.0.0.1/';
        $this->username = 'root';
        $this->password = '';
        $this->databasename = 'ade_db';
    }
}
