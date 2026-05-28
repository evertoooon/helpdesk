<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    public const STATUS_ABERTO = 'Aberto';
    public const STATUS_EM_ANDAMENTO = 'Em andamento';
    public const STATUS_RESOLVIDO = 'Resolvido';
    public const STATUS_CANCELADO = 'Cancelado';

    public const PRIORITY_BAIXA = 'Baixa';
    public const PRIORITY_MEDIA = 'Média';
    public const PRIORITY_ALTA = 'Alta';
    public const PRIORITY_URGENTE = 'Urgente';

    protected $fillable = [
        'user_id',
        'assigned_to',
        'category_id',
        'title',
        'description',
        'priority',
        'status',
        'attachment',
    ];

    public function isClosed(): bool
    {
        return in_array($this->status, [
            self::STATUS_RESOLVIDO,
            self::STATUS_CANCELADO,
        ], true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(TicketHistory::class);
    }
}