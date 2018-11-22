<?php
/**
 * Created by PhpStorm.
 * User: ha
 * Date: 4/10/18
 * Time: 1:44 PM
 */

namespace mvc\app\lib;


trait InputFilter
{
    public static function filterInt($input)
    {
        return filter_var($input,FILTER_SANITIZE_NUMBER_INT);
    }

    public static function filterFloat($input)
    {
        return filter_var($input,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function filterStr($input)
    {
        return htmlentities(strip_tags($input),ENT_QUOTES,'UTF-8');
    }
}