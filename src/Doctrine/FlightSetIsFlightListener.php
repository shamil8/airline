<?php

namespace App\Doctrine;

use App\Constants\FlightConstants;
use App\Entity\Flight;
use Doctrine\ORM\EntityManager;
use Swift_Message;
use Swift_Mailer;

class FlightSetIsFlightListener
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postUpdate(Flight $flight)
    {
        if ($flight->getStatus() === FlightConstants::CANCEL) {   // рейс отменён. TODO:: NEED TO SENDING EMAIL!
            $emails = [];

            foreach ($flight->getTickets() as $ticket) {
                array_push($emails, $ticket->getPassengerEmail());
            }
            $message = (new Swift_Message('Рейс отменён'))
                ->setFrom('system@example.com')
                ->setTo($emails)
                ->setBody(sprintf('Рейс #%d отменён.', $flight->getId()));

            $this->mailer->send($message);
        }
    }
}