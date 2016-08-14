<?php

namespace Pluswerk\Simpleblog\Controller;

class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\PostRepository
     */
    protected $postRepository;

    /**
     * SignalSlotDispatcher
     *
     * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     * @inject
     */
    protected $signalSlotDispatcher;

    public function initializeAction() {
        $action = $this->request->getControllerActionName();
// pruefen, ob eine andere Action ausser "show" aufgerufen wurde
        if ($action != 'show' && $action != 'ajax') {
// Redirect zur Login Seite falls nicht eingeloggt
            if (!$GLOBALS['TSFE']->fe_user->user['uid']) {
                $this->redirect(NULL, NULL, NULL, NULL, $this->settings['loginpage']);
            }
        }
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     * @param \Pluswerk\Simpleblog\Domain\Model\Comment $comment
     */
    public function ajaxAction(\Pluswerk\Simpleblog\Domain\Model\Post $post, \Pluswerk\Simpleblog\Domain\Model\Comment $comment = NULL) {
// Wenn der Kommentar leer ist, wird nicht persistiert
        if ($comment->getComment() == "")
            return FALSE;
// Datum des Kommentars setzen und den Kommentar zum Post hinzufügen
        $comment->setCommentdate(new \DateTime());
        $post->addComment($comment);

        // Signal for comment
        $this->signalSlotDispatcher->dispatch(
                __CLASS__, 'beforeCommentCreation', array($comment, $post)
        );

        $this->postRepository->update($post);
        $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
        $comments = $post->getComments();
        foreach ($comments as $comment) {
            $json[$comment->getUid()] = array(
                'comment' => $comment->getComment(),
                'commentdate' => $comment->getCommentdate()
            );
        }
        return json_encode($json);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository
     */
    public function injectPostRepository(\Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function addFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post = NULL) {
        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
        $this->view->assign('tags', $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
        $this->view->assign('authors', $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\AuthorRepository')->findAll());
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function addAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $post->setAuthor($this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\AuthorRepository')->findOneByUid($GLOBALS['TSFE']->fe_user->user['uid']));
        $blog->addPost($post);
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->redirect('show', 'Blog', NULL, array('blog' => $blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function showAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
        $this->view->assign('tags', $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
        $this->view->assign('authors', $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\AuthorRepository')->findAll());
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $this->postRepository->update($post);
        $this->redirect('show', 'Blog', NULL, array('blog' => $blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteConfirmAction(
    \Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $this->view->assign('blog', $blog);
        $this->view->assign('post', $post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog, \Pluswerk\Simpleblog\Domain\Model\Post $post) {
        $blog->removePost($post);
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->postRepository->remove($post);
        $this->redirect('show', 'Blog', NULL, array('blog' => $blog));
    }

}
