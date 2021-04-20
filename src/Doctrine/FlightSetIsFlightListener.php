<?php

namespace App\Doctrine;

use App\Entity\Flight;

class FlightSetIsFlightListener
{
    public function postUpdate(Flight $flight)
    {
        if (!$flight->getIsFlightTicketSales()) {   // рейс отменён. TODO:: NEED TO SENDING EMAIL!
            print_r('Flight canceled. Sending email!');
        }
    }
}