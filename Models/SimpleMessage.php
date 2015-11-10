<?php

require_once 'Interfaces/Message.php';

/**
 *
 * @author yaroshenko
 */
class SimpleMessage implements Message {

    const TEMPLATE_FILENAME = 'Templates/message.tpl';

    private $text;
    private $time;

    public function __construct() {
        $this->text = App::$request['message_text'];
    }

    public function getHtml() {
        $parser = new TemplateParser();
        $parser->setContextProperty('text', $this->text);
        $time = $this->getTime();
        if ($time) {
            $parser->setContextProperty('time', $time->format('H:i:s'));
        }
        return $parser->parseTemplate($this::TEMPLATE_FILENAME);
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime(DateTime $time) {
        $this->time = $time;
    }

}
