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
    /**
     * [readPdf description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function readPdf($file = null) {
        $file = public_path('example1.pdf'); // <- Replace with the path to your .pdf file
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $object = new \TChester_Pdf2Text($file);
        }
        return View::make('clcurl::index', compact('object'));
    }
    public function readText($file = null) {
        $file = public_path('example3.txt'); // <- Replace with the path to your .pdf file
        if (file_exists($file)) {
            $content = file_get_contents($file);
            dd($content);
        }
        return View::make('clcurl::index', compact('object'));
    }

    public function pdf2text($file = null) {
        // Show the page
        // $file = 'contract01.pdf'; // <- Replace with the path to your .pdf file
        // $file = public_path('contract01.pdf'); // <- Replace with the path to your .pdf file
        $file = public_path('Joomla3DevelopmentCookbook.pdf'); // <- Replace with the path to your .pdf file
        // check if the file exists
        // $text = Clcurl::pdf2text($file);
        $output = shell_exec('pdftotext ./public/Joomla3DevelopmentCookbook.pdf  ./public/example3.txt');
        dd($output);
        echo "<pre>$output</pre>";
        return View::make('clcurl::index', compact('user'));
    }
    public function pdf2html($file = null) {
        // Show the page
        // $file = 'contract01.pdf'; // <- Replace with the path to your .pdf file
        // $file = public_path('contract01.pdf'); // <- Replace with the path to your .pdf file
        $file = public_path('example1.pdf'); // <- Replace with the path to your .pdf file
        // check if the file exists
        // $text = Clcurl::pdf2text($file);
        //        $output = \Mgufrone\Pdf2Htm\PdfToHtm($file);
        // echo "<pre>$output</pre>";
        //         return View::make('clcurl::index', compact('user'));
        
        $pdf = new \Gufy\Pdf2Html\PdfToHtml();
        // $pdf = new \PdfToHtml();
        // opening file
        $pdf->open($file);
        // set different output directory for generated html files
        $pdf->setOutputDirectory('example1.html');
        // do this if you want to convert in the same directory as file.pdf
        $pdf->generate();
    }
    public function phpinfo() {
        phpinfo();
    }
    public function getSnoopy() {
        $snoopy = new \Snoopy;
        // $snoopy->fetchtext("http://www.php.net/");
        // print $snoopy->results;
        
        // $snoopy->fetchlinks("http://www.phpbuilder.com/");
        // print_r($snoopy->results);
        
        /*        $submit_url = "http://www.google.com";
              
                    $submit_vars["q"] = "amiga";
                    $submit_vars["submit"] = "Search!";
                    $submit_vars["searchhost"] = "Altavista";
                    
                    $snoopy->submit($submit_url,$submit_vars);
                    print_r($snoopy->results);*/
        
        $snoopy->fetchform("http://www.baidu.com");
        print_r($snoopy->results);
    }
    
    public function getQuery() {
        // code...
        \phpQuery::browserGet('http://www.google.com/', 'success1');
    }
    function success1($browser) {
        $browser->WebBrowser('success2')->find('input[name=q]')->val('search phrase')->parents('form')->submit();
    }
    function success2($browser) {
        print $browser;
    }


}
