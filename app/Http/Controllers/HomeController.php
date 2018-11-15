<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    
    
    public function home()

    {

        
        $username = session()->get('username');

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
                    WHERE radacct.username = '$username' AND
                          FramedIPAddress LIKE '%' AND CallingStationId LIKE '%'

                    GROUP BY radacct.radacctid
                    ) AS tmp
                  GROUP BY date");

        return view('home',compact('quotas'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
