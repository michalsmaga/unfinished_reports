<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 28.02.19
 * Time: 09:09
 */

namespace App\Http\Controllers;

use App\File;
use App\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function report($imei) {


        return view('report', ['vessel_imei' => $imei]);
    }

    public function generate(Request $request) {

        $imei = $request->input('vessel_imei');
        $vessel = Vessel::getVesselByImei($imei);

        if (is_null($vessel)) {

            return view('report_preview', [
                'info' => 'Can not find vessel.'
            ]);
        }

//        Create image uri

        $file = Vessel::getFile($imei);
        $fileName = is_null($file) ? 'NULL' : (url('images') . '/' . $file->file_name);

//        Prepare track information

        $vesselTrack = Vessel::getTrack($imei, $request->input('date_from'), $request->input('date_to'));
        $vesselTrack->preparePoints();
        $vesselTrackCollection = $vesselTrack->getTrackCollection();
        $totalTime = $vesselTrack->getTotalTime();
        $stops = $vesselTrack->getTotalStopsTime();
        $totalDistance = $vesselTrack->getTotalDistance();

//        Prepare data for report

        $data = [
            'vessel' => $vessel,
            'report_name' => $request->input('report_name'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'voyage_start' => $vesselTrack->getFirstPoint()->dt_tracker,
            'voyage_end' => $vesselTrack->getLastPoint()->dt_tracker,
            'total_time_underway' => $totalTime,
            'stops_total_time' => $stops['stops_total_time'],
            'stops_over_10_minutes' => $stops['stops_over_10_minutes'],
            'distance' => $totalDistance,
            'points' => $vesselTrackCollection,
            'image' => $fileName
        ];

        return view('report_preview', $data);
    }
}