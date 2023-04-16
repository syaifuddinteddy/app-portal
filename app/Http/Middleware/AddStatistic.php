<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AddStatistic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->addDataStatistik($request, Route::currentRouteName());
        return $next($request);
    }

    public function addDataStatistik($req, $nama_endpoint){
        DB::table('t_jumlah_lihat')
            ->insert([
                'ip' => $req->ip(),
                'jenis'=> $nama_endpoint,
                'id_jenis' => 99999,
                'tgl_lihat' => date('Y-m-d H:i:s')
            ]);
    }

    public static function getDailyStatistik(){
        return DB::table('t_jumlah_lihat')
            ->select('ip')
            ->whereDate('tgl_lihat','=',date('Y-m-d'))
            ->get()
            ->count('ip');
    }

    public static function getMonthlyStatistik(){
        return DB::table('t_jumlah_lihat')
            ->select('ip')
            ->whereMonth('tgl_lihat','=',date('m'))
            ->get()
            ->count('ip');
    }

    public static function getYearlyStatistik(){
        return DB::table('t_jumlah_lihat')
            ->select('ip')
            ->whereYear('tgl_lihat','=',date('Y'))
            ->get()
            ->count('ip');
    }
}
