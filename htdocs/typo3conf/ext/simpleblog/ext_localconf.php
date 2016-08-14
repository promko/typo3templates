<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Pluswerk.' . $_EXTKEY, 'Bloglisting', array(
    'Blog' => 'list,add,addForm,show, update, updateForm, delete, deleteConfirm, rss',
    'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
        ),
        // non-cacheable actions
        array(
    'Blog' => 'list,add,addForm,show, update, updateForm, delete, deleteConfirm, rss',
    'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
        )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Pluswerk\\Simpleblog\\Property\\TypeConverter\\UploadedFileReferenceConverter'
);

$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher'
);
$signalSlotDispatcher->connect(
        'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Backend', 'afterInsertObject', 'Pluswerk\\Simpleblog\\Service\\SignalService', 'handleInsertEvent'
);
$signalSlotDispatcher->connect(
'Pluswerk\\Simpleblog\\Controller\\PostController',
'beforeCommentCreation',
'Pluswerk\\Simpleblog\\Service\\SignalService',
'handleCommentInsertion'
);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Pluswerk\\Simpleblog\\Command\\FileCommandController'] = array(
'extension' => $_EXTKEY,
'title' => 'Filecenter Delete Files',
'description' => 'Deletes Files in Filecenter after the defined period of time',
'additionalFields' => ''
);


