<?php

namespace App\Doctrine;

use App\Constants\FlightConstants;
use App\Entity\Flight;

class FlightSetIsFlightListener
{
    public function postUpdate(Flight $flight)
    {
        if ($flight->getStatus() === FlightConstants::CANCEL) {   // рейс отменён. TODO:: NEED TO SENDING EMAIL!
            $emails = [];

            foreach ($flight->getTickets() as $ticket) {
                array_push($emails, $ticket->getPassengerEmail());
            }
//        $message = (new \Swift_Message('Рейс отменён'))
//            ->setFrom('system@example.com')
//            ->setTo('contact@les-tilleuls.coop')
//            ->setBody(sprintf('Рейс #%d отменён.', $flight->getId()));
//
//        $this->mailer->send($message);
            print_r($emails);
        }
    }
}