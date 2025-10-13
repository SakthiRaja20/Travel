<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    /**
     * List of loaded models
     *
     * @var array
     */
    public $Hotel_model;
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->_ci_models = array();
    }
}