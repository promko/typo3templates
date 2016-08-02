<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pluswerk.' . $_EXTKEY,
	'Bloglisting',
	array(
		'Blog' => 'list,add,addForm,show, update, updateForm, delete, deleteConfirm',
        'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',	
	),
	// non-cacheable actions
	array(
		'Blog' => 'list,add,addForm,show, update, updateForm, delete, deleteConfirm',
		'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
	)
);
