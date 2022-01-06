<?php


namespace Wepesi\I18n;


class i18n
{
    private string $lang;

    function __construct(string $default_lang=null){
        $this->lang=$default_lang??"en";
    }

    function translate(string $message_text,array $data_value=[]): string
    {
        $file=ROOT."lang/".$this->lang."/language.php";
        $language =[];

        if(is_file($file) && file_exists($file)){
            include($file);
        }
        /**
         * check if the input value key exist
         */
        $message_key = !isset($language[$message_text]) ? $message_text : $language[$message_text];

        /**
         * there is dynamic information then process with replacement
         */
        if( count($data_value) > 0 ){
            $key_value = !isset($language[$message_text]) ? null : $language[$message_text];
            $message_key = $key_value != null ? vsprintf($key_value,$data_value) : vsprintf($message_text,$data_value);
        }

        return  $message_key;
    }
}