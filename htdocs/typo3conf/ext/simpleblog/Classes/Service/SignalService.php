<?php

namespace Pluswerk\Simpleblog\Service;

class SignalService implements \TYPO3\CMS\Core\SingletonInterface {

    /**
     * @param \TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface $object
     */
    public function handleInsertEvent(\TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface $object, $signalInformation) {
        if ($object instanceof \Pluswerk\Simpleblog\Domain\Model\Comment) {
            $content = 'Comment: ' . $object->getComment();
            $content .= ' / ' . $object->getCommentdate()->format('Y-m-d H:i:s');
            $content .= " / " . $signalInformation . chr(10);
            $this->writeLogFile($content);
        }
    }

    /**
     * @param $content string
     */
    public function writeLogFile($content) {
        $logfile = "logfile.txt";
        $handle = fopen($logfile, "a+");
        fwrite($handle, $content);
        fclose($handle);
    }

}
