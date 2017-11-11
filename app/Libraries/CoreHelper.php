<?php
namespace App\Libraries;

/**
* Class CoreHelper
* @package App\Libraries
*
* set of generic functions and validations
* for general application use
*/
class CoreHelper
{
    /**
     * Group array elements by Key
     *
     * @return $array
     */
    public static function groupByKey($array, $key)
    {
        $grouped_array = array();
        foreach($array as $val) {
            $grouped_array[$val[$key]][] = $val;
        }
        return $grouped_array;
    }

    /**Filter array by key value
     *
     * @return $array
     */
    public static function filterByKeyValue($array, $key, $value)
    {
        /*
         * Tmp hack by reusing groupByKey 
         * and returning only the specified value
         */
        $grouped_data = CoreHelper::groupByKey($array, $key);
        if(isset($grouped_data[$value])) {
            return $grouped_data[$value];
        } else {
            return NULL;
        }
    }
}
