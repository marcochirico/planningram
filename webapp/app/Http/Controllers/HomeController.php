<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PayPal;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $_apiContext;

    public function __construct()
    {
        //$this->middleware('auth');

        $this->_apiContext = PayPal::ApiContext(
           config('services.paypal.client_id'),
           config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
           'mode' => 'sandbox',
           'service.EndPoint' => 'https://api.sandbox.paypal.com', //'https://api.sandbox.paypal.com',
           'http.ConnectionTimeOut' => 30,
           'log.LogEnabled' => true,
           'log.FileName' => storage_path('logs/paypal.log'),
           'log.LogLevel' => 'FINE'
        ));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function paymentTest() {

        $payer = PayPal::Payer();
	    $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
    	$amount->setCurrency('EUR');
    	$amount->setTotal(42); // This is the simple way,
    	// you can alternatively describe everything in the order separately;
    	// Reference the PayPal PHP REST SDK for details.

    	$transaction = PayPal::Transaction();
    	$transaction->setAmount($amount);
    	$transaction->setDescription('What are you selling?');

    	$redirectUrls = PayPal:: RedirectUrls();
    	$redirectUrls->setReturnUrl(action('HomeController@paymentResults'));
    	$redirectUrls->setCancelUrl(action('HomeController@paymentResults'));

    	$payment = PayPal::Payment();
    	$payment->setIntent('sale');
    	$payment->setPayer($payer);
    	$payment->setRedirectUrls($redirectUrls);
    	$payment->setTransactions(array($transaction));

    	$response = $payment->create($this->_apiContext);
        print_r($response);
    	$redirectUrl = $response->links[1]->href;
        die($redirectUrl);
    	return Redirect::to( $redirectUrl );

    }

    public function paymentResults() {

    }
}
