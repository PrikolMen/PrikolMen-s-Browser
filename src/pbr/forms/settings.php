<?php
namespace pbr\forms;

use std, gui, framework, pbr;


class settings extends AbstractForm
{

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null)
    {    
        $this->form('MainForm')->setProxy($this->combo_type->value);
        $this->form('MainForm')->cfg->set('host', $this->edit_host->text);
        $this->form('MainForm')->cfg->set('port', $this->edit_port->text);
        $this->form('MainForm')->cfg->set('user', $this->user->text);
        $this->form('MainForm')->cfg->set('pass', $this->pass->text);
        $this->form('MainForm')->cfg->set('proxy', $this->combo_type->value);
       // $this->toast('Сохранено!');
    if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
               $this->textArea->visible = true;
        $this->textArea->text = ('Данные Последней Проверки:
        '.file_get_contents('https://ipinfo.io/json'));
       if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
    }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null)
    {    
    //Сброс настроек
        $this->edit_host->text = null;
        $this->edit_port->text = null;
        $this->user->text = null;
        $this->pass->text = null;
        $this->form('MainForm')->setProxy($this->combo_type->value);
        $this->form('MainForm')->cfg->set('host', null);
        $this->form('MainForm')->cfg->set('port', null);
        $this->form('MainForm')->cfg->set('user', null);
        $this->form('MainForm')->cfg->set('pass', null);
        $this->form('MainForm')->cfg->set('proxy', 'HTTPS');
                
       if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
               $this->textArea->visible = true;
        $this->textArea->text = ('Данные Последней Проверки:
        '.file_get_contents('https://ipinfo.io/json'));
    if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {
        app()->showFormAndWait('proxysite');
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
    //$this->form('MainForm')->timerAlt->stop(); 
                     if($this->form('MainForm')->cfg->get('proxy') == null){
                           $this->combo_type->value = 'HTTPS';  
                     }else{
                       $this->combo_type->value = $this->form('MainForm')->cfg->get('proxy');  
                     }
                     
                     $this->edit_host->text = $this->form('MainForm')->cfg->get('host');
                     $this->edit_port->text = $this->form('MainForm')->cfg->get('port');
                     $this->user->text = $this->form('MainForm')->cfg->get('user');
                     $this->pass->text =  $this->form('MainForm')->cfg->get('pass');
                     
                     
     if($this->form('MainForm')->cfg->get('seacher') === null or $this->form('MainForm')->cfg->get('seacher') =='http://google.com/'){
     
        $this->checkbox3->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = true;
        $this->checkboxAlt->selected = false;
        
        $this->checkbox->enabled = false;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = true;

        $this->form('MainForm')->cfg->set('seacher','http://google.com/');
        
         }elseif($this->form('MainForm')->cfg->get('seacher') =='https://yandex.com/'){
        
        $this->checkbox3->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = false;
        $this->checkboxAlt->selected = true;
        
        $this->checkbox->enabled = true;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = false;
        
        $this->form('MainForm')->cfg->set('seacher','https://yandex.com/');
        
         }elseif($this->form('MainForm')->cfg->get('seacher') =='https://duckduckgo.com/'){
        
        $this->checkbox3->selected = true;
        $this->checkboxAlt->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = false;
        
        $this->checkbox->enabled = true;
        $this->checkbox3->enabled = false;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = true;
        
        $this->form('MainForm')->cfg->set('seacher','https://duckduckgo.com/');
        
             }elseif($this->form('MainForm')->cfg->get('seacher') =='https://mail.ru/'){
        
        $this->checkbox->selected = false;
        $this->checkbox3->selected = false;
        $this->checkboxAlt->selected = false;
        $this->checkbox4->selected = true;
        
        $this->checkbox->enabled = true;
        $this->checkboxAlt->enabled = true;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = false;
        
        $this->form('MainForm')->cfg->set('seacher','https://mail.ru/');
                     }else{
                     $this->edit->text = $this->form('MainForm')->cfg->get('seacher');
                     }
                     
     
        $this->textArea->visible = true;
        $this->textArea->text = ('Данные Последней Проверки:
        '.file_get_contents('https://ipinfo.io/json'));
    }


    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)
    {
     if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }
        //$this->form('MainForm')->timerAlt->start();
        app()->hideForm('settings');
    }

    /**
     * @event checkboxAlt.click 
     */
    function doCheckboxAltClick(UXMouseEvent $e = null)
    {    
        $this->checkbox3->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = false;
        $this->checkboxAlt->selected = true;
        
        $this->checkbox->enabled = true;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = false;
        
        $this->edit->text = null;
        
        $this->requestFocus();
        
        $this->form('MainForm')->cfg->set('seacher','https://yandex.com/');
        $this->form('MainForm')->cfg->save();
    }

    /**
     * @event checkbox3.click 
     */
    function doCheckbox3Click(UXMouseEvent $e = null)
    {    
        $this->checkbox3->selected = true;
        $this->checkboxAlt->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = false;
        
        $this->checkbox->enabled = true;
        $this->checkbox3->enabled = false;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = true;
        
        $this->edit->text = null;
        
        $this->requestFocus();
        
          $this->form('MainForm')->cfg->set('seacher','https://duckduckgo.com/');
    }

    /**
     * @event checkbox4.click 
     */
    function doCheckbox4Click(UXMouseEvent $e = null)
    {    
        $this->checkbox->selected = false;
        $this->checkbox3->selected = false;
        $this->checkboxAlt->selected = false;
        $this->checkbox4->selected = true;
        
        $this->checkbox->enabled = true;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = false;
        $this->checkboxAlt->enabled = true;
        
        $this->edit->text = null;
        
        $this->requestFocus();
        
        $this->form('MainForm')->cfg->set('seacher','https://mail.ru/');
    }

    /**
     * @event checkbox.click 
     */
    function doCheckboxClick(UXMouseEvent $e = null)
    {
        $this->checkbox3->selected = false;
        $this->checkbox4->selected = false;
        $this->checkbox->selected = true;
        $this->checkboxAlt->selected = false;
        
        $this->checkbox->enabled = false;
        $this->checkbox3->enabled = true;
        $this->checkbox4->enabled = true;
        $this->checkboxAlt->enabled = true;
        
        $this->edit->text = null;
        
        $this->requestFocus();
        
        $this->form('MainForm')->cfg->set('seacher','http://google.com/');
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        if($this->edit->text == null){
            $this->toast('Ошибка: заполните поле!');
        }else{
          $this->edit->text = checkUrl($this->edit->text);
          $this->form('MainForm')->cfg->set('seacher',$url);
       }
    }

   function checkUrl($url){
        if(stripos($url,'http://')===false and stripos($url,'https://')===false){
            return 'http://'.$url;
        }
        return $url;
    }

    /**
     * @event edit.keyDown-Enter 
     */
    function doEditKeyDownEnter(UXKeyEvent $e = null)
    {    
        if($this->edit->text == null){
            $this->toast('Ошибка: заполните поле!');
        }else{
          $this->edit->text = checkUrl($this->edit->text);
          $this->form('MainForm')->cfg->set('seacher',$url);
       }
    }

}
