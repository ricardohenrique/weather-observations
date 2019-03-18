<?php

namespace App\Services;

use App\Models\ObservationModel;
use Validator;
use Log;

class ObservationsService
{
    const GROUPVALIDATIONS = [
        'location'    => 'validateObservationLocation',
        'timestamp'   => 'validateObservationTimestamp',
        'temperature' => 'validateObservationTemperature',
        'observatory' => 'validateObservationObservatory'
    ];

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
     * Store a new observation
     *
     * @access public
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        return $this->observationModel->create($data)->toArray();
    }

    /**
     * Store a new observation
     *
     * @access public
     * @param array $data
     * @return array|false
     */
    public function validateData(array $data)
    {
        $newData = $this->parseData($data[0]);
        if(!$this->validateRequireObservation($newData)) {
            $message = 'Data sent is not valid: ' . $data[0];
            Log::info($message);
            return false;
        }
        return $newData;
    }

    /**
     * Parse observation data and give labels
     *
     * @param string $data
     * @return array
     */
    public function parseData(string $data): array
    {
        $data = explode("|", $data);
        $param = [];

        foreach ($data as $value) {
            $validate = $this->validate($value);
            if($validate != false) {
                $param = array_merge($param, $validate);
            }
        }

        return $param;
    }

    /**
     * Validate data
     *
     * @param string $value
     * @return array|false
     */
    public function validate(string $value)
    {
        foreach (self::GROUPVALIDATIONS as $key => $function) {
            $validate = $this->$function($value);
            if(!is_bool($validate)) {
                return [$key => $validate];
            }
        }

        Log::info("This data is not valid: " . $value);
        return false;
    }

    /**
     * Validate data a timestamp
     *
     * @param string $value
     * @return string|false
     */
    public function validateObservationTimestamp(string $value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'date',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return $value;
    }

    /**
     * Validate data a location
     *
     * @param string $value
     * @return string|false
     */
    public function validateObservationLocation(string $value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/i',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return $value;
    }

    /**
     * Validate data a temperature
     *
     * @param string $value
     * @return string|false
     */
    public function validateObservationTemperature(string $value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'integer',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return $value;
    }

    /**
     * Validate data an observatory
     *
     * @param string $value
     * @return string|false
     */
    public function validateObservationObservatory($value)
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'string|max:2|min:2'
        ]);

        if ($validator->fails()) {
            return false;
        }

        return $value;
    }

    /**
     * Validate require
     *
     * @param array $data
     * @return bool
     */
    public function validateRequireObservation(array $data): bool
    {
        $validator = Validator::make($data, [
            'timestamp'   => 'required',
            'location'    => 'required',
            'temperature' => 'required',
            'observatory' => 'required'
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
