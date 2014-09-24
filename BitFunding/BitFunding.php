<?php
# MediaWiki BitFunding extension v1.0
#
# Based on example code from the Poem extension
#
# To install, copy the extension to your extensions directory and add line
# require_once( "$IP/extensions/BitFunding/BitFunding.php" );
# to the bottom of your LocalSettings.php
#
# To use, check README for syntax.

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'BitFunding',
	'author'         => array( 'BtcDrak', 'Caedes' ),
	'url'            => 'https://github.com/darkwallet/bitfunding',
	'descriptionmsg' => 'bitfunding-desc',
);

$dir = __DIR__ . '/';
$wgAutoloadClasses['BitFunding'] = $dir . 'BitFunding.class.php';
$wgHooks['ParserFirstCallInit'][] = 'BitFunding::init';
//$wgMessagesDirs['BitFunding'] = $dir . 'i18n';
//$wgExtensionMessagesFiles['BitFunding'] =  $dir . 'BitFunding.i18n.php';
