<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $password = md5($request->password);
        $email = $request->email;


        $user = User::where(['email' => $email, 'password' => $password])->first();


        if ($password == $user['password'] && $email == $user['email']) {

            session()->put('email', $email);
            session()->put('firstname', $user->firstname);
            session()->put('middlename', $user->middlename);
            session()->put('lastname', $user->lastname);

            $username = session()->put('lastname', $user->username);

            $quotas = DB::select("SELECT
                        SUM(allbytesdl) - COALESCE(SUM(specbytesdl), 0) as download,
                 SUM(allbytesul) - COALESCE(SUM(specbytesul), 0) as upload,
                 SUM(alltime) - COALESCE(SUM(spectime), 0) as alltime
                  FROM (
                    SELECT LEFT(radacct.acctstarttime, 4) AS date,
                    acctoutputoctets AS allbytesdl, SUM(dlbytes) AS specbytesdl,
                    acctinputoctets AS allbytesul, SUM(ulbytes) AS specbytesul,
                    radacct.acctsessiontime AS alltime, SUM(rm_radacct.acctsessiontime) AS spectime
                    FROM radacct
                    LEFT JOIN rm_radacct ON rm_radacct.radacctid = radacct.radacctid
                    WHERE radacct.username = '$user->username' AND
                          FramedIPAddress LIKE '%' AND CallingStationId LIKE '%'

                    GROUP BY radacct.radacctid
                    ) AS tmp
                  GROUP BY date");

//                dd($quotas);

//            return redirect()->route('/home', compact('quotas'));

            return view('home', compact('user', 'quotas'));


        } else {

            return redirect()->back();
        }
    }
}
