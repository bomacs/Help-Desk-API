<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'type_id',
        'ticket_details',
        'priority',
        'status',
        'acknowledged_by',
        'acknowledged_at',
        'created_by',
        'updated_by',
        'resolved_by',
        'resolved_at',
        'assigned_to',
        'assigned_by',
        'deleted_by',
        'deleted_at',
    ];

    protected $casts = [
        'ticket_details' => 'array',
    ];

    /**
     * The relationship that should always be loaded
     */
    protected $with = ['user', 'department', 'ticket_type', 'agent'];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function ticket_type()
    {
        return $this->belongsTo(Ticket_type::class, 'type_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, );
    }

    public function ticket_detail()
    {
        return $this->hasOne(Ticket_detail::class);
    }
}
