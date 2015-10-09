<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name', 30)->default('3N1WebSite');
            $table->string('site_slogan')->nullable();
            $table->string('site_keywords')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_ipc')->nullable();
            $table->text('site_analytic');
            $table->string('contact_email')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        $System = new \App\System;
        $System->site_name          =   '3N1WebSite';
        $System->site_slogan        =   'Use Blog/BBS/CMS to build your website';
        $System->site_keywords      =   '3n1website, awesome, website';
        $System->site_description   =   'Use Blog/BBS/CMS to build your website';
        $System->site_analytic = "
            <script>
              (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

              ga('create', 'UA-68392745-2', 'auto');
              ga('send', 'pageview');
            </script>
            <script>
            var _hmt = _hmt || [];
            (function() {
              var hm = document.createElement('script');
              hm.src = '//hm.baidu.com/hm.js?6789357a4f28be6f0691db5576d9a479';
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(hm, s);
            })();
            </script>
        ";
        $System->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('systems');
    }
}
