<?php

/**
 *
 * @author yaroshenko
 */
interface Dialog {
    
    public function addMessage(Message $message);
    
    public function showMessages();
}
