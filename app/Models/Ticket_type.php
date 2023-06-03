<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\Department;

class Ticket_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'sla_mins'
    ];

    public $timestamps = false;


    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
