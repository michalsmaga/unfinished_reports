<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ballen\Distical\Calculator;
use Ballen\Distical\Entities\LatLong;
use Ballen\Distical\Exceptions;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;

class VesselTrack extends Model
{
    protected $trackCollection = null;

    protected $totalDistance = 0;

    protected $totalTime = null;

    public function __construct(array $vesselTarck) {

        $this->trackCollection = $vesselTarck;
    }

    public function getFirstPoint() {

        return $this->trackCollection[0];
    }

    public function getLastPoint() {

        return end($this->trackCollection);
    }

    public function getTrackCollection() {

        return $this->trackCollection;
    }

    public function preparePoints() {

        $previousPoint = null;
        foreach ($this->trackCollection as $key => &$point) {

            $this->calculateLatLon($point);

            if ($key !== 0) {

                $this->calculateDistance($previousPoint, $point);

                $this->totalDistance += $point->distance;
            } else {

                $point->distance = '-';
            }

            $previousPoint = $point;
        }
    }

    protected function calculateLatLon(&$point) {

        $point->lat_ddm = $this->decToDDM($point->lat, 'lat');
        $point->lng_ddm = $this->decToDDM($point->lng, 'lng');
    }

    public function decToDDM($dec, $kind) {

        $splited = explode(".", $dec);
        $deg = $splited[0];
        $tempma = ('0.' . $splited[1]) * 3600;

        $min = floor($tempma / 60);
        $min = (float) $min + (float) round((($tempma - ($min * 60)) / 60), 3);

        $abrev = '';
        switch ($kind) {

            case 'lat':

                if ($deg > 0) {

                    $abrev = 'N';
                } else if ($deg < 0) {

                    $abrev = 'S';
                }
                break;
            case 'lng':

                if ($deg > 0) {

                    $abrev = 'E';
                } else if ($deg < 0) {

                    $abrev = 'W';
                }
                break;
        }

        return array('deg' => $deg, 'min' => $min, 'abbreviation' => $abrev);
    }

    protected function calculateDistance($previousPoint, &$point) {

        $previousPointCoords = new LatLong($previousPoint->lat, $previousPoint->lng);
        $pointCoords = new LatLong($point->lat, $point->lng);

        $point_to_point = new Calculator($previousPointCoords, $pointCoords);

        try {

            $point->distance = round($point_to_point->get()->asNauticalMiles(), 2);
        } catch (\InvalidArgumentException $e) {

            $point->distance = 0;
        }
//        $multi_point_distance = new Calculator;
//        $distance = $multi_point_distance->between($central_colchester, $central_ipswich)->addPoint($central_aylesbury)->get();
    }

    public function getTotalTime() {

        if (!is_null($this->totalTime)) {

            return $this->totalTime;
        }

        $firstPoint = $this->getFirstPoint();
        $firstPointDT = new Carbon($firstPoint->dt_tracker);
        $lastPoint = $this->getLastPoint();
        $lastPointDT = new Carbon($lastPoint->dt_tracker);
        $this->totalTime = $lastPointDT->diff($firstPointDT);

        return $this->totalTime;
    }

    public function getTotalStopsTime() {

        if (empty($this->trackCollection)) {

            return [
                'stops_over_10_minutes' => 0,
                'stops_total_time' => 0
            ];
        }

        $startPoint = null;
        $startKey = null;
        $previousPoint = null;
        $previousKey = null;
        $stopCounter = 0;
        $totalStopTime = 0;
        foreach ($this->trackCollection as $key => $point) {

            if ($point->speed > 0) {

                continue;
            }

            if (is_null($startPoint)) {

                $startPoint = $point;
                $startKey = $key;

                continue;
            }

            if ($key - $startKey === 1) {

                $previousPoint = $point;
                $previousKey = $key;
            }

            if ($key - $startKey > 1) {

                $startPointDT = new Carbon($startPoint->dt_tracker);
                $previousPointDT = new Carbon($previousPoint->dt_tracker);
                $diff = $previousPointDT->diffInMinutes($startPointDT);

                if ($diff > 10) {

                    $stopCounter ++;
                    $totalStopTime += $diff;
                }

                $startPoint = null;
                $startKey = null;
                $previousPoint = null;
                $previousKey = null;
            }
        }

        if (!is_null($startKey)) {

            $startPointDT = new Carbon($startPoint->dt_tracker);
            $previousPointDT = new Carbon($previousPoint->dt_tracker);
            $diff = $previousPointDT->diffInMinutes($startPointDT);

            if ($diff > 10) {

                $stopCounter ++;
                $totalStopTime += $diff;
            }

            $startPoint = null;
            $startKey = null;
            $previousPoint = null;
            $previousKey = null;
        }

        return [
            'stops_over_10_minutes' => $stopCounter,
            'stops_total_time' => $totalStopTime
        ];
    }

    public function getTotalDistance() {

        return $this->totalDistance;
    }
}
