<?php

// php ~/public_html/dev/oddsAndEnds/rentals.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ine="***************************************************\n";

$year=0;
$minInvestment=50000.00;
$monthlyAppreciation=0.0025;//3%apr
$yearsTillRetire=6;//5 full years
$retirementIncomeDesired=100000.00;

echo "\n".$ine.$ine;

//starts w 50, 100, 150, 200k
foreach (range(4, 4) as $investmentsMult){
    
    echo $ine;
    
    //whether there is a company match of 6% or not
    foreach (range(1, 2) as $investmentsMatch){
        
        echo $ine;
        
        $investments=$investmentsMult*$minInvestment;
        $houses=0;
        $netRent=600.00;
        $costOfHouse=50000.00;
        $afterTaxInvestment=0;//110k salary leaves 5667 mth disposible income
        //1870 house payment $300k home outside of decatur
        
        if($investmentsMatch==1)
            $monthlyInvestment=24000/12;
        else
            $monthlyInvestment=30000/12;
        
        //output heading
        echo "\n";
        echo "Initial Investment: $". number_format($investmentsMult*50000.00); echo "\n";
        echo "Monthly Investment: $". number_format($monthlyInvestment); echo "\n";
        echo "After Tax Investment: $". number_format($afterTaxInvestment); echo "\n";
        echo "Retirement Income Desired: $". number_format($retirementIncomeDesired); echo "\n";
        echo "Years to Retire: ". $yearsTillRetire; echo "\n";
        echo "\n";

        $mask = "|%10.10s |%10.10s |%-6.6s | %-15.15s |\n";
        printf($mask, 'Years In', 'Months In', 'Houses', 'ETC Acc Value');

        $yearlast=0;

        //no more than 15 years of months
        foreach (range(1, 12*15) as $monthIn) {

            //calculate monthly rent collected & add to account
            $investments=$investments+($netRent*$houses)+$monthlyInvestment;
file_put_contents('houses_investments', 
"year " .$year. " months ".
$monthIn." ".$houses." $". number_format($investments).
" before $". number_format($monthlyInvestment).
" after $". number_format($afterTaxInvestment)."\n", FILE_APPEND);
            //buy house if enough cash is in hand
            if($costOfHouse<=$investments){
                $houses++;
                $investments=$investments-$costOfHouse;
                //file_put_contents('variables', 
//                    $monthIn." ".$houses."\n", FILE_APPEND);
            }
                       
            //add appreciation to rents and cost of houses
            $netRent=round($netRent+$netRent*$monthlyAppreciation,2);
            $costOfHouse=round($costOfHouse+$costOfHouse*$monthlyAppreciation,2);

            $year=floor(($monthIn-1)/12);

            //only output for a year
            if($year > $yearlast){
                printf($mask, "Year:" . $year, $monthIn-$year*12, $houses, 
                "$".number_format($investments));
                $yearlast=$year;
                
                //stop adding income to investment after retiring
                if($year>$yearsTillRetire-1) {
                    $monthlyInvestment=0;
                    $afterTaxInvestment=0;
                }
                
            }

            //is my yearly income at a certain level?
            if(($netRent*$houses*12)>=$retirementIncomeDesired) {
                break;
            }
        }

        printf($mask, "Year:" . $year, $monthIn-$year*12, $houses, 
                "$".number_format($investments));
                echo "\n";
                echo "Yearly Income: $". number_format($netRent*$houses*12); echo "\n";
    }
}


