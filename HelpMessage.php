<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009-2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


class HelpMessage extends Frontend
{

	public function findMessages($objWidget, $formId, $arrForm=array())
	{
		if (strlen($objWidget->helpmessage))
		{
			$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/helpmessage/html/helpmessage.js';
			$GLOBALS['TL_CSS'][] = 'system/modules/helpmessage/html/helpmessage.css';
			
			if ($arrForm['helplabels'] < 2)
			{
				$GLOBALS['HELPMESSAGE']['fields']['ctrl_'.$objWidget->id] = $objWidget->helpmessage;
			}
			
			if ($arrForm['helplabels'] > 0)
			{
				$GLOBALS['HELPMESSAGE']['labels']['ctrl_'.$objWidget->id] = $objWidget->helpmessage;
				$GLOBALS['HELPMESSAGE']['icon'] = $arrForm['helpicon'];
			}
		}
		
		return $objWidget;
	}
	
	
	public function injectJavascript($strBuffer)
	{
		if (!is_array($GLOBALS['HELPMESSAGE']))
			return $strBuffer;
			
			
		if (is_array($GLOBALS['HELPMESSAGE']['labels']) && count($GLOBALS['HELPMESSAGE']['labels']))
		{
			foreach( $GLOBALS['HELPMESSAGE']['labels'] as $strId => $strMessage )
			{
				$icon = is_file(TL_ROOT . '/' . $GLOBALS['HELPMESSAGE']['icon']) ? $GLOBALS['HELPMESSAGE']['icon'] : 'system/themes/default/images/show.gif';
				$strBuffer = preg_replace('@(]*for="'.$strId.'"[^>]*>.*?)(</label>)@', '$1 <img src="'.$icon.'" alt="" class="helpicon" /><em class="helpmessage">' . $strMessage . '</em>$2', $strBuffer);
			}
		}
			
		$strJS = "
<script type=\"text/javascript\">
<!--//--><![CDATA[//><!--
window.addEvent('domready', function()
{
	$$('img.helpicon').each( function(el) {
		el.addEvent('mouseover', function(event) { 
			HelpMessage.show(event.target, event.target.getNext('em').get('text'));
		}).addEvent('mouseout', function(event) { 
			HelpMessage.hide(event.target);
		});
	});
	
	$$('em.helpmessage').each( function(el) {
		el.addClass('invisible');
	});
	";
	
		if (is_array($GLOBALS['HELPMESSAGE']['fields']) && count($GLOBALS['HELPMESSAGE']['fields']))
		{
			foreach( $GLOBALS['HELPMESSAGE']['fields'] as $strId => $strMessage )
			{
				$strJS .= "\n	$('" . $strId . "').addEvent('focus', function(event) { HelpMessage.show(event.target, '" . $strMessage . "'); }).addEvent('blur', function(event) { HelpMessage.hide(event.target); });";
			}
		}
	
	$strJS .= "
});
//--><!]]>
</script>
</body>
";

		$strBuffer = str_replace('</body>', $strJS, $strBuffer);

		return $strBuffer;
	}
}

