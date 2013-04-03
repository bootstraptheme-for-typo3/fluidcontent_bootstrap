<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Content Elements: Twitter Bootstrap');

Tx_Flux_Core::registerProviderExtensionKey('fluidcontent_bootstrap', 'Content');