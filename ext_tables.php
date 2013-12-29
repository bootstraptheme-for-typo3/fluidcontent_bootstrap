<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Content Elements: Twitter Bootstrap');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('FluidTYPO3.FluidcontentBootstrap', 'Content');
