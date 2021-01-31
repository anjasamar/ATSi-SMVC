<?php

    /**
    * Example The home page controller
    */
    class K_Index
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function ucapanSelamatDatang()
        {
            return $this->model->pesanSelamatDatang();
        }

        public function modelInspek()
        {
            return $this->model->modelInspek();
        }

    }
?>