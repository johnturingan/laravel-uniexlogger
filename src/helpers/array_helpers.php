<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 12/09/2017
 * Time: 3:21 PM
 */

if ( ! function_exists('implode_assoc'))
{

    function implode_assoc($arr,$glue,$sep){
        $str = '';
        if (empty($glue)) {$glue='; ';}
        if (empty($sep)) {$sep=' = ';}
        if (is_array($arr))
        {
            foreach ($arr as $key=>$value)
            {
                $str .= $key.$glue.$value.$sep;
            }
            return $str;
        } else {
            return false;
        }
    }

}