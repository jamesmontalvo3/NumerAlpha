<?php
/**
 * NumerAlpha MediaWiki extension - Provides an incremental tag
 * with zero padded numbers, roman and alpha numbers
 *
 * @link http://www.mediawiki.org/wiki/Extension:NumerAlpha Documentation
 * @file NumerAlpha.php
 * @author Thierry G. Veilleux (Kronoxt)
 * @copyright (C) 2009 Thierry G. Veilleux (Kronoxt)
 * @license http://www.publicdomainmanifesto.org/ Public Domain
 */

// Check if we are being called directly
if ( !defined( 'MEDIAWIKI' ) ) {
        die( 'This file is an extension to MediaWiki and thus not a valid entry point.' );
}

// Tell everybody who we are
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'NumerAlpha',
	'version' => '0.5.0',
	'author' => array( 'Thierry G. Veilleux', 'James Montalvo' ),
	'descriptionmsg' => 'numeralpha-desc',
	'url' => 'https://www.mediawiki.org/wiki/Extension:NumerAlpha'
);

$wgMessagesDirs['NumberAlpha'] = __DIR__ . '/i18n';
$wgHooks['ParserFirstCallInit'][] = 'NumerAlpha::onParserFirstCallInit';
$wgAutoloadClasses['NumerAlpha'] = __DIR__ . '/NumerAlpha.class.php';
