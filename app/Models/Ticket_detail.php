<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_detail extends Model
{
    protected $fillable = [
        'ticket_id',
        'ticket_type_id',
        'attachments'
    ];

    protected $casts = [
        'attachments' => 'array'
    ];

    public $timestamps = false;

    public function ticket_type()
    {
        return $this->belongsTo(Ticket_type::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
