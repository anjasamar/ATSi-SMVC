<?php

    /**
    * Example The home page view
    */
    class T_Index
    {
        private $model;
        private $kontrol;
        function __construct($kontrol, $model)
        {
            $this->kontrol = $kontrol;
            $this->model = $model;
            print "Hi... <br>";
            $T_IndexHtml = include "TampilanHtml/T_Index.html";
        }
        public function index()
        {
            return $this->kontrol->ucapanSelamatDatang();
        }
        public function action()
        {
            return $this->kontrol->takeAction();
        }
    }
?>
