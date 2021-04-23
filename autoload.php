<?php
spl_autoload_register('autoloadHandler');
function autoloadHandler($className)
{   
    $newclass=explode("\\",$className);
    $newclass[0]=strtolower($newclass[0]);
    $newclass2=implode("/",$newclass);
    $file_name=$newclass2.".php";
    $include_file="../$file_name";
    if(file_exists($include_file))
    {   
        include "$include_file";
    }
    else
    {
        echo "Error 404.File not found";
    }
}