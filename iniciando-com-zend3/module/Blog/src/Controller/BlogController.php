<?php


namespace Blog\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{

    public function indexAction()
    {
        $posts = [
          ['title' => 'post1', 'content' => 'content1'],
          ['title' => 'post2', 'content' => 'content2'],
          ['title' => 'post3', 'content' => 'content3'],
          ['title' => 'post4', 'content' => 'content4'],
        ];

        return new ViewModel([
            'posts' => $posts
        ]);
    }

}