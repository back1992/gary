<?php namespace App\Modules\Robot\Controllers;
use Confide, Redirect, View, Input, Lang, Auth, Session, Menu;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Navmenu\Models\Navmenu;
use App\Modules\Robot\Models\Request;
use App\Modules\Robot\Models\Response;
use App\Modules\Robot\Models\WebBot\WebBot;

class RobotController extends \BaseController {
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
    public function __construct(User $user)
    {
        // parent::__construct();
        $this->user = $user;
        set_time_limit(0);
        WebBot::$conf_default_timeout = 30;
        WebBot::$conf_delay_between_fetches = 1;
        WebBot::$conf_force_https = false;
        WebBot::$conf_include_document_field_raw_values = false;

        // dd($this->user->hasrole('de'));
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
     if(function_exists('curl_init'))
     {
// set cURL resource
        // $curl = curl_init('http://www.google.com.hk');
        $curl = curl_init('http://www.baidu.com');
// set return transfer as string to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// set variable with response string
        $request_response = htmlentities(curl_exec($curl));
// close cURL resource
        curl_close($curl);
// display response string
        echo '<pre>' . print_r($request_response, true) . '</pre>';
    }
    else 
// PHP cURL library not installed
    {
        echo 'Please install PHP cURL library';
    }

        // Show the page
    return View::make('robot::index', compact('user'));
}


    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex2()
    {
// execute example HTTP GET request
        $response = Request::head('http://www.google.com.hk');
// print out HTTP response (\HTTP\Response object)
        echo '<pre>' . print_r($response, true) . '</pre>';

        // Show the page
        return View::make('robot::index', compact('user'));
    }
    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex3()
    {
        $response = Request::get('http://www.google.com');
        dd($response);
// display response status
        if($response->success)
        {
            echo 'Successful request <br />';
        }
        else
        {
            echo 'Error: request failed, status code: '. $response->getStatusCode() . '<br />'; 
// prints
// status code
        }
// print out HTTP response (\HTTP\Response object)
        echo '<pre>' . print_r($response, true) . '</pre>';

        // Show the page
        return View::make('robot::index', compact('user'));
    }


    public function webBot()
    {
        // URLs to fetch data from
        $urls = [
        'search' => 'www.google.com',
        'chrome' => 'www.google.com/intl/en/chrome/browser/',
        'products' => 'www.google.com/intl/en/about/products/'
        ];
// document fields [document field ID => document field regex
// pattern, [...]]
        $document_fields = [
        'title' => '<title.*>(.*)\<\/title>',
        /*'h2' => '<h2[^>]*?>(.*)<\/h2>',*/
        'h2' => '<p[^>]*?>(.*)<\/p>',
        ];
// set WebBot object
        $webbot = new WebBot($urls, $document_fields);
// execute fetch data from URLs
        $webbot->execute();
// display documents summary
        echo $webbot->total_documents . ' total documents <br />';
        echo $webbot->total_documents_success . ' total documents fetched
        successfully <br />';
        echo $webbot->total_documents_failed . ' total documents failed to
        fetch <br /><br />';
// check if fetch(es) successful
        if($webbot->success)
        {
// display each document
            foreach($webbot->getDocuments() as  $document)
                /* \WebBot\Document */
            {
                if($document->success) 
// was document data fetched
// successfully?
                {
// display document meta data
                    echo 'Document: ' . $document->id . '<br />';
                    echo 'URL: ' . $document->url . '<br />';
// display/print document fields and values
                    $fields = $document->getFields();
                    echo '<pre>' . print_r($fields, true) . '</pre>';
                }
// failed to fetch document data, display error
                else 
                {
                    echo 'Document error: ' . $document->error . '<br />';
                }
            }
        }
// not successful, display error
        else 
        {
            echo 'Failed, error: ' . $webbot->error;
        }
        return View::make('robot::index', compact('user'));
    }

    /**
     * Stores new user
     *
     */
    public function postIndex()
    {
        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );

        $password = Input::get( 'password' );
        $passwordConfirmation = Input::get( 'password_confirmation' );

        if(!empty($password)) {
            if($password === $passwordConfirmation) {
                $this->user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $this->user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('user/create')
                ->withInput(Input::except('password','password_confirmation'))
                ->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        } else {
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }

        // Save if valid. Password field will be hashed before save
        $this->user->save();

        if ( $this->user->id )
        {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
            return Redirect::to('user/login')
            ->with( 'notice', Lang::get('user/user.user_account_created') );
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();

            return Redirect::to('user/create')
            ->withInput(Input::except('password'))
            ->with( 'error', $error );
        }
    }

    /**
     * Edits a user
     *
     */
    public function postEdit($user)
    {
        // Validate the inputs
        $validator = Validator::make(Input::all(), $user->getUpdateRules());


        if ($validator->passes())
        {
            $oldUser = clone $user;
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );

            $password = Input::get( 'password' );
            $passwordConfirmation = Input::get( 'password_confirmation' );

            if(!empty($password)) {
                if($password === $passwordConfirmation) {
                    $user->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $user->password_confirmation = $passwordConfirmation;
                } else {
                    // Redirect to the new user page
                    return Redirect::to('users')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }

            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            $user->amend();
        }

        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();

        if(empty($error)) {
            return Redirect::to('user')
            ->with( 'success', Lang::get('user/user.user_account_updated') );
        } else {
            return Redirect::to('user')
            ->withInput(Input::except('password','password_confirmation'))
            ->with( 'error', $error );
        }
    }

    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {
        return View::make('robot::site/user/create');
    }


    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        $user = Auth::user();
        if(!empty($user->id)){
            return Redirect::to('/');
        }

        return View::make('robot::site/user/login');
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'username' => Input::get( 'email' ), // May be the username too
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
            );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Check that the user is confirmed.
        if ( Confide::logAttempt( $input, true ) )
        {
            $r = Session::get('loginRedirect');
            if (!empty($r))
            {
                Session::forget('loginRedirect');
                return Redirect::to($r);
            }
            // dd($r);
            return Redirect::to('/admin');
        }
        else
        {
            // Check if there was too many login attempts
            if ( Confide::isThrottled( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ( $this->user->checkUserExists( $input ) && ! $this->user->isConfirmed( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('user/login')
            ->withInput(Input::except('password'))
            ->with( 'error', $err_msg );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            return Redirect::to('user/login')
            ->with( 'notice', Lang::get('confide::confide.alerts.confirmation') );
        }
        else
        {
            return Redirect::to('user/login')
            ->with( 'error', Lang::get('confide::confide.alerts.wrong_confirmation') );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('robot::site/user/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            return Redirect::to('user/login')
            ->with( 'notice', Lang::get('confide::confide.alerts.password_forgot') );
        }
        else
        {
            return Redirect::to('user/forgot')
            ->withInput()
            ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_forgot') );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {

        return View::make('robot::site/user/reset')
        ->with('token',$token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
            );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            return Redirect::to('user/login')
            ->with( 'notice', Lang::get('confide::confide.alerts.password_reset') );
        }
        else
        {
            return Redirect::to('user/reset/'.$input['token'])
            ->withInput()
            ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_reset') );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public function getProfile($username)
    {
        $userModel = new User;
        $user = $userModel->getUserByUsername($username);

        // Check if the user exists
        if (is_null($user))
        {
            return App::abort(404);
        }

        return View::make('robot::site/user/profile', compact('user'));
    }

    public function getSettings()
    {
        list($user,$redirect) = User::checkAuthAndRedirect('user/settings');
        if($redirect){return $redirect;}

        return View::make('robot::site/user/profile', compact('user'));
    }

    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public function processRedirect($url1,$url2,$url3)
    {
        $redirect = '';
        if( ! empty( $url1 ) )
        {
            $redirect = $url1;
            $redirect .= (empty($url2)? '' : '/' . $url2);
            $redirect .= (empty($url3)? '' : '/' . $url3);
        }
        return $redirect;
    }
}
