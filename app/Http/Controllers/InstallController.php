<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use PDO, PDOException, Exception;
use Flash, DB, App, Artisan;
use App\System, App\User;

class InstallController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        // @todo
        if (file_exists(base_path() . '/.env')) {
            // abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('install.index');
    }

    /**
     *
     */
    public function getCheck()
    {
        return view('install.check');
    }

    /**
     *
     */
    public function getSetup()
    {
        return view('install.setup');
    }

    public function postSetup(Request $request)
    {
        $validator = $this->validate($request, [
            'db_host'       =>      'required',
            'db_name'       =>      'required',
            'db_user'       =>      'required',
            'db_password'   =>      '',
            'site_name'     =>      'required',
            'site_slogan'   =>      'required',
            'contact_email' =>      'required|email',
            'admin_name'    =>      'required',
            'admin_email'   =>      'required|email',
            'admin_password'=>      'required|min:6',
        ]);

        // Try mysql connect
        try {
            $dns = 'mysql:dbname=' . $request->get('db_name') . ';host=' . $request->get('db_host');
            $pdo = new PDO($dns, $request->get('db_user'), $request->get('db_password'));
        } catch (PDOException $e) {
            $messageBag = new \Illuminate\Support\MessageBag;
            $messageBag->add('db_host', ' ');
            $messageBag->add('db_name', ' ');
            $messageBag->add('db_user', ' ');
            $messageBag->add('db_password', ' ');
            $messageBag->add('db_connect', 'Mysql connect fail');

            Flash::error(trans('app.Operation failed'));
            $request->flash();
            return redirect()->back()->withErrors($messageBag);
        }

        return $this->install($request);
    }

    /**
     * Install
     */
    protected function install($request)
    {
        // Modify env
        $dir = base_path();
        $ret = copy(
            $dir . '/.env.example',
            $dir . '/.env'
        );

        if ($ret) {
            modifyEnv([
                'DB_HOST'   =>  $request->get('db_host'),
                'DB_DATABASE'   =>  $request->get('db_name'),
                'DB_USERNAME'   =>  $request->get('db_user'),
                'DB_PASSWORD'   =>  $request->get('db_password'),
            ]);
        }

        // Migration
        try {
            $exitCode = Artisan::call('migrate');
        } catch (Exception $e) {
            $messageBag = new \Illuminate\Support\MessageBag;
            $messageBag->add('db_name', ' ');
            $messageBag->add('db_connect', 'Mysql database fail');

            Flash::error(trans('app.Operation failed'));
            $request->flash();
            return redirect()->back()->withErrors($messageBag);
        }

        // Initialize data
        $this->initializeData($request);

        return redirect()->route('home');
    }

    /**
     * Initialize data
     */
    protected function initializeData($request)
    {
        // System
        $System = System::find(1);
        $System->site_name = $request->get('site_name');
        $System->site_slogan = $request->get('site_slogan');
        $System->contact_email = $request->get('contact_email');
        $System->save();

        // User
        $User = User::find(1);
        $User->name = $request->get('admin_name');
        $User->email = $request->get('admin_email');
        $User->password = bcrypt($request->get('admin_password'));
        $User->save();
    }

}
