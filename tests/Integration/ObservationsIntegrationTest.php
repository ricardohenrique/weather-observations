<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Models\ObservationModel;

class ObservationsIntegrationTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateObservation()
    {
        $observation = factory(ObservationModel::class)->make();
        $data = $observation->toArray();
        $data = implode('|', $data);
        $response = $this->post('/api/observations', [$data]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'timestamp',
            'location',
            'temperature',
            'observatory'
        ]);
    }
}
