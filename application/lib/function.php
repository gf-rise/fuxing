<?php
/**
 * Created by PhpStorm.
 * User: gfrie
 * Date: 2018/12/14
 * Time: 3:30
 * @param $date
 * @return false|string
 */
/**
 * @param $date
 * @return false|string
 */
function format_date($date)
{
    return date('Y-m-d H:i:s',$date);
}