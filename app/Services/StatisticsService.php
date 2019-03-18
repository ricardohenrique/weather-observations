<?php

namespace App\Services;

use App\Models\ObservationModel;
use Cache;

class StatisticsService
{
    public $observationModel;

    /**
     * Constructor class
     *
     * @access public
     * @param ObservationModel $observationModel
     * @return void
     */
    public function __construct(ObservationModel $observationModel)
    {
        $this->observationModel = $observationModel;
    }

    /**
     * Get Max Temperature
     *
     * @access public
     * @return array
     * @todo calculate with different units of Temperature(celsius, fahrenheit and kelvin)
     */
    public function getMaxTemperature(): array
    {
        $data['max'] = $this->observationModel->max('temperature');
        return $data;
    }

    /**
     * Get MIN Temperature
     *
     * @access public
     * @return array
     * @todo calculate with different units of Temperature(celsius, fahrenheit and kelvin)
     */
    public function getMinTemperature(): array
    {
        $data['min'] = $this->observationModel->min('temperature');
        return $data;
    }

    /**
     * Get mean Temperature
     *
     * @access public
     * @return array
     * @todo calculate with different units of Temperature(celsius, fahrenheit and kelvin)
     */
    public function getMeanTemperature(): array
    {
        $data['mean'] = $this->observationModel->avg('temperature');
        return $data;
    }

    /**
     * Get Observations
     *
     * @access public
     * @return array
     */
    public function getObservations(): array
    {
        $data = $this->observationModel
            ->select('observatory', \DB::raw('count(*) as total'))
            ->groupBy('observatory')
            ->get();

        return $data->toArray();
    }

    /**
     * Get Observations
     *
     * @access public
     * @return array
     * @todo calculate with different units of Distance(km, miles and m)
     */
    public function getDistance(): array
    {
        $ny = [40.758895, -73.9873197];
        $la = [33.914329, -118.2849236];
//        $count = $this->observationModel->count();
//        dd($count);
//        $data = $this->observationModel->select('location')->limit(20000)->get()->toArray();

        $test = $this->getDistanceBetweenTwoCoordinates($ny, $la);
        dd($test);
//        foreach ($data as $item) {
//            dd($item);
//        }
    }

    /**
     * @param array $firstLocation
     * @param array $secondLocation
     * @param int $precision
     * @param bool $miles
     * @return float
     */
    public function getDistanceBetweenTwoCoordinates(array $firstLocation, array $secondLocation, $precision = 0, $miles = true): float
    {
        // get the earth radius
        $radius = $miles ? 3955.00465 : 6364.963; // miles or km

        //convert latitude from degrees to radius
        $firstLatitude = deg2rad($firstLocation[0]);
        $secondLatitude = deg2rad($secondLocation[0]);

        $lon = deg2rad($secondLocation[1] - $firstLocation[1]);

        return round(acos(sin($firstLatitude) * sin($secondLatitude) + cos($firstLatitude) * cos($secondLatitude) * cos($lon)) * $radius, $precision);
    }
}
