<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    use HasFactory;
    protected $fillable = ["date", "type", "max_guests_count", "is_completed"];
    public function getTypeAttribute()
    {
        return [
            1 => "من ٦ الى ١٠ مساء",
            2 => "من ١٠ الى ١٢ مساء"
        ][$this->attributes['type']];
    }
    public function getIsCompletedAttribute()
    {
        return [
            0 => "غير مكتمل",
            1 => "مكتمل"
        ][$this->attributes['is_completed']];
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    protected $appends = ["guests_count"];
    public function getGuestsCountAttribute()
    {
        return $this->hasMany(Reservation::class)->sum("guests_count");
    }
    public function scopeDateFilter($query, $date)
    {
        return $query->when($date, fn ($q, $date) => $q->where("date", $date));
    }
    public function scopeType($query, $type)
    {
        return $query->when($type, fn ($q, $type) => $q->where("type", $type));
    }
    public function scopeStatus($query, $status)
    {
        return $query->when($status, fn ($q, $status) => $q->where("is_completed", $status));
    }
}