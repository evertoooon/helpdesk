<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Responsável pelo atendimento
    public function assignedUser()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'assigned_to'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            \App\Models\Category::class
        );
    }

    public function comments()
    {
        return $this->hasMany(
            \App\Models\TicketComment::class
        );
    }

    public function histories()
    {
        return $this->hasMany(
            \App\Models\TicketHistory::class
        );
    }
}