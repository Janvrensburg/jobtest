<?php

require_once("../../class2.php");


e107::js('test','js/my.js','jquery');	 
e107::css('test','css/my.css');		
e107::lan('test'); 					
e107::meta('keywords','some words');	

require_once(HEADERF); 					


$sql = e107::getDB(); 					
$tp = e107::getParser(); 				 
$frm = e107::getForm(); 				
$ns = e107::getRender();				

require_once("functions.php");
require_once("database.php");

$text = "";
if (isset($_POST['required_amount'])) {

		$db_class = new database();
		$db_class->setDb($sql);
		$today = date("Y-m-d H:i:s");
		
		$db_class->setDate($today);

		$db_class->setEmail($_POST['email']);
		$db_class->setDiscount($_POST['discount']);
		$db_class->setCurrency($_POST['select_currency']);
		$db_class->setExchangerate($_POST['exchange_rate']);
		$db_class->setSurchargepercent($_POST['surcharge_percentage']);
		$db_class->setPurchasedcurrency($_POST['required_amount']);
		
			if ($_POST['select_currency'] == 'EUR') {
				$extrainfo = 'We have applied a 2.0% discount';
				$newprice = $_POST['due_amount'] * ((100-$_POST['discount']) / 100);
				$db_class->setAmountdue($newprice);
			} else {
				$db_class->setAmountdue($_POST['due_amount']);
			}
		
		
		$db_class->setAmountdue($_POST['due_amount']);
		$db_class->setSurchargetotal($_POST['surcharge']);
		
		$db_class->saveData();

		if ($_POST['select_currency'] == 'GBP') {
		
			$func_class = new functions();
			
			$func_class->settp($tp);
			$func_class->setPurchasedcurrency($_POST['required_amount']);
			$func_class->setCurrency($_POST['select_currency']);
			$func_class->setAmountdue($_POST['due_amount']);
			$func_class->setEmail($_POST['email']);
			$func_class->sendMail();
			$extrainfo = 'We have forwarded a copy of this order to '.$_POST['email'].'';
		}
		
		

		
		$text = '<hr>
				  <strong>Amount Purchased:</strong> '.$_POST['required_amount'].'<br>
				  <strong>Currency Purchased:</strong> '.$_POST['select_currency'].'<br>
				 <strong>Total Due:</strong> '.$_POST['due_amount'].'<hr>'.$extrainfo.'<hr>';
		
		$ns->tablerender("Thank you for your order", $text);

		require_once(FOOTERF);					
		exit; 
}











$text = '

<script>

$(function(){
 	$("#select_currency").change(function() {

		var selected_currency = $("#select_currency option:selected").text();
		var result= 0;

		if (selected_currency == "US Dollar")
		{
			 result=Math.round(($("#required_amount").val()*1 + 1) /0.0808279*100)/100 
			 surcharge=Math.round(result * 0.75 / 100*100)/100
			 $("#surcharge_percentage").val("7.5");
			 $("#exchange_rate").val("0.0808279");
			
			  
		}
		if (selected_currency == "British Pound")
		{
			result=Math.round(($("#required_amount").val()*1 + 1) /0.0527032*100)/100 
			surcharge=Math.round(result * 0.5 / 100*100)/100
			$("#surcharge_percentage").val("0.5");
			$("#exchange_rate").val("0.0527032");
		}
		if (selected_currency == "Euro")
		{
			result=Math.round(($("#required_amount").val()*1 + 1) /0.0718710*100)/100
			surcharge=Math.round(result * 0.5 / 100*100)/100
			$("#surcharge_percentage").val("0.5");
			$("#exchange_rate").val("0.0718710");
			$("#discount").val("2.0");

		}
		if (selected_currency == "Kenyan Shilling")
		{
			result=Math.round(($("#required_amount").val()*1 + 1) /7.81498*100)/100 
			surcharge=Math.round(result * 0.25 / 100*100)/100
			$("#surcharge_percentage").val("0.25");
			$("#exchange_rate").val("7.81498");
		}
	
				$("#due_amount").val(result);
	$("#surcharge").val(surcharge);
	$("#total_due").val(result+surcharge);
	
	});

	jQuery("#required_amount").on("input", function() {
	
		var selected_currency = $("#select_currency option:selected").text();
		var result= 0;

		if (selected_currency == "US Dollar")
		{
		
			 result=Math.round(($("#required_amount").val()*1 + 1) /0.0808279*100)/100 
			 surcharge=Math.round(result * 0.75 / 100*100)/100
			$("#surcharge_percentage").val("7.5");
			$("#exchange_rate").val("0.0808279");
		}
		if (selected_currency == "British Pound")
		{
			 result=Math.round(($("#required_amount").val()*1 + 1) /0.0527032*100)/100 
			 surcharge=Math.round(result * 0.5 / 100*100)/100
			$("#surcharge_percentage").val("0.5");
			$("#exchange_rate").val("0.0527032");
		}
		if (selected_currency == "Euro")
		{
			 result=Math.round(($("#required_amount").val()*1 + 1) /0.0718710*100)/100 
			 surcharge=Math.round(result * 0.5 / 100*100)/100
			$("#surcharge_percentage").val("0.5");
			$("#exchange_rate").val("0.0718710");

		}
		if (selected_currency == "Kenyan Shilling")
		{
			result=Math.round(($("#required_amount").val()*1 + 1) /7.81498*100)/100 
			surcharge=Math.round(result * 0.25 / 100*100)/100
			$("#surcharge_percentage").val("0.25");
			$("#exchange_rate").val("7.81498");

		}
		
		$("#due_amount").val(result);
	$("#surcharge").val(surcharge);
	
	$("#total_due").val(result + surcharge);
	});

});

</script>



<form name="form1" method="post" action="">
<input type="hidden" name="due_amount" id="due_amount">
<input type="hidden" name="discount" id="discount">
<input type="hidden" name="surcharge" id="surcharge">
<input type="hidden" name="surcharge_percentage" id="surcharge_percentage">
<input type="hidden" name="exchange_rate" id="exchange_rate">
<table width="100%"  border="0" cellspacing="5">
  <tr>
    <td>Your Email </td>
    <td><input type="text" name="email" id="email"></td>
  </tr>
  <tr>
    <td width="50%">Please enter the required amount:</td>
    <td width="50%"><input type="text" name="required_amount" id="required_amount"></td>
  </tr>
  <tr>
    <td>Please select your required currency: </td>
    <td><select name="select_currency" id="select_currency">
      <option value="USD" selected>US Dollar</option>
      <option value="GBP">British Pound</option>
      <option value="EUR">Euro</option>
      <option value="KES">Kenyan Shilling</option>
    </select></td>
  </tr>
  <tr>
    <td>Total Due:</td>
    <td><input type="text" name="total_due" id="total_due"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="purchase"></td>
  </tr>
</table>
</form>
';

$ns->tablerender("Purchase Currency", $text);

require_once(FOOTERF);					
exit; 



?>