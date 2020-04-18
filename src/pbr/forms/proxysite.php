<?php
namespace pbr\forms;

use std, gui, framework, pbr;


class proxysite extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {
        app()->hideForm('proxysite');
    }

}
