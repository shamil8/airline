<?php

namespace App\Controller;

use App\Constants\FlightConstants;
use App\Entity\Flight;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController  extends AbstractController
{
    /**
     * @Route("/api/callback/events", methods={"POST"})
     * @param Request $req
     * @return JsonResponse
     */
    public function dataUser(Request $req) : JsonResponse   // TODO:: add validation!
    {
        $data = $req->getContent();
        $data = json_decode($data, true)["data"];

        if ($data['flight_id']) {   // todo:: move in service!
            $em = $this->getDoctrine()->getManager();
            $flight = $this->getDoctrine()->getRepository(Flight::class)->find($data['flight_id']);

            switch ($data['event']) {
                case 'flight_ticket_sales_completed':   // Завершена продажа билетов на рейс
                    $flight->setIsFlightTicketSales(false);
                    break;
                case 'flight_status_active':
                    $flight->setStatus(FlightConstants::ACTIVE);    // Активный рейс
                    break;
                case 'flight_status_waiting':
                    $flight->setStatus(FlightConstants::WAITING);    // Рейс задерживается
                    break;
                case 'flight_status_cancel':
                    $flight->setStatus(FlightConstants::CANCEL);    // Рейс отменен
                    break;
                case 'flight_status_in_fight':
                    $flight->setStatus(FlightConstants::IN_FIGHT);    // Рейс в полете
                    break;
            }

            $em->persist($flight);
            $em->flush();

            dd($flight);
        }

        return $this->json(['status' => 'Success!!']);
    }
}