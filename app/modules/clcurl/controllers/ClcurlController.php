<?php
namespace App\Modules\Clcurl\Controllers;
use Confide, Redirect, View, Input, Lang, Auth, Session, Menu;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Navmenu\Models\Navmenu;
use App\Modules\Clcurl\Models\Clcurl;
use App\Modules\Clcurl\Models\Pdf;
class ClcurlController extends \BaseController
{
    // public $restful = true;
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user) {
        // parent::__construct();
        $this->user = $user;
        set_time_limit(0);
        // dd($this->user->hasrole('de'));
        
        
    }
    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex() {
        // Show the page
        $tidy = new \Daniel\Phptidy\Phptidy();
        // dd(get_object_vars($tidy));
        // dd(get_class_methods($tidy));
        dd($tidy->greeting());
        return View::make('clcurl::index', compact('user'));
    }
    public function phpinfo() {
        phpinfo();
    }
    public function getSnoopy() {
        $snoopy = new \Snoopy;
        $webUrl = 'http://www.gdqts.gov.cn/zjxx/jdcctb/zljd/';
        $div = Clcurl::getDiv($webUrl, '.align_CT');
        // dd($div);
        $snoopy->fetchlinks($div); 
        $url=array(); 
        $url=$snoopy->results; 
        // $links = $snoopy->fetchlinks($url) ->results;
        foreach ($url as $key => $value) {
            # code...
            echo "<PRE>\n";
            echo htmlentities($value); 
            echo "</PRE>\n";
        }
        // print_r($url);
    }
    public function getQuery() {
        // code...
        \phpQuery::newDocumentFile('http://www.gdqts.gov.cn/zjxx/jdcctb/zljd/');  
        // $companies = pq('.align_CT')->find('td');  
        $companies = pq('.align_CT');  
        echo $companies->text();

                    // dd($companies->text());
        // foreach($companies as $company)  
        // {  
        //                 // print_r(get_class_methods(pq($company)));
        //     dd(pq($company)->find('.cn4')->text());
        //     echo pq($company)->find('.cn4')->text()."<br>";  
        // }
    }
}
