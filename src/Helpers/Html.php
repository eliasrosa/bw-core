<?php

namespace BW\Helpers;

class Html
{

    public static $styles = [];
    public static $scripts = [];

    //
    public static function addCSS($href, array $attr = [])
    {
        self::$styles[$href] = array_merge($attr, [
            'type' => 'text/css',
            'rel' => 'stylesheet',
        ]);
    }

    //
    public static function buildStyles()
    {
        $out = "<!-- BW Styles -->\n    ";
        foreach(self::$styles as $href => $attr){
            $out .= sprintf("<link href=\"%s\"%s>\n    ",
                $href,
                self::buildAttributes($attr)
            );
        }

        return $out;
    }

    //
    public static function addJS($url, array $attr = [])
    {
        self::$scripts[$url] = array_merge($attr, []);
    }

    //
    public static function buildJavaScripts()
    {
        $out = "<!-- BW JavaScript -->\n    ";
        foreach(self::$scripts as $href => $attr){
            $out .= sprintf("<script src=\"%s\"%s></script>\n    ",
                $href,
                self::buildAttributes($attr)
            );
        }

        return $out;
    }

    //
    public static function buildAttributes(array $attributes = null)
    {
        if (empty($attributes))
            return '';

        $compiled = '';
        foreach ($attributes as $key => $val) {
            $compiled .= ' ' . $key . '="' . self::chars($val) . '"';
        }

        return $compiled;
    }

    //
    public static function chars($value, $double_encode = true)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8", $double_encode);
    }

    //
    public static function xssfilter($string)
    {
        if (is_array($string)) {
            return $string;
        }
        $string = str_replace(array("&amp;", "&lt;", "&gt;"), array("&amp;amp;", "&amp;lt;", "&amp;gt;",), $string);
        // fix &entitiy\n;

        $string = preg_replace('#(&\#*\w+)[\x00-\x20]+;#u', "$1;", $string);
        $string = preg_replace('#(&\#x*)([0-9A-F]+);*#iu', "$1$2;", $string);
        $string = html_entity_decode($string, ENT_COMPAT, "UTF-8");

        // remove any attribute starting with "on" or xmlns
        $string = preg_replace('#(<[^>]+[\x00-\x20\"\'])(on|xmlns)[^>]*>#iUu', "$1>", $string);
        // remove javascript: and vbscript: protocol
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*)[\\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu', '$1=$2nojavascript...', $string);
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=([\'\"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu', '$1=$2novbscript...', $string);
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=([\'\"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#Uu', '$1=$2nomozbinding...', $string);
        //<span style="width: expression(alert('Ping!'));"></span>
        // only works in ie...
        $string = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*expression[\x00-\x20]*\([^>]*>#iU', "$1>", $string);
        $string = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*behaviour[\x00-\x20]*\([^>]*>#iU', "$1>", $string);
        $string = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*>#iUu', "$1>", $string);
        //remove namespaced elements (we do not need them...)
        $string = preg_replace('#</*\w+:\w[^>]*>#i', "", $string);
        //remove really unwanted tags

        do {
            $oldstring = $string;
            $string = preg_replace('#</*(applet|meta|xml|blink|link|style|script|frame|form|input|select|button|textarea|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i', "", $string);
        } while ($oldstring != $string);

        return $string;
    }

}
