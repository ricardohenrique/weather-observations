<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    public $service;

    /**
     * Constructor class
     * @access public
     * @param StatisticsService $service
     * @return void
     */
    public function __construct(StatisticsService $service)
    {
        $this->service = $service;
    }

    public function getMaxTemperature()
    {
        return response()->json($this->service->getMaxTemperature());
    }

    public function getMinTemperature()
    {
        return response()->json($this->service->getMinTemperature());
    }

    public function getMeanTemperature()
    {
        return response()->json($this->service->getMeanTemperature());
    }

    public function getObservations()
    {
        return response()->json($this->service->getObservations());
    }

    public function getDistance()
    {
        return response()->json($this->service->getDistance());
    }
}
