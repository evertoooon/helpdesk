<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Ticket;

class TicketUnitTest extends TestCase
{
    public function test_ticket_default_status_is_aberto(): void
    {
        $ticket = new Ticket();

        $ticket->status = 'Aberto';

        $this->assertEquals(
            'Aberto',
            $ticket->status
        );
    }

    public function test_ticket_priority_can_be_defined(): void
    {
        $ticket = new Ticket();

        $ticket->priority = 'Alta';

        $this->assertEquals(
            'Alta',
            $ticket->priority
        );
    }
}