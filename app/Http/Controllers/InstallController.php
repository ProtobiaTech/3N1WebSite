<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use PDO, PDOException, Exception;
use Flash, DB, App, Artisan;

class InstallController extends Controller
{
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
            'contact_email' =>      'required',
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
     *
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

        return redirect()->route('home');
    }

}
