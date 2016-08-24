<?php
namespace Core;

class HtmlBuilder
{
    function shortenUrls($data)
    {
        $data = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', array(get_class($this), '_fetchTinyUrl'), $data);
        return $data;
    }

    function sanitize($data)
    {
        return mysql_real_escape_string($data);
    }

    function link($text, $path)
    {
        $data = '<a href="'.BASE_PATH.'/'.$path.'">'.$text.'</a>';
        return $data;
    }

    function includeJs($fileName)
    {
        $data = '<script src="'.BASE_PATH.'/js/'.$fileName.'.js"></script>';
        return $data;
    }

    function includeCss($fileName)
    {
        $data = '<style href="'.BASE_PATH.'/css/'.$fileName.'.css"></script>';
        return $data;
    }
}