<?php

namespace App;

use \App\Traits\GetterSetter;

abstract class TemplateEngine
{
    use GetterSetter;

    public function render($template)
    {
    }

    public function display($template)
    {
        echo $this->render($template);
    }

}

