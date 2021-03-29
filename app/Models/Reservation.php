<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ["name", "phone", "notes", "total_amount",  "payment_transaction_id", "guests_count", "payment_status", "interval_id"];
    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, fn ($q, $search) => $q->where("name", 'like', "%$search%")->orWhere("phone", 'like', "%$search%"));
    }
}