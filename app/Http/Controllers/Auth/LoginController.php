<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $username;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();

//        dd(User::first());
    }

    public  function login(Request $request)
    {

        $password = md5($request->password);
        $email = $request->email;


        $user = User::where(['email' => $email, 'password' => $password ])->first();


        if($password == $user['password'] && $email == $user['email']){

            session()->put('email', $email);
            session()->put('firstname', $user->firstname);
            session()->put('middlename', $user->middlename);
            session()->put('lastname', $user->lastname);

            $quotas = DB::select('SELECT
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
                    WHERE radacct.username = \'$user->username\' AND
                          FramedIPAddress LIKE \'%\' AND CallingStationId LIKE \'%\'

                    GROUP BY radacct.radacctid
                    ) AS tmp
                  GROUP BY date');

//                dd($quotas);

            return view('/home', compact('quotas'));

//            return view('home', compact('user'));


        } else {

            return redirect()->back();
        }


    }

    public  function home()
    {
        return view('home');
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

}
