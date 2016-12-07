<?php

// php ~/public_html/dev/oddsAndEnds/rentals_Dec.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '2048M');

$priceOfHouse=335000.00;
$pertDwn=.20;

$data = array(
        'loan_amount' 	=> $priceOfHouse-($pertDwn*$priceOfHouse),
        'term_years' 	=> 30,
        'interest' 	=> 4,
        'terms' 	=> 12//months in year
        );
        $amort=new Amortization($data);
        $amortArr=$amort::$results;
        
        //print_r($amortArr["schedule"][0]["balance"]);
        /*
         *     [inputs] => Array
        (
            [loan_amount] => 264000
            [term_years] => 30
            [interest] => 4
            [terms] => 12
        )

    [summary] => Array
        (
            [total_pay] => 453735.49681
            [total_interest] => 189735.49681
        )

    [schedule] => Array
        (
            [0] => Array
                (
                    [payment] => 1260.37638003
                    [interest] => 880
                    [principal] => 380.376380029
                    [balance] => 263619.62362
                )

         */


$line="******************************************************************************************************************\n";

$rent=2100;//initial rent
$netRent=.92*$rent;//assume 75% occupation
$year=0;
$TotInvest=$moneyDown=67000.00;
$monthlyAppreciation=0.00457;//7%apr 00583, 6%.005, 5% .00417
$yearsTillRetire=10;//5 full years
$taxPay=4654/12;
$insPay=420/12;
$housePayment=$taxPay+$insPay+$amortArr["schedule"][0]["payment"];
$beginingMonthOffset=1+48;

$valueOfHouse=$priceOfHouse;
//$monthlyOutOfPocket=0;
$yearlast=0;


$mask = "|%10.10s ]%10.10s |%-12.12s |%-12.12s | %-12.12s | %-12.12s | %-10.10s | %-12.12s | %-12.12s |\n";
printf($mask, 'Date', 'Year/Month', 'Mort/Tax/Ins', 'Net Inc $', 'Total Invest $', 'House Val', 'Rent',
        'Bal. Owed', 'Equity');

foreach (range(1,$yearsTillRetire*12) as $monthIn) {
    
    $year=floor(($monthIn-1)/12);
    //only output for a year
    if($year > $yearlast){
        echo$line;echo$line;
        printf($mask, 'Date', 'Year/Month', 'Mort/Tax/Ins','Net Inc', 'Total Invest $', 'House Val', 'Rent',
                'Bal. Owed', 'Equity');
    }
    $netIncome=$netRent-$housePayment;
    $TotInvest=$TotInvest-$netIncome;
    
    $thisMonth=$monthIn+$beginingMonthOffset;
    printf($mask, date('M Y', strtotime("+$thisMonth months")),
        $year.".".$monthIn, 
        "$".number_format($housePayment,2),
        "$".number_format($netIncome,2),
        "$".number_format($TotInvest,2),
        "$".number_format($valueOfHouse,2),
        "$".number_format($netRent,2),
        "$".number_format($amortArr["schedule"][$monthIn-1]["balance"],2),
        "$".number_format($valueOfHouse-$amortArr["schedule"][$monthIn-1]["balance"],2));
    
     
    
    $yearlast=$year;
       
    $netRent=$netRent+$netRent*$monthlyAppreciation;
    $valueOfHouse=$valueOfHouse+$valueOfHouse*$monthlyAppreciation;
    $taxPay=$taxPay+$taxPay*$monthlyAppreciation;
    $insPay=$insPay+$insPay*$monthlyAppreciation;
    $housePayment=$taxPay+$insPay+$amortArr["schedule"][$monthIn-1]["payment"];
    
}
echo "\n";
$mask = "Loan Amnt %-12.12s Term Yrs %-4.4s Int. Rate %-6.6s"
        . " Pd Over Term %-12.12s Int. Over Term %-12.12s\n"
        . "Prchs Prc %-12.12s  Annual Apprc Rate %-6.6s"
        . " Prcnt Dwn %-6.6s  Money Dwn %-12.12s \n";
printf(
        $mask, 
        "$".number_format($amortArr["inputs"]["loan_amount"],2), 
        number_format($amortArr["inputs"]["term_years"]), 
        number_format($amortArr["inputs"]["interest"],2),
        "$".number_format($amortArr["summary"]["total_pay"],2),
        "$".number_format($amortArr["summary"]["total_interest"],2),
        "$".number_format($priceOfHouse,2),
        number_format($monthlyAppreciation*100*12,2),
        number_format($pertDwn*100,2),
        "$".number_format($moneyDown,2)
        );



echo "\n";echo "\n";echo "\n";echo "\n";echo "\n";echo "\n";echo "\n";

    class Amortization
    {
            private $loan_amount;
            private $term_years;
            private $interest;
            private $terms;
            private $period;
            private $currency = "XXX";
            private $principal;
            private $balance;
            private $term_pay;
            public static $results="yo"; 
            public function __construct($data)
            {
                    if($this->validate($data)) {

                            $this->loan_amount 	= (float) $data['loan_amount'];
                            $this->term_years 	= (int) $data['term_years'];
                            $this->interest 	= (float) $data['interest'];
                            $this->terms 		= (int) $data['terms'];

                            $this->terms = ($this->terms == 0) ? 1 : $this->terms;
                            $this->period = $this->terms * $this->term_years;
                            $this->interest = ($this->interest/100) / $this->terms;
                            static::$results = array(
                                    'inputs' => $data,
                                    'summary' => $this->getSummary(),
                                    'schedule' => $this->getSchedule(),
                                    );
                            //static $results;
//				static $yo="yo";//$this->output($results);
                    }

            }

            private function validate($data) {
                    $data_format = array(
                            'loan_amount' 	=> 0,
                            'term_years' 	=> 0,
                            'interest' 		=> 0,
                            'terms' 		=> 0
                            );
                    $validate_data = array_diff_key($data_format,$data);

                    if(empty($validate_data)) {
                            return true;
                    }else{
                            echo "<div style='background-color:#ccc;padding:0.5em;'>";
                            echo '<p style="color:red;margin:0.5em 0em;font-weight:bold;background-color:#fff;padding:0.2em;">Missing Values</p>';
                            foreach ($validate_data as $key => $value) {
                                    echo ":: Value <b>$key</b> is missing.<br>";
                            }
                            echo "</div>";
                            return false;
                    }
            }
            private function calculate()
            {
                    $deno = 1 - 1 / pow((1+ $this->interest),$this->period);
                    if($deno==0)$deno=.0001;
                    $this->term_pay = ($this->loan_amount * $this->interest) / $deno;
                    $interest = $this->loan_amount * $this->interest;
                    $this->principal = $this->term_pay - $interest;
                    $this->balance = $this->loan_amount - $this->principal;
                    return array (
                            'payment' 	=> $this->term_pay,
                            'interest' 	=> $interest,
                            'principal'     => $this->principal,
                            'balance' 	=> $this->balance
                            );
            }
            public function getSummary()
            {
                    $this->calculate();
                    $total_pay = $this->term_pay *  $this->period;
                    $total_interest = $total_pay - $this->loan_amount;
                    return array (
                            'total_pay' => $total_pay,
                            'total_interest' => $total_interest,
                            );
            }
            public function getSchedule()
            {
                    $shedule = array();

                    while  ($this->balance >= 0) {
                            $i=1;
                            array_push($shedule, $this->calculate());
                            $this->loan_amount = $this->balance;
                            $this->period--;
                            $i++;
                    }
                    return $shedule;
            }
            public function output($data)
            {
                //public static::$Amort=$data["shedule"];

//                    $mask = "|%10.10s |%10.10s |%-12.12s | %-15.15s | %-15.15s |\n";
//                    printf($mask, 'Payment No.','Payment', 'Interest', 'Principle', 'Balance');
                    //print_r($data["shedule"] );
                    /*[8] => Array
                            (
                                [payment] => 1758.3177446
                                [interest] => 57.4095955215
                                [principal] => 1700.90814908
                                [balance] => 5188.2433135
                            )
                     */
                //|       #:0 |    $1,432 |$1,000       | $432            | $299,568        |
                /*
                    foreach ($data["shedule"] as $key => $value) {
                        printf($mask, "#:" . $key, 
                                "$".number_format($value["payment"]),
                                "$".number_format($value["interest"]),
                                "$".number_format($value["principal"]),
                                "$".number_format($value["balance"]));
                    }
                 * */
//                    echo "<pre>";
//                    print_r($data["shedule"]);
//                    echo "</pre>";
//                    $results=$data;
//                        public static $results=$data;


            }
    }

die();


