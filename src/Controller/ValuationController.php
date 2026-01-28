<?php

namespace App\Controller;

use App\Dto\ValuationRequest;
use App\Service\ValuationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ValuationController extends AbstractController
{
	public function __construct(
		private readonly ValuationService $valuationService
	) {
	}

	#[Route('/api/v1/valuation/estimate', name: 'api_valuation_estimate', methods: ['POST'])]
	public function estimate(Request $request): JsonResponse
	{
		$data = json_decode($request->getContent(), true);

		$valuationRequest = new ValuationRequest(
			$data['brand'] ?? '',
			$data['category'] ?? '',
			$data['condition'] ?? ''
		);

		$result = $this->valuationService->estimate($valuationRequest);

		return $this->json([
			'estimated_price' => $result->getEstimatedPrice(),
		]);
	}
}
