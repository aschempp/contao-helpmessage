<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
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
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'helplabels';
$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] = str_replace(';{email_legend}', ',helplabels;{email_legend}', $GLOBALS['TL_DCA']['tl_form']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['helplabels_1'] = 'helpicon';
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['helplabels_2'] = 'helpicon';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form']['fields']['helplabels'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form']['helplabels'],
	'exclude'		=> true,
	'inputType'		=> 'radio',
	'options'		=> array(1, 2),
	'reference'		=> &$GLOBALS['TL_LANG']['tl_form']['helplabels_options'],
	'eval'			=> array('submitOnChange'=>true, 'includeBlankOption'=>true, 'blankOptionLabel'=>&$GLOBALS['TL_LANG']['tl_form']['helplabels_options'][0], 'tl_class'=>'clr'),
);

$GLOBALS['TL_DCA']['tl_form']['fields']['helpicon'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form']['helpicon'],
	'exclude'		=> true,
	'inputType'		=> 'fileTree',
	'eval'			=> array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,jpeg,png,gif', 'tl_class'=>'clr'),
);

