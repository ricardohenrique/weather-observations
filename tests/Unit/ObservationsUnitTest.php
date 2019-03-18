<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Models\ObservationModel;
use App\Services\ObservationsService;

class ObservationsUnitTest extends TestCase
{
    /**
     * @var mockModel
     */
    private $mockModel;

    /**
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

    /**
     * @return void
     */
    public function testValidateData()
    {
        $defaultModel = factory(ObservationModel::class)->make();
        $this->mockModel = Mockery::mock(ObservationModel::class);
        $service = new ObservationsService($this->mockModel);

        $returnService = $service->validateData([implode('|', $defaultModel->toArray())]);

        $this->assertEquals($defaultModel->toArray(), $returnService);
        $this->assertTrue(is_array($returnService));
    }

    /**
     * @return void
     */
    public function testParseData()
    {
        $defaultModel = factory(ObservationModel::class)->make();
        $this->mockModel = Mockery::mock(ObservationModel::class);
        $service = new ObservationsService($this->mockModel);

        $returnService = $service->parseData(implode('|', $defaultModel->toArray()));

        $this->assertEquals($defaultModel->toArray(), $returnService);
        $this->assertTrue(is_array($returnService));
    }
}
