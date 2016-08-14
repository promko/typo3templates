<?php

namespace Pluswerk\Simpleblog\Command;

/**
 * Class FileCommandController
 *
 * Deletes files after some time
 */
class FileCommandController extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

    public function execute() {
// ObjectManager holen
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
// Repository instanziieren
        $repository = $objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\FileRepository');
// Konfiguration holen
        $configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
        $settings = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $storagePid = $settings['plugin.']['tx_simpleblog.']['persistence.']['storagePid'];
// Query-Settings setzen (PID)
        $querySettings = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setStoragePageIds(array($storagePid));
        $repository->setDefaultQuerySettings($querySettings);
// Repository abfragen
        $files = $repository->findAll();
// ... Dateien löschen ...
        return count($files);
    }

}
