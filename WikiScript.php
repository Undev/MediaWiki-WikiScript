<?php
# WikiScript extension

# Usage:
# <wikiscript src="http://gmodules.com/ig/ifr?
#url=http://www.therandomhomepage.com/google/gadgets/randomwiki/RandomWikiModule.xml
#&amp;up_moduletitle=&amp;up_language=en&amp;synd=open&amp;w=320&amp;h=350&amp;title=
#&amp;lang=en&amp;country=ALL&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js">
#</wikiscript>

# you can now also use the arguments language and type, and also
# include embedded scripts -- 2009-05-21-ptandler http://www.teambits.de
# <wikiscript language="..." type="...">
#...some script code ...
#</wikiscript>

# To install it put this file in the extensions directory 
# To activate the extension, include it from your LocalSettings.php
# with: require("extensions/wikiscript.php");

$wgExtensionFunctions[] = "wfWikiScript";

function wfWikiScript() {
    global $wgParser;
    # registers the <wikiscript> extension with the WikiText parser
    $wgParser->setHook( "wikiscript", "renderWikiScript" );
}

# The callback function for converting the input text to HTML output
function renderWikiScript( $input, $argv ) {
    $output = '<script ';
    if( $argv["src"] ) { $output .= 'src="'.$argv["src"].'" '; }
    if( $argv["language"] )
    {
        $output .= 'language="'.$argv["language"].'" ';
    }
    else
    {
        $output .= 'language="javascript" ';
    }
    $type=$argv["type"];
    if( !$type ) { $type = "text/javascript"; }
    $output .= 'type="'.$type.'" ';
    $output .= '>';
    $output .= $input;
    $output .= '</script>';
    return $output;
}
?>