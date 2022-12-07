<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'user_image',
        'number',
        'company',
        'title',
        'group'
    ];


    // Relation with group table
    public function group() {
        return $this->belongsTo(ContactGroup::class, 'group', 'id');
    }

}
