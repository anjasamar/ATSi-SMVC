<?php

    /**
    * Example The home page model database
    */
    class M_Database
    {
        public function DBkoneksi(){
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'YourDbNama';
            $koneksiDB = mysqli_connect($host,$user,$pass,$db); 
            return $koneksiDB;
        }
    }