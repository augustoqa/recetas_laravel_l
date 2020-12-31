<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public function usuario()
    {
        $this->belongsTo(User::class);
    }
}
