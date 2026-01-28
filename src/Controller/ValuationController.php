<?php

namespace App\Controller;

use App\Dto\ValuationRequest;
use App\Service\ValuationService;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValuationController extends AbstractController
{
	public function __construct(
		private readonly ValuationService $valuationService,
		private readonly ValidatorInterface $validator
	) {
	}

	#[Route('/api/v1/valuation/estimate', name: 'api_valuation_estimate', methods: ['POST'])]
	public function estimate(Request $request): JsonResponse
	{
		try {
			$data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

			$valuationRequest = new ValuationRequest(
				$data['brand'] ?? '',
				$data['condition'] ?? '',
				$data['is_high_season'] ?? false
			);

			$errors = $this->validator->validate($valuationRequest);

			if (count($errors) > 0) {
				$errorMessages = [];
				foreach ($errors as $error) {
					$errorMessages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
				}

				return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
			}

			$result = $this->valuationService->estimate($valuationRequest);

			return $this->json([
				'estimated_price' => $result->getEstimatedPrice(),
			]);
		} catch (JsonException) {
			return $this->json(['error' => 'Invalid JSON payload'], Response::HTTP_BAD_REQUEST);
		}
	}

}
