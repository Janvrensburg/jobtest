<?php


class functions
{
	protected $tp;
    public $email = '';
	public $purchased_currency;
	public $amount_due;
	public $foreign_currency;
	
	    public function setCurrency($val)
    {
        $this->foreign_currency = $val;
    }


	    public function setPurchasedcurrency($val)
    {
        $this->purchased_currency = $val;
    }
	
	    public function setAmountdue($val)
    {
        $this->amount_due = $val;
    }
	
	public function settp($tp)
    {
        $this->tp = $tp;
    }
	
    public function setEmail($val)
    {
        $this->email = $val;
    }
   
    public function sendMail() {
 $tp = $this->tp;
	$error = "";
	$message = '<h1>Thank you for your order</h1><hr>
	  <strong>Amount Purchased:</strong> '.$this->purchased_currency.'<br>
	  <strong>Currency Purchased:</strong> '.$this->foreign_currency.'<br>
	 <strong>Total Due:</strong> '.$this->amount_due.'<hr>';

			
			$sender_name = $tp->toEmail('JunkNet.co.za',TRUE,'RAWTEXT');
			$sender = check_email($this->email);
			$subject = $tp->toEmail('Your Order',TRUE,'RAWTEXT');
			$to      = $sender;
			$cleanedFrom = trim(strip_tags('webmaster@test.co.za')); 
			$headers = "From: " . $cleanedFrom . "\n";
			$headers .= "Reply-To: ". strip_tags('webmaster@test.co.za') . "\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
			
if (mail($to, $subject, $message, $headers)) {
echo "message sent";
}
    }
}



?>