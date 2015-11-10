<?php
require_once 'TemplateParser.php';
require_once 'AppController.php';

/**
 *
 * @author yaroshenko
 */
class App {

    private static $instance;
    public static $request;
    private $controller;
    public $parser;

    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
            static::$instance->controller = new AppController();
            static::$instance->parser = new TemplateParser();
            static::sanitizeRequest();
        }

        return static::$instance;
    }

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

    public function run() {
        $this->getController()->handleAction();
    }

    private static function sanitizeRequest() {
        // TODO: Implement sanitizing
        
        self::$request = filter_var_array($_REQUEST);
    }
    
    public function getController() {
        return $this->controller;
    }

}
