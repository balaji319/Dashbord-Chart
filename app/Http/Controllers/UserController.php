<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Session;

class UserController extends Controller {

    public function login(Request $request) {
        try {
            if (empty(session('user_info'))) {
                return view('login');
            } else {
                return redirect('my-home');
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */
    public function myHome() {

        if (!empty(session('user_info'))) {
            return view('myHome');
        } else {
            return redirect('login');
        }
    }

    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

     */
    public function myUsers() {

        return view('myUsers');
    }

    public function loginApi(Request $request) {
        try {
            $input = $request->all();
            $validatedData = $request->validate([
                'CompanyId' => 'required|Integer',
                'Password' => 'required',
                'PersonalCode' => 'required',
            ]);
            $response = User::login($input);
            if (!empty($response)) {
                session(['user_info'=> $response[0]]);
                print_r(session('user_info'));
                return redirect('/my-home');
            } else {
                $error[] = 'Please enter valid credentials';

                return view('login',compact('error'));
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function logout(Request $request) {
        try {
            $request->session()->flush();
            return redirect('/login');
        } catch (Exception $ex) {
            throw $ex;
        }
    }
public function getgraph(Request $request) {

      try {
                // Read File

        $vaar['labels']=["January", "February", "March", "April", "May", "June", "July"];

     $jsonString = file_get_contents(base_path('resources/views/json/home_bar.json'));

    echo json_encode($vaar);

        } catch (Exception $ex) {
            throw $ex;
        }
    }



}
