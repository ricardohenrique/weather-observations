<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ObservationsService;

class ObservationsControlller extends Controller
{
	public $service;

	/**
     * Constructor class
     * @access public
     * @param ObservationsService $service
     * @return void
     */
    public function __construct(ObservationsService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $this->service->validateData($request->all());
        if($data === false) {
            return response()->json(['error' => 'Data sent is not valid'], 422);
        }
    	$data = $this->service->store($data);
    	return response()->json($data);
    }
}
