<?php
class e_winrar{
    public static function init(){
        if(self::path() === false){
            echo "Would you like to install WinRAR? It may be required for certain functionalities. You require admin to install it.\n";
            if(user_input::yesNo()){
                self::install();
            }
        }
    }
    public static function install(){
        if(!is_file("C:/Program Files/WinRAR/Rar.exe") && is_admin::check()){
            downloader::downloadFile("https://www.win-rar.com/fileadmin/winrar-versions/winrar/winrar-x64-624.exe","C:/Program Files/WinRAR/installer-winrar-x64-624.exe");
            mklog('general','Instlling WinRAR',false);
            exec("\"C:\\Program Files\\WinRAR\\installer-winrar-x64-624.exe\" /s");
        }
        else{
            mklog('warning','Unable to install WinRAR',false);
        }
    }
    public static function path():string|bool{
        $path = "C:\\Program Files\\WinRAR\\rar.exe";
        if(is_file($path)){
            return $path;
        }
        return false;
    }
    public static function dirToRar($inDir,$outRar):bool{
        $path = self::path();
        if($path !== false){
            mklog('general','Creating rar of ' . $inDir,false);
            return cmd::run('"' . $path . '" a -ep1 -r "' . $outRar . '" "' . $inDir . '"');
        }
        else{
            mklog('warning','WinRAR is not installed',false);
        }
        return false;
    }
}