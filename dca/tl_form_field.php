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
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Palettes
 */
foreach( $GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $strField => $strPalette )
{
	if (in_array($strField, array('__selector__')))
		continue;
		
	$GLOBALS['TL_DCA']['tl_form_field']['palettes'][$strField] = preg_replace('@([;|,]value)([;|,])@', '$1,helpmessage$2', $strPalette, -1, $count);
	
	if (!$count)
	{
		$GLOBALS['TL_DCA']['tl_form_field']['palettes'][$strField] = preg_replace('@([;|,]mandatory)([;|,])@', '$1,helpmessage$2', $strPalette);
	}
}


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['value']['eval']['tl_class'] = 'w50';

$GLOBALS['TL_DCA']['tl_form_field']['fields']['helpmessage'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['helpmessage'],
	'inputType'		=> 'text',
	'exclude'		=> true,
	'eval'			=> array('maxlength'=>255, 'tl_class'=>'w50'),
);

