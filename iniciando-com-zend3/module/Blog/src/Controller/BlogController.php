<?php


namespace Blog\Controller;


use Blog\Form\PostForm;
use Blog\Model\Post;
use Blog\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{

    public function __construct(PostTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $postTable = $this->table;

        return new ViewModel([
            'posts' => $postTable->fetchAll()
        ]);
    }

    public function addAction(){
        $form = new PostForm();
        $form->get('submit')->setValue('Add Post');
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $post = new Post();
        $post->exchangeArray($form->getData());
        $this->table->save($post);
        return $this->redirect()->toRoute('post');
    }

}