<?php
namespace pbr\modules;

use std, gui, framework, pbr;
use bundle\updater\GitHubUpdater;
use bundle\updater\Updater;

class AppModule extends AbstractModule
{
     /**
     * @event action 
     */
    function construct(){    
        // Берём аргументы, переданные программе на запуск
        $currentVersion = $GLOBALS['argv'][1] ?? "3.6.4"; // 1й - версия проргаммы
        $origFile = $GLOBALS['argv'][2] ?? "PrikolMen's Browser.exe";  // 2й - имя exe-шника программы, которую нужно обновить
        
        // Указываеи имя пользователя и название репозитория
        $updater = new GitHubUpdater('PrikolMen', 'Ezzy-Browser');
        $updater->setCurrentVersion($currentVersion); // Необходим сообщить текущую версию программы, чтоб сравнить её с версией на сервере
        $updater->setOrigFile($origFile); // Перед обновлением программа будет закрыта, а после - запущена заново
        
        Logger::info('Current version: ' . $currentVersion);
        Logger::info('Checking updates');
        
        // Запускаем проверку обновлений
        $updater->checkUpdates(function(bool $check, array $info) use ($updater, $origFile, $currentVersion){
            if(!$check){
                // Если обновлений не было, просто завершаем работу программы
                Logger::info('Update does not found');
                //app()->hideForm('UpdateForm');
                //die;
            } else {        
                // Если же обновления есть - показываем форму
                Logger::info('Found new version: ' . $info['version']);
                
                $form = $this->form('UpdateForm');
                $form->updater = $updater;
                $form->label->text .= ' (' . round($info['size']/1024/1024, 2) . ' МБ)';
                $form->labelVersion->text = $info['version'];
                $form->description->text = $info['description'];
                $form->labelCurrent->text = 'Текущая версия программы: ' . $currentVersion;
                $form->label3->text = 'Исполняемый Файл: ' . basename($origFile);
                $form->show();
            }
        });
    }
}