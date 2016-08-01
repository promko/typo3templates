<?php

namespace Pluswerk\Simpleblog\Controller;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Patrick Lobacher <patrick@lobacher.de>, +Pluswerk AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * BlogController
 */
class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\BlogRepository
     */
    protected $blogRepository;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository
     */
    public function injectBlogRepository(\Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    }

    /**
     * action list
     * @param string $search
     * @return void
     */
    public function listAction() {
        $search = '';
        if($this->request->hasArgument('search')) {
            $search = $this->request->getArgument('search');
        }
        $limit = ($this->settings['blog']['max']) ? : NULL;
        $this->view->assign('blogs', $this->blogRepository->findSearchForm($search, $limit));
        $this->view->assign('search', $search);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @validate $blog Pluswerk.Simpleblog:Autocomplete(property=title)
     */
    public function addAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog) {
        $this->blogRepository->add($blog);
//        for ($i = 1; $i <= 3; $i++) {
//            $blog = $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Model\\Blog');
//            $blog->setTitle('This is the ' . $i . '. Blog!');
//            $this->blogRepository->add($blog); //erfolgt immer am Ende der Action, falls keine Persistierung gibt es!!!
//        }
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function addFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL) {
        $this->view->assign('blog', $blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL) {
        $this->view->assign('blog', $blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL) {
        $this->blogRepository->update($blog);
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function deleteAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL) {
        $this->blogRepository->remove($blog);
        $this->redirect('list');
    }

    /**
     *  @var \Pluswerk\Simpleblog\Domain\Model\Blog $blog 
     */
    public function showAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog) {
        $this->view->assign('blog', $blog);
    }

    /**
     *  @var \Pluswerk\Simpleblog\Domain\Model\Blog $blog 
     */
    public function deleteConfirmAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog) {
        $this->view->assign('blog', $blog);
    }

    public function initializeObject() {
//        $this->databaseHandle = $GLOBALS['TYPO3_DB'];
//        $this->databaseHandle->explainOutput = 2;
//        $this->databaseHandle->store_lastBuiltQuery = TRUE;
//        $this->databaseHandle->debugOutput = 2;
    }

}
