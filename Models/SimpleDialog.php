<?php

require_once 'Interfaces/Dialog.php';

/**
 * Description of SimpleDialog
 *
 * @author yaroshenko
 */
class SimpleDialog implements Dialog {

    //TODO: pick out common functionality to abstract class

    private $messages;
    private $id;

    public function __construct($id = null) {
        $this->id = $id ? $id : $this->createID();
        $this->messages = new SplObjectStorage();
        $this->getMessagesFromStorageFile();
    }

    public function addMessage(Message $message) {
        $this->messages->attach($message);
        $message->setTime(new DateTime());
        $file = 'Dialogs/dialog#' . $this->id . '.sdg';
        file_put_contents($file, $this->messages->serialize());
    }

    public function showMessages() {
        $html = '';

        $this->messages->rewind();

        while ($this->messages->valid()) {
            $message = $this->messages->current();
            $html .= $message->getHtml();
            $this->messages->next();
        }
        return $html;
    }
    

    public function getID() {
        return $this->id;
    }

    private function createID() {
//      TODO: Implement using of few dialogues  
        return '1';
    }
    private function getMessagesFromStorageFile() {

        // getting messages from storage file;
        $file = 'Dialogs/dialog#' . $this->id . '.sdg';
        if (file_exists($file)) {
            $this->messages->unserialize(file_get_contents($file));
        }
    }

}
