<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='payments@visteco.com'; // Business email ID 

//echo $amount."*****".$paymentMethod."*****".$userID;
//die;
?>

<h4>Topup with amount of {{$amount}}</h4>

<div class="image">
        <img src="{{URL::to('images/payment/paypalLogo.jpg')}}" height="100px" width="150px"/>     
    </div>
    <div class="name">
        Payment
    </div>
    <div class="price">
        Price:{{$amount}}
			<?php ;
			$tpup=str_replace("$","",$amount);
			?>
    </div>



<div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="Test Payment">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="{{$userID}}">    
    <input type="hidden" name="amount" value="{{$tpup}}">  
    <input type="hidden" name="cpp_header_image" value="http://www.antigenlab.com/wp-content/uploads/2016/02/Business-Loan.png">    
    <input type="hidden" name="no_shipping" value="0"> 
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0"> 
	<input type="hidden" name="cancel_return" value="{{url('http://visteco.com/public/canceltopup/'.$userID)}}">  
	<input type="hidden" name="return" value="{{url('http://visteco.com/public/sucesstopup/'.$userID.'/'.$tpup)}}">   
    <!--<input type="hidden" name="return" value="http://localhost:80/imgz/success.php?order_id=5&order_status=1"> 
    <!--<input type="hidden" name="cancel_return" value="http://localhost:80/imgz/cancel.php">
    <input type="hidden" name="return" value="http://localhost:80/imgz/success.php?order_id=5&order_status=1"> 
		 <!--<input type="hidden" name="return" value="http://localhost:80/imgz/success.php">--> 
	
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>




    