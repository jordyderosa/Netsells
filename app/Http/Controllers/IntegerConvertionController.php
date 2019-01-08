<?php

namespace App\Http\Controllers;

use App\Http\Resources\IntegerConvertionResource;
use App\IntegerConversion;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntegerConvertionController extends Controller
{

    public function index()
    {
       $query="SELECT max(created_at) as created_at,integer_number FROM logs GROUP by integer_number ORDER by created_at DESC";
       $logs=DB::select(DB::raw($query));
        return new IntegerConvertionResource($logs);
    }
    public function topConvertedNumber()
    {
        $query="SELECT COUNT(id) AS quantity,integer_number from logs GROUP BY integer_number ORDER BY quantity DESC LIMIT 10";
        $logs=DB::select(DB::raw($query));
        return new IntegerConvertionResource($logs);
    }

    public function saveLog($integer)
    {
        $log = Logs::create(["integer_number"=>$integer]);
    }

    public function show($integer)
    {
        if(is_numeric($integer))
        {
        $converter = new IntegerConversion();
        $converted_number=$converter->toRomanNumerals($integer);
        $this->saveLog($integer);
        return new IntegerConvertionResource(array("integer_number"=>$integer,"converted_number"=>$converted_number));
        }
    }


}
