﻿<?php
	function GenerateMentalMathTask($data)
	{
		$numTaskTypes = 6;
		if($data == "" || $data < 1 || $data > $numTaskTypes) $random = rand(1, $numTaskTypes);
		else $random = $data;
		
		// add
		if($random == 1)
		{
			$z1 = rand(2, 100);
			$z2 = rand(2, 100);
			$t = new SimpleQuestionAnswerType($z1 ."+". $z2, $z1 + $z2);
		}
		
		// subtract
		if($random == 2)
		{
			$z1 = rand(2, 100);
			$z2 = rand(2, 100);
			$t = new SimpleQuestionAnswerType($z1 ."-". $z2, $z1 - $z2);
		}
		
		// multiply
		if($random == 3)
		{
			$type = rand(1, 3);
			// same size
			if($type <= 2)
			{
				$z1 = rand(2, 20);
				$z2 = rand(2, 20);
				$t = new SimpleQuestionAnswerType($z1 ."*". $z2, $z1 * $z2);
			}
			// big difference
			if($type == 3)
			{
				$z1 = rand(2, 10);
				$z2 = rand(50, 1000);
				$t = new SimpleQuestionAnswerType($z1 ."*". $z2, $z1 * $z2);
			}
		}
		
		// divide
		if($random == 4)
		{
			$z1 = rand(2, 50);
			$z2 = $z1 * rand(2, 15);
			$t = new SimpleQuestionAnswerType($z2 .":". $z1, $z2 / $z1);
		}

		// square root
		if($random == 5)
		{
			$z1 = rand(2, 20);
			$z2 = $z1 * $z1;
			$t = new SimpleQuestionAnswerType("\sqrt{". $z2 . "}", $z1);
		} 

        // square
        if ($random == 6)
        {
            $z = rand(1, 20);
            $t = new SimpleQuestionAnswerType($z ."^2", pow($z, 2));
        }
		
		$t->links = '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask">alle üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-1">Addition üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-2">Subtraktion üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-3">Multiplizieren üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-4">Dividieren üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-5">Wurzel ziehen üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask-.-6">Quadrieren üben</a></br>';
		$t->links .= '</br>';
		$t->links .= '</br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask">Brüche üben</a></br>';
		
		return $t;
	}
	
	function GenerateFractionTask($data)
	{
		$numTaskTypes = 7;
		if($data == "" || $data < 1 || $data > $numTaskTypes) $random = rand(1, $numTaskTypes);
		else $random = $data;
		
		// reduce
		if($random == 1)
		{
			GenerateFraction(15, $a, $b, true);
			$factor = rand(2, 15);	
		
			$t = new SimpleQuestionAnswerType("Kürzen: <div class='math'>\\frac{". $a * $factor."}{". $b * $factor ."}</div>", $a ."/". $b);
		}
		
		// add
		if($random == 2)
		{
			GenerateFraction(15, $a1, $b1, false);
			GenerateFraction(15, $a2, $b2, false);
			AddFractions($a1, $b1, $a2, $b2, $resA, $resB);
		
			$t = new SimpleQuestionAnswerType("<div class='math'>\\frac{". $a1 ."}{". $b1 ."}+\\frac{". $a2 ."}{". $b2 ."}</div>", $resA ."/". $resB);
		}
		
		// subtract
		if($random == 3)
		{
			GenerateFraction(15, $a1, $b1, false);
			GenerateFraction(15, $a2, $b2, false);
			SubtractFractions($a1, $b1, $a2, $b2, $resA, $resB);
		
			$t = new SimpleQuestionAnswerType("<div class='math'>\\frac{". $a1 ."}{". $b1 ."}-\\frac{". $a2 ."}{". $b2 ."}</div>", $resA ."/". $resB);
		}
		
		// multiply
		if($random == 4)
		{
			GenerateFraction(15, $a1, $b1, false);
			GenerateFraction(15, $a2, $b2, false);
			MultiplyFractions($a1, $b1, $a2, $b2, $resA, $resB);
		
			$t = new SimpleQuestionAnswerType("<div class='math'>\\frac{". $a1 ."}{". $b1 ."}*\\frac{". $a2 ."}{". $b2 ."}</div>", $resA ."/". $resB);
		}
		
		// divide
		if($random == 5)
		{
			GenerateFraction(15, $a1, $b1, false);
			GenerateFraction(15, $a2, $b2, false);
			DivideFractions($a1, $b1, $a2, $b2, $resA, $resB);
		
			$t = new SimpleQuestionAnswerType("<div class='math'>\\frac{". $a1 ."}{". $b1 ."}:\\frac{". $a2 ."}{". $b2 ."}</div>", $resA ."/". $resB);
		}
		
		// root
		if($random == 6)
		{
			$exponent = rand(2, 5);
			// make the exponent 2 appear more often
			if($exponent < 5) 
			{
				$exponent = 2; 
				GenerateFraction(15, $a, $b, true);
			}
			else
			{
				$exponent = 3;
				GenerateFraction(6, $a, $b, true);
			}
			if($exponent == 2) $t = new SimpleQuestionAnswerType("<div class='math'>\\sqrt {\\frac{". pow($a, $exponent) ."}{". pow($b, $exponent) ."}}</div>", $a ."/". $b);
			else $t = new SimpleQuestionAnswerType("<div class='math'>\\root ". $exponent ." \of {\\frac{". pow($a, $exponent) ."}{". pow($b, $exponent) ."}}</div>", $a ."/". $b);
		}
		
		// potenz
		if($random == 7)
		{
			$exponent = rand(2, 5);
			// make the exponent 2 appear more often
			if($exponent < 5) 
			{
				$exponent = 2; 
				GenerateFraction(15, $a, $b, true);
			}
			else
			{
				$exponent = 3;
				GenerateFraction(6, $a, $b, true);
			}
			$t = new SimpleQuestionAnswerType("<div class='math'>{(\\frac{". $a ."}{". $b ."}})^". $exponent ."</div>", pow($a, $exponent) ."/". pow($b, $exponent));
		}
		
		$t->links = 'Beispiel: 3/4 ; 18/5';
		$t->links .= '</br>';
		$t->links .= '</br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask">alles mit Brüchen üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-1">Kürzen üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-2">Addition üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-3">Subtraktion üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-4">Multiplikation üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-5">Division üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-6">Wurzel ziehen üben</a></br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateFractionTask-.-7">Potenzieren üben</a></br>';
		$t->links .= '</br>';
		$t->links .= '</br>';
		$t->links .= '<a href="?task=MentalMathTasks-.-GenerateMentalMathTask">andere Kopfrechenaufgaben üben</a></br>';
		$t->jsMathUse = false;
		
		// check if the fraction is an integer
		if(!($random == 1 || $random == 6 || $random == 7)) if($resB == 1) $t->answer = $resA;
		
		return $t;
	}
?>
