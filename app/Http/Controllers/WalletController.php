<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\walletRecharge;
use Validator;
use Redirect;
use Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('wallet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentForm(Request $request)
    {
        $amount=$request->get('amount');
        $paymentMethod=$request->get('paymentMethod');
        $userID=$request->get('user_info');
        if($paymentMethod=='creditDebitCard')
        {
            return view('paymentWithCard')->with('amount',$request->get('amount'))
                                          ->with('paymentMethod',$request->get('paymentMethod'))
                                          ->with('userID',$request->get('user_info'));
        }
        else 
        {
            if($paymentMethod=='paypal')
             {
                return view('paymentWithPaypal')->with('amount',$request->get('amount'))
                                                ->with('paymentMethod',$request->get('paymentMethod'))
                                                ->with('userID',$request->get('user_info'));
             }
        }
            
    }
    
    public function creditPayment(Request $request)
    {
        //echo"ji";die;
	$rules = array(
	//'amount'=>'required',
	//'add_url'=>'required|min:3',
	'firstname'=>'required|min:3',
	'lastname'=>'required|min:2',
	'email'=>'required|email',
	'address'=>'required|min:5',
	'state'=>'required|min:2',
	'city'=>'required|min:5',
	'zip'=>'required|min:5',
	'cardtype'=>'required',
	'cardholder'=>'required|min:3',
	'cardnumber'=>'required',
	'cardcvv'=>'required',
	'cardyear'=>'required|date_format:Y|min:4',
        );
	$validator = Validator::make($request->all(),$rules);
        //echo "hi";die;
	if($validator->passes())
	{
	    $LOGINKEY = '3f33zdLK2CQP';// x_login
	    $TRANSKEY = '4LHt783dV462wrF6';//x_tran_key
	    $firstName=$request->get('firstname');
	    $lastName=$request->get('lastname');
	    $creditCardType=$request->get('cardtype');
	    $creditCardNumber=$request->get('cardnumber');
	    $expDateMonth=$request->get('cardmonth');
	    $expDateYear=$request->get('cardyear');
	    $cvv2Number=$request->get('cardcvv');
	    $address=$request->get('address');
	    $city=$request->get('city');
	    $state=$request->get('state');
	    $zip=$request->get('zip');
        //********URL ENCODING ***************************
	    $firstName =urlencode($firstName);
	    $lastName =urlencode($lastName);
	    $creditCardType =urlencode($creditCardType);
	    $reditCardNumber =urlencode($creditCardNumber);
	    $expDateMonth =urlencode($expDateMonth);
           // Month must be padded with leading zero
	    $padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
	    $expDateYear =urlencode($expDateYear);
	    $cvv2Number = urlencode($cvv2Number);
	    $address = urlencode($address);
	    $city = urlencode($city);
	    $state =urlencode($state);
	    $zip = urlencode($zip);
	    $amount=$request->get('amount');
	    $id=$request->get("user_id");
	    $currencyCode="USD";
	    $paymentType="Sale";
	    $date = $expDateMonth.$expDateYear;

	    $post_values = array(
		 "x_login"=> "$LOGINKEY",
		 "x_tran_key"=> "$TRANSKEY",
		 "x_version"=> "3.1",
		 "x_delim_data"	=> "TRUE",
		 "x_delim_char"=> "|",
		 "x_relay_response"=> "FALSE",
		 //"x_market_type"=> "2",
		 "x_device_type"=> "1",
		 "x_type"=> "AUTH_CAPTURE",
		 "x_method"=> "CC",
		 "x_card_num"=> $creditCardNumber,
                 //"x_exp_date"=> "0115",
		 "x_exp_date"=> $date,
		"x_amount"=> $amount,
		//"x_description"=> "Sample Transaction",
		"x_first_name"=> $firstName,
		"x_last_name"=> $lastName,
		"x_address"=> $address,
		"x_state"=> $state,
		"x_response_format"=> "1",
		"x_zip"=> $zip,
		"x_id"=> $id
		// Additional fields can be added here as outlined in the AIM integration
		// guide at: http://developer.authorize.net
		);

			//echo '<pre>'; echo 'Request values'; print_r($post_values);
			//comment the above line. i have given this just for testing purpose.

			$post_string = "";
			foreach( $post_values as $key => $value )$post_string .= "$key=" . urlencode( $value ) . "&";
			$post_string = rtrim($post_string,"& ");

			//for test mode use the followin url
			$post_url = "https://test.authorize.net/gateway/transact.dll";
			//for live use this url
			//$post_url = "https://secure.authorize.net/gateway/transact.dll";

			$request1 = curl_init($post_url); // initiate curl object
			curl_setopt($request1, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request1, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request1, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
			curl_setopt($request1, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
			$post_response = curl_exec($request1); // execute curl post and store results in $post_response
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close ($request1); // close curl object

			// This line takes the response and breaks it into an array using the specified delimiting character
			$response_array = explode($post_values["x_delim_char"],$post_response);
print_r($response_array);
die;
			//echo '<br><br> Response Array'; print_r($response_array);
			//remove this line. i have used this just print the response array
			$ramnt=$response_array[9];
			$rsid=$response_array[68];
			//echo $rsid."<br/>";

			if($response_array[0]==2||$response_array[0]==3)
			{
				//success

				echo '<b>Payment Failure</b>. <br>';
				echo '<b>Error String</b>: '.$response_array[3];
				//echo '<br><br>Press back button to go back to the previous page';
				echo "<a href='home'>Continue Here.</a>";
			}
			else
			{
				$d=strtotime("Today");
				$rechrgdt=date("Y-m-d", $d);
				$ptid = $response_array[6];
				$ptidmd5 = $response_array[7];
                               
                                $temp = new walletRecharge();
                                $temp->recharger_id = $rsid;
                                $temp->recharge_amount = $ramnt;
                                $temp->recharge_date = $rechrgdt;
                                $temp->save();
				
				echo "<br/>Your Payment Success";
				echo "<a href='home'>Continue Here.</a>";
			}
		}
			else
				return back()->withErrors($validator)->withInput();
		}
    
    public function makePaymentForm(Request $request)
    {
       // echo "neha";die(" rana");
        return view('makePayment')->with('paymentAmount',$request->get('paymentAmount'))
                                  ->with('expiryDate',$request->get('expiryDate'))
                                  ->with('cardCvv',$request->get('cardCvv'))
                                  ->with('cardNumber',$request->get('cardNumber'))
                                  ->with('payment_method_nonce',$request->get('payment_method_nonce'))
                                  ->with('currencyCodeType',$request->get('currencyCodeType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
