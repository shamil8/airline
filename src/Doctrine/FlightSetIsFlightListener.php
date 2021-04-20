<?php

namespace App\Doctrine;

use App\Entity\Flight;

class FlightSetIsFlightListener
{
    public function postUpdate(Flight $flight)
    {
        if (!$flight->getIsFlightTicketSales()) {   // рейс отменён. TODO:: NEED TO SENDING EMAIL!
//        $message = (new \Swift_Message('Рейс отменён'))
//            ->setFrom('system@example.com')
//            ->setTo('contact@les-tilleuls.coop')
//            ->setBody(sprintf('Рейс #%d отменён.', $flight->getId()));
//
//        $this->mailer->send($message);
            print_r('Flight canceled. Sending email!');
        }
    }
}