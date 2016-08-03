<?php

namespacePluswerk\Simpleblog\ViewHelpers;

class DummyTextViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    public function initializeArguments() {
        $this->registerArgument('length', 'integer', 'This is the length of the dummytext', FALSE);
    }

    /**
     * @param int $length
     * @return string
     */
    public function render($length = 100) {
        $length = ($this->arguments['length']) ?: 100;
        $dummytext = ($this->renderChildren()) ?: 'Lorem ipsum dolor sit amet. ';
        $len = strlen($dummytext);
        $repeat = ceil($length / $len);
        for ($i=0; $i <= $repeat; $i++) {
            $dummytext_neu .= $dummytext;
        }
        //$dummytext_neu = substr(str_repeat($dummytext, $repeat), 0, $length);
        return $dummytext_neu;
    }

}
