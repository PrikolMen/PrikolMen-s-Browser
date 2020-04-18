<?php
namespace pbr\forms;

use windows;
use std, gui, framework, pbr;

class MainForm extends AbstractForm
{

    /**
     * Текущая версия программы 
     */
    const VERSION = '3.6.2';


    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
                //При первом запуске откроем одну вкладку
        $this->openTab();
             
        if($this->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';   
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
             
             switch($this->cfg->get('proxy')){           
            case 'HTTPS':
                System::setProperty('https.proxyHost', $this->cfg->get('host'));
                System::setProperty('https.proxyPort', $this->cfg->get('port'));
                System::setProperty('https.proxyUser', $this->cfg->get('user'));
                System::setProperty('https.proxyPassword', $this->cfg->get('pass')); 
                break;
                // Если поддерживается https, то заработает и с http, поэтому не ставлю break
            case 'HTTP':
                System::setProperty('http.proxyHost', $this->cfg->get('host'));
                System::setProperty('http.proxyPort', $this->cfg->get('port'));
                System::setProperty('http.proxyUser', $this->cfg->get('user'));
                System::setProperty('http.proxyPassword', $this->cfg->get('pass')); 
            break;    
                     
            case 'SOCKS':
                System::setProperty('socksProxyHost', $this->cfg->get('host'));
                System::setProperty('socksProxyPort', $this->cfg->get('port'));
                System::setProperty('java.net.socks.username', $this->cfg->get('user'));
                System::setProperty('java.net.socks.password', $this->cfg->get('pass'));
            break;}
            $this->browserUrl->requestFocus();
    }




    /**
     * @event keyDown-F5 
     */
    function doKeyDownF5(UXKeyEvent $e = null)
    {    
        $this->getActiveBrowser()->reload();
        
    }

    /**
     * @event keyDown-F12 
     */
    function doKeyDownF12(UXKeyEvent $e = null)
    {    
        $this->getActiveBrowser()->executeScript("(function(F,i,r,e,b,u,g,L,I,T,E){if(F.getElementById(b))return;E=F[i+'NS']&&F.documentElement.namespaceURI;E=E?F[i+'NS'](E,'script'):F[i]('script');E[r]('id',b);E[r]('src',I+g+T);E[r](b,u);(F[e]('head')[0]||F[e]('body')[0]).appendChild(E);E=new Image;E[r]('src',I+L);})(document,'createElement','setAttribute','getElementsByTagName','FirebugLite','4','firebug-lite.js','releases/lite/latest/skin/xp/sprite.png','https://getfirebug.com/','#startOpened');");
    }

    /**
     * @event keyDown-F11 
     */
    function doKeyDownF11(UXKeyEvent $e = null)
    {    
                if($this->getContextForm()->fullScreen == false){
        $this->getContextForm()->fullScreen = true;
        }else{
            $this->getContextForm()->fullScreen = false;
        }
    }

    /**
     * @event showing 
     */
    function doShowing(UXWindowEvent $e = null)
    {    
       //$appdata = Windows::expandEnv('%APPDATA%');
      //$this->cfg->path = ($appdata.'/Roaming/ezzy/');
      if (!fs::exists("browser.bin")) {
      $this->cfg->set('seacher','https://duckduckgo.com/');
    }}


    /**
     * @event keyDown-F1 
     */
    function doKeyDownF1(UXKeyEvent $e = null)
    {
        app()->showForm('DownloadForm');
    }

    /**
     * @event keyDown-PrintScreen 
     */
    function doKeyDownPrintScreen(UXKeyEvent $e = null)
    {    
        var_dump('ScreenShot');
        var_dump($this->tabs->snapshot());
        $this->toast('Был сделан снимок экрана!');
        $img = UXClipboard::getImage();
        //$img = new UXImage(UXClipboard:getImage());
        //$imageView = new UXImageView($img);
        $this->tabs->tabs->add($img);
    }


    /**
     * @event keyDown-Ctrl+Z 
     */
    function doKeyDownCtrlZ(UXKeyEvent $e = null)
    {    
        if($this->getActiveBrowser()->history->currentIndex == 0) return;
        $this->getActiveBrowser()->history->goBack();
    }

    /**
     * @event keyDown-Ctrl+Y 
     */
    function doKeyDownCtrlY(UXKeyEvent $e = null)
    {    
        if($this->getActiveBrowser()->history->currentIndex == sizeof($this->getActiveBrowser()->history->getEntries())-1) return;
        $this->getActiveBrowser()->history->goForward();
    }


    /**
     * @event image.click-Left 
     */
    function doImageClickLeft(UXMouseEvent $e = null)
    {
        $this->browserUrl->text = 'https://steamcommunity.com/id/PrikolMen/'; //http://olegis019g.temp.swtest.ru
        $this->getActiveBrowser()->load($this->checkUrl($this->browserUrl->text));
    }

    /**
     * @event button5.click-Left 
     */
    function doButton5ClickLeft(UXMouseEvent $e = null)
    {
        if($this->getActiveBrowser()->history->currentIndex == 0) return;
        
        $this->getActiveBrowser()->history->goBack();
    }

    /**
     * @event button7.click-Left 
     */
    function doButton7ClickLeft(UXMouseEvent $e = null)
    {
        $doc = $this->getActiveBrowser()->reload();
    }

    /**
     * @event button6.click-Left 
     */
    function doButton6ClickLeft(UXMouseEvent $e = null)
    {
        if($this->getActiveBrowser()->history->currentIndex == sizeof($this->getActiveBrowser()->history->getEntries())-1) return;
        
        $this->getActiveBrowser()->history->goForward();
    }

    /**
     * @event browserUrl.keyDown-Enter 
     */
    function doBrowserUrlKeyDownEnter(UXKeyEvent $e = null)
    {
        $this->getActiveBrowser()->load($this->checkUrl($this->browserUrl->text));
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {
        app()->showForm('settings');
    }

    /**
     * @event add.click-Left 
     */
    function doAddClickLeft(UXMouseEvent $e = null)
    {
        $this->openTab();
        $this->tabs->selectLastTab();
    }

    /**
     * @event tabs.change 
     */
    function doTabsChange(UXEvent $e = null)
    {
     //При смене вкладок меняем url и статус загрузки
        $browser = $this->getActiveBrowser();
        $this->browserUrl->text = $browser->location;
        $this->loadState->visible = $browser->state!='SUCCEEDED';
    }

    /**
     * @event tabs.close 
     */
    function doTabsClose(UXEvent $e = null)
    {
    //Всегда будет открыта по крайней мере одна вкладка
        if($this->tabs->tabs->count == 0){
            $this->openTab();
        }
    }

    /**
     * @event tabs.keyDown-Ctrl+U 
     */
    function doTabsKeyDownCtrlU(UXKeyEvent $e = null)
    {
        $doc = $this->getActiveBrowser()->document;
        $xml = new \php\xml\XmlProcessor;
        
        $new = $this->openTab('xml');
        $new->loadContent($xml->format($doc), 'text/plain');
    }

    /**
     * @event vpnstaustext.click-Left 
     */
    function doVpnstaustextClickLeft(UXMouseEvent $e = null)
    {
        if($this->cfg->get('host') == null){
           $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
           }else{
           $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
           }
    }

    /**
     * @event keyDown-Ctrl+V 
     */
    function doKeyDownCtrlV(UXKeyEvent $e = null)
    {    
       //$url = UXClipboard::getHtml();
       //$this->openTab();
       //$this->tabs->selectLastTab();
    }


    public function getActiveBrowser(){
        $tab = $this->getActiveTab();
        return $tab->content->engine;
    }

    public function getActiveTab(){
        return $this->tabs->tabs[$this->tabs->selectedIndex];
    }
    
    /**
     * Создание новой вкладки браузера
     **/     
    public function openTab(){
    
    if($url == null){
        $seachurl = $this->cfg->get('seacher');
    
            if($seachurl === null){
                   $Seacher = 'https://google.com/';
               }else{
                   $Seacher = $seachurl;
               }
           
        $url = $Seacher;
        }
        
        $tab = new UXTab();
        $tab->text = $url;

        $browser = new UXWebView;
        
        $UserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/606.1 (KHTML, like Gecko) JavaFX/8.0 Safari/606.1';
        
        $browser->engine->userAgent = $UserAgent;
        
        $browser->engine->watchState(function($self, $old, $new) use ($browser, $tab){
            
            if($this->isActive($browser->id)){
                $this->browserUrl->text = $self->location;
                
                if($new!=='SUCCEEDED'){
                    $this->progressBar->progress = -100;
                }else{
                    $this->progressBar->progress = 0;
                }

                $this->loadState->visible = $new!='SUCCEEDED';
            }
            
            // Загрузчтк файлов
            if($old == 'RUNNING' and $new == 'CANCELLED'){
                $this->checkDownload($self->location);
            }

            $tab->text = (is_null($self->title)?substr($self->location,0,15):$self->title);
        });        

        
        $browser->engine->load($url);
        $tab->content = $browser; //*/
        
        $this->tabs->tabs[] = $tab;
        
        return $browser->engine;
    }

    /**
     * Проверяет, является ли переданный id браузера в активной вкладке
     **/
    public function isActive($elid){
        return $elid  ==  $this->getActiveTab()->content->id;
    }
    
    public function getUnique($pref = ''){
        return $pref . Time::Seconds() . rand(0,1000);
    }

    public function checkUrl($url){
        if(stripos($url,'http://')===false and stripos($url,'https://')===false){
            return 'http://'.$url;
        }
        return $url;
    }
    
    public function setProxy($type){
        switch($type){           
            case 'HTTPS':
                System::setProperty('https.proxyHost', $this->form('settings')->edit_host->text);
                System::setProperty('https.proxyPort', $this->form('settings')->edit_port->text);
                System::setProperty('https.proxyUser', $this->form('settings')->user->text);
                System::setProperty('https.proxyPassword', $this->form('settings')->pass->text); 
                break;
                // Если поддерживается https, то заработает и с http, поэтому не ставлю break
            case 'HTTP':
                System::setProperty('http.proxyHost', $this->form('settings')->edit_host->text);
                System::setProperty('http.proxyPort', $this->form('settings')->edit_port->text);
                System::setProperty('http.proxyUser', $this->form('settings')->user->text);
                System::setProperty('http.proxyPassword', $this->form('settings')->pass->text); 
            break;    
                     
            case 'SOCKS':
                System::setProperty('socksProxyHost', $this->form('settings')->edit_host->text);
                System::setProperty('socksProxyPort', $this->form('settings')->edit_port->text);
                System::setProperty('java.net.socks.username', $this->form('settings')->user->text);
                System::setProperty('java.net.socks.password', $this->form('settings')->pass->text);
            break;
        }
    }


}
