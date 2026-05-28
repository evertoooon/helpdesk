<?php

namespace Tests\Unit;

use App\Models\Ticket;
use PHPUnit\Framework\TestCase;

class TicketUnitTest extends TestCase
{
    public function test_ticket_has_default_open_status_constant(): void
    {
        $this->assertEquals(
            'Aberto',
            Ticket::STATUS_ABERTO
        );
    }

    public function test_ticket_has_priority_constants(): void
    {
        $this->assertEquals(
            'Baixa',
            Ticket::PRIORITY_BAIXA
        );

        $this->assertEquals(
            'Média',
            Ticket::PRIORITY_MEDIA
        );

        $this->assertEquals(
            'Alta',
            Ticket::PRIORITY_ALTA
        );

        $this->assertEquals(
            'Urgente',
            Ticket::PRIORITY_URGENTE
        );
    }

    public function test_ticket_model_allows_status_assignment(): void
    {
        $ticket = new Ticket();

        $ticket->status = Ticket::STATUS_ABERTO;

        $this->assertSame(
            Ticket::STATUS_ABERTO,
            $ticket->status
        );
    }

    public function test_ticket_model_allows_priority_assignment(): void
    {
        $ticket = new Ticket();

        $ticket->priority = Ticket::PRIORITY_ALTA;

        $this->assertSame(
            Ticket::PRIORITY_ALTA,
            $ticket->priority
        );
    }
}