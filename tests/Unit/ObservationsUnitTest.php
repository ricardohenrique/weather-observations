<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Models\ObservationModel;
use App\Services\ObservationsService;

class ObservationsTest extends TestCase
{
    /**
     * @var mockModel
     */
    private $mockModel;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateObservation()
    {
        $defaultModel = factory(ObservationModel::class)->make();
        $this->mockModel = Mockery::mock(ObservationModel::class);
        $this->mockModel->allows([
            "create" => collect($defaultModel->toArray()),
        ]);

        $service = new ObservationsService($this->mockModel);
        $returnService = $service->store([]);

        $this->assertEquals($defaultModel->toArray(), $returnService);
        $this->assertTrue(is_array($returnService));
    }
}
