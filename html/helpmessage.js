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
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id: $
 */


/**
 * Class HelpMessage
 *
 * Provide methods to handle help messages
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 */
var HelpMessage =
{
	show: function(obj, message)
	{
		if(!obj.element) {
			var pos = obj.getCoordinates().right;
			var options = {
				'opacity' : 0,
				'position' : 'absolute',
				'float' : 'left',
				'left' : pos + -45
			}
			obj.element = new Element('div', {'styles' : options}).injectInside(document.body);
		}
		if (obj.element) {
			obj.element.addClass('messagebox');
			obj.element.empty();
			new Element('p').set('html', message).injectInside(obj.element);
			new Element('span').injectInside(obj.element);

			obj.element.setStyle('top', obj.getCoordinates().top - obj.element.getCoordinates().height - 5);
			
			if (!window.ie7 && obj.element.getStyle('opacity') == 0)
			{
				if (Fx.Styles)
				{
					new Fx.Styles(obj.element, {'duration' : 300}).start({'opacity':[1]});
				}
				else
				{
					new Fx.Morph(obj.element, {'duration' : 300}).start({'opacity':[1]});
				}
			}
			else
			{
				obj.element.setStyle('opacity', 1);
			}
		}
	},
	
	hide: function(el)
	{
		if ($(el.element))
		{
			el.element.empty();
			el.element.removeClass('messagebox');
		}
	}
};
