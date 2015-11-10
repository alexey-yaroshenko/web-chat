<?php

/**
 *
 * @author yaroshenko
 */
class TemplateParser {

    private $context;

    public function parseTemplate($template_file_name) {
        $tpl = file_get_contents($template_file_name);
        return $this->parseSimpleElements($this->handleJavaScriptElement($tpl));
    }

    public function getContext() {
        return $this->context;
    }
    public function setContext(Array $ctx) {
        if ($this->context) {
            $this->context = array_merge($this->context, $ctx);
        } else {
            $this->context = $ctx;
        }
    }
    
    public function getContextProperty($property) {
        return $this->context[$property];
    }
    public function setContextProperty($property, $value) {
        $this->context[$property] = $value;
    }
    
    private function handleJavaScriptElement($tpl) {
        $scripts = '';
        $javascript = $this->getContextProperty('javascript');
        if(is_array($javascript)){
            foreach ($javascript as $script) {
                $scripts .= "<script type=\"text/javascript\" src=\"$script\"></script>";
            }
        }else{
            $scripts = $javascript;
        }
        return str_replace('{javascript}', $scripts, $tpl);
    }
    private function parseSimpleElements($tpl) {
        return preg_replace_callback("/{\w*}/", 
        function ($matches){
            // TODO: Refactor magic numbers
            $property = substr($matches[0], 1, count($matches[0])-2);
            return $this->context[$property];
        }
        , $tpl);
    }
    

}
