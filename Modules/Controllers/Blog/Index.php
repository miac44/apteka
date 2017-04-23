<?php

namespace Modules\Controllers\Blog;

use App\Controller;
use App\Config;

class Index extends \App\Controllers\Main
{

    protected function actionIndex()
    {
        $this->view->posts = \Modules\Models\Blog\Post::getLatest(Config::instance()->posts->count_on_start_page);
        $this->view->content = $this->view->render('Blog/posts');
        $this->view->display('index');
    }

    protected function actionPost($data)
    {
        $this->view->post = \Modules\Models\Blog\Post::findById($data['id']);
        $this->view->content = $this->view->render('Blog/post');
        $this->view->display('index');
    }

    protected function actionAuthor($data)
    {
        $this->view->author = \Modules\Models\Blog\Author::findById($data['id']);
        $this->view->content = $this->view->render('Blog/author');
        $this->view->display('index');
    }

}
