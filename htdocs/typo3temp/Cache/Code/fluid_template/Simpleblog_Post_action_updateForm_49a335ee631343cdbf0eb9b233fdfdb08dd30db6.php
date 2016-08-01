<?php
class FluidCache_Simpleblog_Post_action_updateForm_49a335ee631343cdbf0eb9b233fdfdb08dd30db6 extends \TYPO3\CMS\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getVariableContainer() {
	// @todo
	return new \TYPO3\CMS\Fluid\Core\ViewHelper\TemplateVariableContainer();
}
public function getLayoutName(\TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$currentVariableContainer = $renderingContext->getTemplateVariableContainer();

return 'Default';
}
public function hasLayout() {
return TRUE;
}

/**
 * section main
 */
public function section_b28b7af69320201d1cf206ebf28373980add1451(\TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$currentVariableContainer = $renderingContext->getTemplateVariableContainer();

$output0 = '';

$output0 .= '
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$arguments1 = array();
$arguments1['partial'] = 'Post/Form';
// Rendering Array
$array2 = array();
$array2['headline'] = 'Edit Post';
$array2['action'] = 'update';
$array2['submitmessage'] = 'Update Post!';
$array2['blog'] = $currentVariableContainer->getOrNull('blog');
$array2['post'] = $currentVariableContainer->getOrNull('post');
$array2['tags'] = $currentVariableContainer->getOrNull('tags');
$array2['authors'] = $currentVariableContainer->getOrNull('authors');
$arguments1['arguments'] = $array2;
$arguments1['section'] = NULL;
$arguments1['optional'] = false;
$renderChildrenClosure3 = function() {return NULL;};

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments1, $renderChildrenClosure3, $renderingContext);

$output0 .= '
';


return $output0;
}
/**
 * Main Render function
 */
public function render(\TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$currentVariableContainer = $renderingContext->getTemplateVariableContainer();

$output4 = '';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\LayoutViewHelper
$arguments5 = array();
$arguments5['name'] = 'Default';
$renderChildrenClosure6 = function() {return NULL;};
$viewHelper7 = $self->getViewHelper('$viewHelper7', $renderingContext, 'TYPO3\CMS\Fluid\ViewHelpers\LayoutViewHelper');
$viewHelper7->setArguments($arguments5);
$viewHelper7->setRenderingContext($renderingContext);
$viewHelper7->setRenderChildrenClosure($renderChildrenClosure6);
// End of ViewHelper TYPO3\CMS\Fluid\ViewHelpers\LayoutViewHelper

$output4 .= $viewHelper7->initializeArgumentsAndRender();

$output4 .= '
';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\SectionViewHelper
$arguments8 = array();
$arguments8['name'] = 'main';
$renderChildrenClosure9 = function() use ($renderingContext, $self) {
$currentVariableContainer = $renderingContext->getTemplateVariableContainer();
$output10 = '';

$output10 .= '
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$arguments11 = array();
$arguments11['partial'] = 'Post/Form';
// Rendering Array
$array12 = array();
$array12['headline'] = 'Edit Post';
$array12['action'] = 'update';
$array12['submitmessage'] = 'Update Post!';
$array12['blog'] = $currentVariableContainer->getOrNull('blog');
$array12['post'] = $currentVariableContainer->getOrNull('post');
$array12['tags'] = $currentVariableContainer->getOrNull('tags');
$array12['authors'] = $currentVariableContainer->getOrNull('authors');
$arguments11['arguments'] = $array12;
$arguments11['section'] = NULL;
$arguments11['optional'] = false;
$renderChildrenClosure13 = function() {return NULL;};

$output10 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments11, $renderChildrenClosure13, $renderingContext);

$output10 .= '
';
return $output10;
};

$output4 .= '';

$output4 .= '
';


return $output4;
}


}
#1470091916    3803      