<?php

namespace App\Controller;

use App\Service\OpenWeatherMapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    private $weatherService;

    public function __construct(OpenWeatherMapService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    #[Route('/weather', name: 'weather')]
    public function index(Request $request): Response
    {
        $city = $request->query->get('city');

        if ($city) {
            $weatherData = $this->weatherService->getWeatherForCity($city);

            return $this->render('weather/result.html.twig', ['weatherData' => $weatherData]);
        }

        return $this->render('weather/index.html.twig');
    }
}