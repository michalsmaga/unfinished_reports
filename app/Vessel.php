<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Vessel extends Model
{

    protected $table = 'gs_objects';

    public static function getVesselByImei($imei) {

        return DB::connection('mysql_source')
            ->table('gs_objects')
            ->select('imei', 'name', 'device')
            ->where('imei', '=', $imei)
            ->first();
    }

    public static function getVesselsList()
    {

        return DB::connection('mysql_source')
            ->table('gs_objects')
            ->select('imei', 'name')
            ->where('active', '=', 'true')
            ->where('object_expire', '=', 'false')
            ->get()
            ->toArray();
    }

    public static function getFile($imei)
    {

        return DB::table('files')
            ->where('object_imei', '=', $imei)
            ->whereNull('deleted_at')
            ->first();
    }

    public static function getTrack($imei, $from, $to) {

        $tableName = 'gs_object_data_' . $imei;
        $vesselTarck = DB::connection('mysql_source')->table($tableName)
            ->whereBetween('dt_tracker', [$from, $to])
            ->orderBy('dt_tracker')
            ->get()
            ->toArray();

        return new VesselTrack($vesselTarck);
    }
}
