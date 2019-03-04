<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $table = 'files';

    protected $fillable = [
        'object_imei',
        'file_name'
    ];

    public function vessel()
    {
        return $this->belongsTo(User::class, 'object_imei', 'imei');
    }
}
