<?php
namespace pbr\modules;

use std, gui, framework, pbr;
use bundle\jurl\jURL;


class DownloadModule extends AbstractModule
{
    public function checkDownload($url){
        app()->getForm('DownloadForm')->fileUrl->text = $url; 
        $this->jdownloader->url = $url;
        $this->jdownloader->checkDownload(function(){
            app()->getForm('DownloadForm')->showAndWait();
        }); 
         }
        
             
    
}