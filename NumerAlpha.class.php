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

class NumerAlpha {

	static $numer = array(
		0 => 1, // alpha
		1 => 1, // arabic
		2 => 1, // roman
	);

	// Hook our callback function into the parser
	static public function onParserFirstCallInit ( Parser &$parser ) {
		// When the parser sees the <sample> tag, it executes
		// the wfSampleRender function (see below)
		$parser->setHook( 'ia', 'NumerAlpha::renderAlpha' );
		$parser->setHook( 'ir', 'NumerAlpha::renderRoman' );
		$parser->setHook( 'in', 'NumerAlpha::renderNumeral' );
		// Always return true from this function. The return value does not denote
		// success or otherwise have meaning - it just must always be true.
		return true;
	}

	static public function renderAlpha( $input, array $argv, Parser $parser, PPFrame $frame ) {

		if (isset($argv['reset']) && $argv['reset'] == "yes" OR isset($argv['reset']) && $argv['reset'] == "1") {self::$numer[0] = 1;}
		if (isset($argv['begin']) && $argv['begin'] != "") {self::$numer[0] = $argv['begin'];}
		$num = self::$numer[0]++;
		$num = intval($num);
		$alpha = "";
		while($num >= 1) {
			$num = $num - 1;
			$alpha = chr(($num % 26)+97).$alpha; //we use the ascii table. //I don't remember where I pick this idea... but  it's not from me... well I coded it...
			$num = $num / 26;
		}

		$output = $alpha;
		return  htmlspecialchars($output .'. '. $input ).'<br/>';
	}


	static public function renderNumeral ( $input, array $argv, Parser $parser, PPFrame $frame ) {
		if (isset($argv['reset']) && $argv['reset'] == "yes" OR isset($argv['reset']) && $argv['reset'] == "1") {self::$numer[1] = 1;}
		if (isset($argv['begin']) && $argv['begin'] != "") {self::$numer[1] = $argv['begin'];}
		$num = self::$numer[1]++;
		$num = intval($num);
		$length = 2;   ////////////////////YOU CAN CHANGE THE LENGHT for the zeros padding here.
		$output = str_pad($num,$length,"0",STR_PAD_LEFT);
		return  htmlspecialchars($output .'. '. $input).'<br/>';
	}


	static public function renderRoman ( $input, array $argv, Parser $parser, PPFrame $frame ) {

		if (isset($argv['reset']) && $argv['reset'] == "yes" OR isset($argv['reset']) && $argv['reset'] == "1") {self::$numer[2] = 1;}
		if (isset($argv['begin']) && $argv['begin'] != "") {self::$numer[2] = $argv['begin'];}
		$num = self::$numer[2]++;
		$n = intval($num);
		$result = '';
		$equival = array(
		'm' => 1000,
		'cm' => 900,
		'd' => 500,
		'cd' => 400,
		'c' => 100,
		'xc' => 90,
		'l' => 50,
		'xl' => 40,
		'x' => 10,
		'ix' => 9,
		'v' => 5,
		'iv' => 4,
		'i' => 1
		);
		foreach ($equival as $roma => $val)
		{
			$concordances = intval($n / $val);
			 $result .= str_repeat($roma, $concordances);
					$n = $n % $val;
		}

		$output = $result;

		return  htmlspecialchars($output .'. '. $input).'<br/>';
	}

}