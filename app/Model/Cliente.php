<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    public static function getClientes(){
        return DB::table('vKxKCListagemClientes')
                ->get();
                //->paginate(30);
    }
}
