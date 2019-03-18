<?php

namespace Tests\Integration;
use Tests\TestCase;

class StatisticsIntegrationTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetStatisticsTemperatureMax()
    {
        $response = $this->get('/api/statistics/temperature/max');

        $response->assertStatus(200);
        $response->assertJsonStructure(['max']);
    }

    /**
     * @return void
     */
    public function testGetStatisticsTemperatureMin()
    {
        $response = $this->get('/api/statistics/temperature/min');

        $response->assertStatus(200);
        $response->assertJsonStructure(['min']);
    }

    /**
     * @return void
     */
    public function testGetStatisticsTemperatureMean()
    {
        $response = $this->get('/api/statistics/temperature/mean');

        $response->assertStatus(200);
        $response->assertJsonStructure(['mean']);
    }

    /**
     * @return void
     */
    public function testGetStatisticsObservations()
    {
        $response = $this->get('/api/statistics/observations');

        $response->assertStatus(200);
        $response->assertJsonStructure([['observatory', 'total']]);
    }

    /**
     * @return void
     */
//    public function testGetStatisticsDistance()
//    {
//        $response = $this->get('/api/statistics/distance');
//
//        $response->assertStatus(200);
//        $response->assertJsonStructure(['distance']);
//    }
}
