<?php
namespace pbr\modules;

use std, gui, framework, pbr;


class MainModule extends AbstractModule
{

    /**
     * @event configFile.update 
     */
    function doConfigFileUpdate(ScriptEvent $e = null)
    {    
        // если файл изменился, загружаем новые данные
        $this->cfg->load();
         $this->form('MainForm')->toast('Сохранение Завершено!');
        Logger::info("'config.cfg' has been changed...");
        
        $this->form('settings')->combo_type->value = $this->form('MainForm')->cfg->get('proxy');       
        $this->form('settings')->edit_host->text = $this->form('MainForm')->cfg->get('host');
        $this->form('settings')->edit_port->text = $this->form('MainForm')->cfg->get('port');
        $this->form('settings')->user->text = $this->form('MainForm')->cfg->get('user');
        $this->form('settings')->pass->text =  $this->form('MainForm')->cfg->get('pass');
        
       if($this->form('MainForm')->cfg->get('host') == null){
       $this->form('MainForm')->vpnstaustext->text = 'ВЫКЛ';    
       }else{
       $this->form('MainForm')->vpnstaustext->text = 'ВКЛ';
       }}

    /**
     * @event configFile.make 
     */
    function doConfigFileMake(ScriptEvent $e = null)
    {    
           $this->form('MainForm')->toast('Добро Пожаловать в Ezzy Браузер!');
    }




}
