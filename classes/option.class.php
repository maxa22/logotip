<?php

    class Option extends DatabaseObject {

        protected static $dbTable = 'options';
        protected static $dbFields = ['name', 'price', 'image', 'optionStatus', 'stepId'];
        protected $id;
        public $name;
        public $price;
        public $image;
        protected $optionStatus;
        public $stepId;

        public function __construct($args) {
            $this->id =               $args['id'] ?? '';
            $this->name =             $args['name'];
            $this->price =            $args['price'];
            $this->image =            $args['image'];
            $this->optionStatus =     $args['optionStatus'] ?? '0';
            $this->stepId =           $args['stepId'];
            if($this->image) {
                $imageClass = new Image($this->image);
                $this->image = $imageClass->getImage();
            }
        }
    }