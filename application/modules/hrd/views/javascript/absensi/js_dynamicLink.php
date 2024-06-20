<script type="text/javascript">  
/**
 * Copyright (c) 2012, Dr. Oleg Kiriljuk, oleg.kiriljuk@ok-soft-gmbh.com
 * Dual licensed under the MIT and GPL licenses
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
 * Date: 2012-01-28
 */

/*global jQuery */
(function ($) {
    'use strict';
    /*jslint unparam: true */
    $.extend($.fn.fmatter, {
        dynamicLink: function (cellValue, options, rowData) {
		//alert(cellValue);
            // href, target, rel, title, onclick
            // other attributes like media, hreflang, type are not supported currently
            //var op = {url: '#'};
			 var op = {url: '#'}, attr, attrName, attrValue, attrStr = '';
			
            if (typeof options.colModel.formatoptions !== 'undefined') {
                op = $.extend({}, op, options.colModel.formatoptions);
            }
			  
            if ($.isFunction(op.target)) {
                op.target = op.target.call(this, cellValue, options.rowId, rowData, options);
            }
            if ($.isFunction(op.url)) {
				op.url = op.url.call(this, cellValue, options.rowId, rowData, options);
            }
			
            if ($.isFunction(op.cellValue)) {
                cellValue = op.cellValue.call(this, cellValue, options.rowId, rowData, options);
            }
			
			// attr = op.attr;
			// if ($.isPlainObject(attr)) {
            //    // enumerate properties of
            //    for (attrName in attr) {
            //        if (attr.hasOwnProperty(attrName)) {
			//			//alert(attr[attrName]);
            //            if ($.isFunction(attr[attrName])) {
            //                attrStr += ' ' + attrName + '="' + attr[attrName].call(this, cellValue, options.rowId, rowData, op) + '"';
            //            } else {
            //                attrStr += ' ' + attrName + '="' + attr[attrName] + '"';
            //            }
            //        }
            //    }
            //  }
			// alert(attrStr);
			if($.fmatter.isNumber(cellValue)){
				//return '<a' +
                //   (op.target ? ' target=' + op.target : '') +
                //   (op.onClick ? ' onclick="return $.fn.fmatter.dynamicLink.onClick.call(this, arguments[0]);"' : '') +
                //   ' href="' + op.url + '"' + attrStr + '>' +
                //   (cellValue || '&nbsp;') + '</a>';
				 if(cellValue >= 1){
					  return '<a' +
                    (op.target ? ' target=' + op.target : '') +
                    (op.onClick ? ' onclick="return $.fn.fmatter.dynamicLink.onClick.call(this, arguments[0]);"' : '') +
                    ' href="' + op.url + '" style="color: Red;font-weight: bold" >' +
                    (cellValue || '0') + '</a>';
				 }else{
					  return '<a' +
                    (op.target ? ' target=' + op.target : '') +
                    (op.onClick ? ' onclick="return $.fn.fmatter.dynamicLink.onClick.call(this, arguments[0]);"' : '') +
                    ' href="' + op.url + '" style="color: green;font-weight: bold" >' +
                    (cellValue || '0') + '</a>';
				 }
				
			} else {
			//	alert('kesini');
                return '&nbsp;';
            }
			
        //    if ($.fmatter.isString(cellValue) || $.fmatter.isNumber(cellValue)) {
		//		//alert('kesini');
        //        return '<a' +
        //            (op.target ? ' target=' + op.target : '') +
        //            (op.onClick ? ' onclick="return $.fn.fmatter.dynamicLink.onClick.call(this, arguments[0]);"' : '') +
        //            ' href="' + op.url + '">' +
        //            (cellValue || '&nbsp;') + '</a>';
        //    } else {
		//	//	alert('kesini');
        //        return '&nbsp;';
        //    }
	
        }
    });
    $.extend($.fn.fmatter.dynamicLink, {
	    unformat: function (cellValue, options, elem) {
            var text = $(elem).text();
		    return text === '&nbsp;' ? '' : text;
        },
        onClick: function (e) {
            var $cell = $(this).closest('td'),
                $row = $cell.closest('tr.jqgrow'),
                $grid = $row.closest('table.ui-jqgrid-btable'),
                p,
                colModel,
                iCol;
        
            if ($grid.length === 1) {
                p = $grid[0].p;
                if (p) {
                    iCol = $.jgrid.getCellIndex($cell[0]);
                    colModel = p.colModel;
                    colModel[iCol].formatoptions.onClick.call($grid[0],
                        $row.attr('id'), $row[0].rowIndex, iCol, $cell.text(), e);
                }
            }
            return false;
        }
    });
	
}(jQuery));
			
</script>
