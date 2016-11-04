<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'NumerAlpha' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['NumerAlpha'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['NumerAlphaMagic'] = __DIR__ . '/Magic.php';
	wfWarn(
		'Deprecated PHP entry point used for NumerAlpha extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the NumerAlpha extension requires MediaWiki 1.25+' );
}
