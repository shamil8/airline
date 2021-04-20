<?php

namespace App\Constants;

use App\Abstracts\Constants;

/**
 * Список статусов рейса
 *
 * @package App\Constants
 */
final class FlightConstants extends Constants
{
    /** @var int Flight - Cancel, Active, Waiting and InFight */
    public const CANCEL = 0;
    public const ACTIVE = 1;
    public const WAITING = 2;
    public const IN_FIGHT = 3;
}