<?php 

    class Image {

        private $imagePath;

        public function __construct($key) {
            if(!isset($_FILES[$key])) {
                $this->imagePath = $key;
                return;
            }
            if($_FILES[$key]['error'] != 4) {

                $fileName = $_FILES[$key]['name'];
                $path = file_exists('../images/' . $fileName) ? 'images/' . mt_rand(100, 999) . $fileName : 'images/' . $fileName;
                $optionImage = $_FILES[$key]['error'] == 4 ? '' : explode('/', $path)[1];

                if($optionImage) {
                    move_uploaded_file($_FILES[$key]['tmp_name'], '../' . $path);
                }
                
                $this->imagePath = $optionImage;
            } else {
                $this->imagePath = '';
            }
        }
        public function getImage() {
            return $this->imagePath;
        }
    }

?>