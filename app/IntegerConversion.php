<?php

namespace App;

use App\IntegerConversionInterface as IntegerConversionInterface;
use Illuminate\Support\Facades\DB;

class IntegerConversion implements IntegerConversionInterface
{
    public function toRomanNumerals($integer)
    {
        $my_number=$integer;
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($integer > 0) {
            foreach ($map as $roman => $int) {
                if($integer >= $int) {
                    $integer-= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        //return array("converted_number"=>$returnValue,"integer_number"=>$my_number);
        return $returnValue;
    }



}