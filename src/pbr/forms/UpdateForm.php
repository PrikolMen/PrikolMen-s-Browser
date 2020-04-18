<?php
namespace pbr\forms;

use std, gui, framework, pbr;
use bundle\updater\Updater;
use bundle\updater\GitHubUpdater;

class UpdateForm extends AbstractForm
{



    /**
     * @event buttonClose.action 
     */
    function doButtonCloseAction(UXEvent $e = null)
    {    
        Logger::info('Close updater');
        
        app()->hideForm('UpdateForm');
    }

    /**
     * @event buttonDownload.action 
     */
    function doButtonDownloadAction(UXEvent $e = null)
    {    
         // Отправляем приложению сигнал на закрытие программы
        
        $this->updater->closeParentApplication();
        
        
        
        // Показываем прогресс-бар
        
        $this->buttonDownload->visible = false;
        
        $this->buttonClose->visible = false;
        
        !$this->progressBar->visible = true;
        
        $this->progressIndicator->visible = true;
        
         $this->labelStatus->visible = true;
        
        
        
        // Запуск процесса обновления
        
        $this->updater->installUpdate(function(string $status, int $percent){
        
            // Обновляем данные на форме        
        
            $statusText = ['download' => 'Загрузка', 'install' => 'Установка', 'complete' => 'Готово'][$status];
        
            $this->labelStatus->text = $statusText . ' ('.$percent.'%)';
        
            $this->progressBar->progress = $percent;
        
            
        
            if($status == 'complete'){
        
                // По завершению
        
                $this->closeUpdater();
        
            }
        
        });
    }




    /**
     * @var GitHubUpdater 
     */
    public $updater;


}
