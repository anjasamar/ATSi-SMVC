<?php

    /**
    * Example The home page model
    */
    class M_Index
    {

        private $pesan = 'Welcome to ATSi-SMVC.';
        

        function __construct()
        {
            // Your Custom Function
        
        }

        // Set And Send Text From Pesan
        public function pesanSelamatDatang()
        {
            return $this->pesan;
        }

    }