<?php
require_once 'Models/SimpleDialog.php';
require_once 'Models/SimpleMessage.php';

/**
 *
 * @author yaroshenko
 */
class AppController {
    const MAIN_HTML_FILENAME = 'Templates/main.tpl';

    public function handleAction() {
        $action = App::$request['action'] ? App::$request['action'] : 'index';
        $this->{'action'.ucfirst($action)}();
    }
    
    private function actionIndex() {
        $parser = App::getInstance()->parser;
        $dialogue = new SimpleDialog(App::$request['dialogue_id']);
        $parser->setContextProperty('messages', $dialogue->showMessages());
        $parser->setContextProperty('dialogue_id', $dialogue->getID());
        echo $parser->parseTemplate($this::MAIN_HTML_FILENAME);
    }
    
    private function actionAddMessage() {
        $dialogue = new SimpleDialog(App::$request['dialogue_id']);
        $message = new SimpleMessage();
        $dialogue->addMessage($message);
        $parser = App::getInstance()->parser;
        $parser->setContextProperty('messages', $dialogue->showMessages());
        $parser->setContextProperty('dialogue_id', $dialogue->getID());
        echo $parser->parseTemplate($this::MAIN_HTML_FILENAME);
    }
}
