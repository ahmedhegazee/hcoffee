<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ["name", "phone", "notes", "total_amount",  "payment_transaction_id", "date", "guests_count", "interval", "is_accepted"];

    public function getIntervalAttribute()
    {
        return [
            0 => "من ٦ الى ١٠ مساء",
            1 => "من ١٠ الى ١٢ مساء"
        ][$this->attributes['interval']];
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
        return $query->when($search, fn ($q, $search) => $q->where("name", 'like', "% $search%")->orWhere("phone", 'like', "% $search%"));
    }
}