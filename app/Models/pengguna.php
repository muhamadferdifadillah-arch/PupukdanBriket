<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Pengguna extends Model
{
use SoftDeletes, HasUuids;
protected $fillable = ['username', 'email', 'password'];


}
