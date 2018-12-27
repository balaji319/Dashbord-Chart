<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    public static function login($input) {
        try {
            $information = "SELECT * FROM IVRSystem.dbo.Users as U INNER JOIN IVRSystem.dbo.Companies as cam  ON U.CompanyID=cam.CompanyID WHERE U.CompanyID='" . $input['CompanyId'] . "' AND Cam.Password='" . $input['Password'] . "' AND U.UserToken='" . $input['PersonalCode'] . "'";

            return DB::select($information);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
