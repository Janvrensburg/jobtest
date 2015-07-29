<?php


class database
{


    protected $sql;
	public $transaction_id;
	public $transaction_date;
	public $transaction_discount;
	public $email;
	public $foreign_currency;
	public $exchange_rate;
	public $surcharge_percentage;
	public $purchased_currency;
	public $amount_due;
	public $surcharge_total;

    public function setEmail($val)
    {
        $this->email = $val;
    }
    public function setDiscount($val)
    {
        $this->transaction_discount = $val;
    }
    public function setDate($val)
    {
        $this->transaction_date = $val;
    }
    public function setCurrency($val)
    {
        $this->foreign_currency = $val;
    }
    public function setExchangerate($val)
    {
        $this->exchange_rate = $val;
    }
    public function setSurchargepercent($val)
    {
        $this->surcharge_percentage = $val;
    }
    public function setPurchasedcurrency($val)
    {
        $this->purchased_currency = $val;
    }
    public function setAmountdue($val)
    {
        $this->amount_due = $val;
    }
    public function setSurchargetotal($val)
    {
        $this->surcharge_total = $val;
    }
    public function setDb($sql)
    {
        $this->sql = $sql;
    }

   
    public function saveData() {
	
		$rows = null;
		$sql = $this->sql;

			
			
		$insert = array(
			'transaction_date' => $this->transaction_date,
			'discount' => $this->transaction_discount,
			'email' => $this->email,
			'foreign_currency' => $this->foreign_currency,
			'exchange_rate' => $this->exchange_rate,
			'surcharge_percentage' => $this->surcharge_percentage,
			'purchased_currency' => $this->purchased_currency,
			'amount_due' => $this->amount_due,
			'surcharge_total' => $this->surcharge_total
		);									
     
    	$sql->insert('test', $insert); // where 'user' is the table name

    }
}



?>