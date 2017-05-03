<?php

namespace App\TemplateEngine;

use \App\Config;

class Twig
    extends \App\TemplateEngine
{

    public function __construct()
    {
        $this->loader = new \Twig_Loader_Filesystem(ROOT_DIR . Config::instance()->template_dir . '/Twig');
        $this->twig = new \Twig_Environment($this->loader, [
            'cache' => ROOT_DIR . Config::instance()->cache_dir . '/Twig',
            'auto_reload' => true,
            'strict_variables' => true,
            'debug' => true,
        ]);
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->getExtension('Twig_Extension_Core')->setDateFormat(Config::instance()->date_format);
    }

    public function addTemplateDir($templateDir)
    {
        $this->loader->addPath($templateDir);
    }
    public function render($template)
    {
        return $this->twig->render($template . '.html', $this->data);
    }

}