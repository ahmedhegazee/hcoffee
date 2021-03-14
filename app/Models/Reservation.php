<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ["name", "phone", "notes", "total_amount",  "payment_transaction_id", "guests_count", "is_accepted", "payment_status"];
    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }
    public function getIsAcceptedAttribute()
    {
        return [
            0 => "في الانتظار",
            1 => "تمت الموافقة",
            2 => "تم الالغاء"

        ][$this->attributes['is_accepted']];
    }
    public function scopeStatus($query, $status)
    {
        return $query->when($status, fn ($q, $status) => $q->where("is_accepted", $status));
    }
    public function scopeDateFilter($query, $start, $end)
    {
        return $query->when($start, fn ($q, $start, $end) => $q->whereBetween("date", [$start, $end]));
    }
    public function scopeSearch($query, $search)
    {
        return $query->when($search, fn ($q, $search) => $q->where("name", 'like', "%$search%")->orWhere("phone", 'like', "%$search%"));
    }
}