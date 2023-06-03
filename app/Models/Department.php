<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\Ticket_type;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'description'
    ];

    // Disable the timestamps attribute
    public $timestamps = false;

    // Relationship with the User class
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    } 

    public function ticket_type()
    {
        return $this->hasMany(Ticket_type::class);
    }
}
