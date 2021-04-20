<?php


namespace App\DataFixtures;


use App\Entity\Booking;
use App\Entity\Flight;
use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager) : void
    {

        $Flight = new Flight();
        $Flight
            ->setCode('43234234234234223')
            ->setStandardPrice(15000.34)
            ->setTicketsCount(220)
        ;

        $manager->persist($Flight);

        $Booking = new Booking();
        $Booking
            ->setTotalAmount(20000.55)
            ->setDate(DateTimeImmutable::createFromFormat('Y-m-d|', date('Y-m-d')))
            ->setStatus(true)
        ;

        $manager->persist($Booking);

        $Ticket = new Ticket();
        $Ticket
            ->setBookingId($Booking)
            ->setFlightId($Flight)
            ->setPassengerEmail('qurbonovshamil@gmail.com')
            ->setPassengerName('Shamil Qurbonov')
            ->setPhone('+79234045944')
            ->setSeat(12)
        ;

        $manager->persist($Ticket);

        $manager->flush();
    }

    public static function getGroups() : array
    {
        return ['dev'];
    }
}