<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'domain', 'database'];
    public function setDomainAttribute($value)
    {
        $this->attributes['domain'] = strtolower($value);
    }
    protected static function booted(){
        static::creating(function($tenant){
            $tenant->domain = 'multi-tenancy'.self::current().'.local';
            $untilDot = strpos($tenant->domain, '.');
            $tenant->database = 'tenant_'.self::current().'_'.substr($tenant->domain,0,$untilDot);
        });
    }
    public static function current()
    {
        $id = Tenant::max('id');
        if ($id == null){
            return 1;
        }
        return $id + 1 ;
    }
}
