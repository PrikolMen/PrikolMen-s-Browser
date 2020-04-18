<?php
namespace pbr\forms;

use std, gui, framework, pbr;


class profile extends AbstractForm
{

    /**
     * @event email.globalKeyUp-Enter 
     */
    function doEmailGlobalKeyUpEnter(UXKeyEvent $e = null)
    {
        $this->login();
    }

    /**
     * @event pass.globalKeyUp-Enter 
     */
    function doPassGlobalKeyUpEnter(UXKeyEvent $e = null)
    {
        $this->login();
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {
        if($this->pass_and_email_save->selected == true){
        
        $this->globals->set('Login',$this->email->text, 'Saved');
        
        $this->globals->set('Pass',$this->pass->text,'Saved');
        
        $this->globals->set('Saved',$this->pass_and_email_save->selected,'User');
        
        }
        
        $this->login();
    }

    /**
     * @event pass_and_email_save.click 
     */
    function doPass_and_email_saveClick(UXMouseEvent $e = null)
    {    
        
    }

    /**
     * @event link3.action 
     */
    function doLink3Action(UXEvent $e = null)
    {
        $this->reg_check->start();
        
             $this->login_check->stop();
        
             $this->label4->visible = false;
        
             $this->link3->visible = false;
        
            $this->reg_panel->show();
    }



}
