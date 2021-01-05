<?php
    
    class Calculator extends DatabaseObject {
        protected static $dbTable = 'calculator';
        protected static $dbFields = array('name', 'estimateText', 'heading', 'calculatorText', 'button', 'logo', 'backgroundColor', 'color', 'currency', 'archived', 'defaultCalculators', 'userId');
        protected $id;
        protected $name;
        protected $estimateText;
        protected $heading;
        protected $calculatorText;
        protected $button;
        protected $logo;
        protected $backgroundColor;
        protected $color;
        protected $currency;
        protected $archived;
        protected $defaultCalculators;
        protected $userId;

        public function __construct($args) {
            $this->id =                 $args['id'] ?? '';
            $this->name =               $args['name'];
            $this->estimateText =       $args['estimateText'];
            $this->heading =            $args['heading'];
            $this->calculatorText =     $args['calculatorText'];
            $this->button =             $args['button'];
            $this->logo =               $args['logo'];
            $this->backgroundColor =    $args['backgroundColor'];
            $this->color =              $args['color'];
            $this->currency =           $args['currency'];
            $this->archived =           $args['archived'] ?? '0';
            $this->defaultCalculators = $args['defaultCalculators'] ?? '0';
            $this->userId =             $args['userId'];
            if($this->logo) {
                $image = new Image($this->logo);
                $this->logo = $image->getImage();
            }
        }

        public function setId($id) {
            $this->id = $id;
        }

    } //end of class
?>