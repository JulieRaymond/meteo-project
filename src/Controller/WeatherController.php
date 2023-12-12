<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController
{
    private $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @Route("/", name="weather_index")
     */
    public function index(Request $request): Response
    {
        $city = $request->query->get('city');

        // Vérifiez si une ville a été sélectionnée
        if ($city) {
            // Faites appel au service pour obtenir les données météo
            $data = $this->weatherService->getWeatherByCity($city);

            // Affichez les données dans votre template
            return $this->render('weather/index.html.twig', [
                'data' => $data,
            ]);
        }

        // Si aucune ville n'est sélectionnée, affichez simplement le formulaire
        return $this->render('weather/form.html.twig');
    }
}
