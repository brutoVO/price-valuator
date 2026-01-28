<?php

namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValuationControllerTest extends WebTestCase
{
    public function testItEstimatesValueIdeally(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/v1/valuation/estimate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
			json_encode([
				'brand' => 'Zara',
				'condition' => 'new',
                'is_high_season' => false
			], JSON_THROW_ON_ERROR)
        );

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);

        // Base 10.0 * 1.10 (Zara) * 1.5 (New) = 16.5
        $this->assertEquals(16.5, $data['estimated_price']);
    }

    public function testItReturnsBadRequestForInvalidInput(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/v1/valuation/estimate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'brand' => '', // Invalid
                'category' => 'T-Shirt',
                'condition' => 'broken' // Invalid
            ], JSON_THROW_ON_ERROR)
        );

        $this->assertResponseStatusCodeSame(400);
        $this->assertJson($client->getResponse()->getContent());
        
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('errors', $data);
    }
}