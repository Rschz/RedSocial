<?php

interface IFileHandler{
    function CreateDirectory();
    function ReadFile();
    function WriteFile($data);
}


?>