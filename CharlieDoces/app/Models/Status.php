<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Status extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'PEDIDO_STATUS';
    protected $primaryKey = 'STATUS_ID';
    public $timestamps = false;
    protected $fillable = [
        'STATUS_DESC',
    ];

    public function pedido() {
        return $this->hasMany(Pedido::class, 'STATUS_ID', 'STATUS_ID');
    }
}