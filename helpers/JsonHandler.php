<?php
require_once('IFileHandler.php');
class JsonHandler implements IFileHandler
{
    private $Directory;
    private $Filename;
    function __construct($directory,$filename)
    {
        $this->Directory = $directory;
        $this->Filename = $filename;
        $this->CreateDirectory();
        
        
    }
    
    function CreateDirectory(){
        if (!file_exists($this->Directory)) {
            mkdir($this->Directory,0777,true);
        }
    }


    function ReadFile(){
        $path = "{$this->Directory}/{$this->Filename}.json";
        if (file_exists($path)) {
            $file = fopen($path,'r');

        $data = fread($file,filesize($path));
        fclose($file);

        return json_decode($data);
        }else{
            return array();
        }        
    }



    function WriteFile($data){
        $path = "{$this->Directory}/{$this->Filename}.json";

        $file = fopen($path,'w');
        fwrite($file,json_encode($data));
        fclose($file);
    }

}

?>