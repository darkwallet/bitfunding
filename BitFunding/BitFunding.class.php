<?php
/**
 * This class handles formatting fundings in WikiText, specifically anything within
 * <bitfunding></bitfunding> tags (check README).
 */
class BitFunding {
	/**
	 * Bind the renderBitFunding function to the <bitfunding> tag
	 * @param Parser $parser
	 * @return bool true
	 */
	public static function init( &$parser ) {
		$parser->setHook( 'bitfunding', array( 'BitFunding', 'renderBitFunding' ) );
		return true;
	}

	public static function renderBitFunding( $text, $params = array(), $parser ) {
                $goal = $params['goal'];
                $fund = $params['fund'];
                $floor = $params['floor'];
                if (!isset($goal)) {
                        $goal = '86';
                }
                if (!isset($fund)) {
                        $fund = '31oSGBBNrpCiENH3XMZpiP6GTC4tad4bMy';
                }
                if (!isset($floor)) {
                        $floor = '12.94409313';
                }
		// Stylesheet
                $divStr = "<link rel=\"stylesheet\" href=\"/en/extensions/BitFunding/bitfunding.css\" /><div id=\"funding-goal\" style=\"visibility: hidden;\">$goal</div><div id=\"funding-address\" style=\"visibility: hidden;\">$fund</div><div id=\"funding-floor\" style=\"visibility: hidden;\">$floor</div>";
		// Html
		$divStr .= "<div id=\"btc-api-warning\" class=\"alert alert-warning\" style=\"visibility: hidden;\">Display balance
		    API error: refresh page
		    or view balance on <a href=\"https://blockchain.info/address/$fund\"
					  title=\"View on blockchain\" target=\"_blank\">blockchain.info <i
			    class=\"fa fa-external-link fa-lg\"></i></a></div>
		<div id=\"balance-container\">
		    <noscript>
			<div id=\"btc-api-success\" class=\"alert alert-success text-center\">
			    Javascript is disabled in your browser, so check your balance directly on the <a
				href=\"https://blockchain.info/address/$fund\"
				title=\"View on blockchain\">blockchain</a>
			</div>
		    </noscript>
		    <span id=\"btc-total-received\">?</span> of $goal BTC received <a href=\"#\" id=\"refresh-balance\" title=\"Refresh balance\"><i class=\"glyphicon glyphicon-refresh\">refresh</i></a>
		    <br/>
		    <span id=\"btc-total-remaining\">?</span> BTC remaining<br/>
		    <span id=\"unconfirmed-container\">Receiving (unconfirmed)
		    <span id=\"btc-unconfirmed-balance\">?</span> BTC</span>
		    <br/>

		    <progress id=\"pbar\" class=\"determinate\" value=\"0\" max=\"86\"><span>0</span>%</progress><span id='v' style=\"font-size: 4em;\">0%</span></div>";
		// Show address link
		if ($params['showaddress']) {
                	$divStr .= "<h4>Donation Address <a href=\"bitcoin:$fund\" title=\"Open link in wallet\">$fund</a>&nbsp;
            	    <a href=\"https://blockchain.info/address/$fund\" title=\"View on blockchain\">
                	    <i class=\"fa fa-external-link fa-lg\"></i>
        	        </a></h4>";
		}

		// Javascript
		$divStr .= "<script src=\"/en/extensions/BitFunding/bitfunding.js\"></script>";
		return $divStr;
        }
}
