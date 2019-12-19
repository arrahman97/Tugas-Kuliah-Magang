/**
 *  Version 2.2.2 Copyright (C) 2013
 *  Tested in IE 10, FF 21.0 and Chrome 27.0.1453.110
 *  No official support for other browsers, but will TRY to accomodate challenges in other browsers.
 *  Example:
 *      Print Button: <div id="print_button">Print</div>
 *      Print Area  : <div class="PrintArea"> ... html ... </div>
 *      Javascript  : <script>
 *                       jQuery("div#print_button").click(function(){
 *                           jQuery("div.PrintArea").printArea( [OPTIONS] );
 *                       });
 *                     </script>
 *  options are passed as json (json example: {mode: "popup", popClose: false})
 *
 *  {OPTIONS} | [type]    | (default), values      | Explanation
 *  --------- | --------- | ---------------------- | -----------
 *  @mode     | [string]  | ("iframe"),"popup"     | printable window is either iframe or browser popup
 *  @popHt    | [number]  | (500)                  | popup window height
 *  @popWd    | [number]  | (400)                  | popup window width
 *  @popX     | [number]  | (500)                  | popup window screen X position
 *  @popY     | [number]  | (500)                  | popup window screen Y position
 *  @popTitle | [string]  | ('')                   | popup window title element
 *  @popClose | [boolean] | (false),true           | popup window close after printing
 *  @strict   | [boolean] | (undefined),true,false | strict or loose(Transitional) html 4.01 document standard or undefined to not include at all (only for popup option)
 *  @extraCss | [string]  | ("")                   | comma separated list of extra css to include
 */
(function(jQuery) {
    var counter = 0;
    var modes = { iframe : "iframe", popup : "popup" };
    var defaults = { mode     : modes.iframe,
                     popHt    : 500,
                     popWd    : 400,
                     popX     : 200,
                     popY     : 200,
                     popTitle : '',
                     popClose : false,
                     extraCss : '' };

    var settings = {};//global settings

    jQuery.fn.printArea = function( options )
        {
            jQuery.extend( settings, defaults, options );

            counter++;
            var idPrefix = "printArea_";
            jQuery( "[id^=" + idPrefix + "]" ).remove();
            var ele = getFormData( jQuery(this) );

            settings.id = idPrefix + counter;

            var writeDoc;
            var printWindow;

            switch ( settings.mode )
            {
                case modes.iframe :
                    var f = new Iframe();
                    writeDoc = f.doc;
                    printWindow = f.contentWindow || f;
                    break;
                case modes.popup :
                    printWindow = new Popup();
                    writeDoc = printWindow.doc;
            }

            writeDoc.open();
            writeDoc.write( docType() + "<html>" + getHead() + getBody(ele) + "</html>" );
            writeDoc.close();

            printWindow.focus();
            printWindow.print();

            if ( settings.mode == modes.popup && settings.popClose )
                printWindow.close();
        }

    function docType()
    {
        if ( settings.mode == modes.iframe || !settings.strict ) return "";

        var standard = settings.strict == false ? " Trasitional" : "";
        var dtd = settings.strict == false ? "loose" : "strict";

        return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01' + standard + '//EN" "http://www.w3.org/TR/html4/' + dtd +  '.dtd">';
    }

    function getHead()
    {
        var head = "<head><title>" + settings.popTitle + "</title>";
        jQuery(document).find("link")
            .filter(function(){ return jQuery(this).attr("rel").toLowerCase() == "stylesheet"; })
            .filter(function(){
                    var media = jQuery(this).attr("media");
                    return (media == undefined || media.toLowerCase() == "" || media.toLowerCase() == "print" || media.toLowerCase() == "all")
                })
            .each(function(){
                    head += '<link type="text/css" rel="stylesheet" href="' + jQuery(this).attr("href") + '" >';
                });

        if ( settings.extraCss ) settings.extraCss.replace( /([^,\s]+)/g, function(m){ head += '<link type="text/css" rel="stylesheet" href="' + m + '">' });

        return head += "</head>";
    }

    function getBody( printElement )
    {
        return '<body><div class="' + jQuery(printElement).attr("class") + '">' + jQuery(printElement).html() + '</div></body>';
    }

    function getFormData( ele )
    {
        var copy = ele.clone();
        var copiedInputs = jQuery("input,select,textarea", copy);
        jQuery("input,select,textarea", ele).each(function( i ){
            var type = jQuery(this).attr("type");
            if (type == undefined) type = jQuery(this).is("select") ? "select" : jQuery(this).is("textarea") ? "textarea" : "";
            var copiedInput = copiedInputs.eq( i );

            if ( type == "radio" || type == "checkbox" ) copiedInput.attr( "checked", jQuery(this).is(":checked") );
            else if ( type == "text" ) copiedInput.attr( "value", jQuery(this).val() );
            else if ( type == "select" )
                jQuery(this).find( "option" ).each( function( i ) {
                    if ( jQuery(this).is(":selected") ) jQuery("option", copiedInput).eq( i ).attr( "selected", true );
                });
            else if ( type == "textarea" ) copiedInput.text( jQuery(this).val() );
        });
        return copy;
    }

    function Iframe()
    {
        var frameId = settings.id;
        var iframeStyle = 'border:0;position:absolute;width:0px;height:0px;left:0px;top:0px;';
        var iframe;

        try
        {
            iframe = document.createElement('iframe');
            document.body.appendChild(iframe);
            jQuery(iframe).attr({ style: iframeStyle, id: frameId, src: "" });
            iframe.doc = null;
            iframe.doc = iframe.contentDocument ? iframe.contentDocument : ( iframe.contentWindow ? iframe.contentWindow.document : iframe.document);
        }
        catch( e ) { throw e + ". iframes may not be supported in this browser."; }

        if ( iframe.doc == null ) throw "Cannot find document.";

        return iframe;
    }

    function Popup()
    {
        var windowAttr = "location=yes,statusbar=no,directories=no,menubar=no,titlebar=no,toolbar=no,dependent=no";
        windowAttr += ",width=" + settings.popWd + ",height=" + settings.popHt;
        windowAttr += ",resizable=yes,screenX=" + settings.popX + ",screenY=" + settings.popY + ",personalbar=no,scrollbars=no";

        var newWin = window.open( "", "_blank",  windowAttr );

        newWin.doc = newWin.document;

        return newWin;
    }
})(jQuery);