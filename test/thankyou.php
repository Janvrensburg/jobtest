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



$text = '
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