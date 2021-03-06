<?php
	class MultipleChoiceType
	{
		public $question;
		public $answers;
		public $answerIndex;
		public $jsMathUse = true;
		public $links = "keine Links zu dieser Aufgabe vorhanden";
		public $help;
		public $taskDescription = "";
	
		public function __construct($question, $answers, $answerIndex)
		{
			// shuffle answers to make it more random -> user has to read the buttons every time -> remembers them better maybe
			$result = $answers[$answerIndex];
			shuffle($answers);
		
			$this->question = $question;
			$this->answers = $answers;
			$this->answerIndex = array_search($result, $answers);
		}
	
		public function SetTaskTitle()
		{
			echo "<title>Train Yourself</title>";
		}

		public function AddTaskStyle()
		{
			echo "<link rel='stylesheet' type='text/css' href='kernel/types/MultipleChoiceType.css'>";
		}
		
		public function AddTask()
		{
			echo "<div id='completeTask' onkeyup='Next()'>";
				echo "<div id='taskDescription'>". $this->taskDescription ."</div>";
				if($this->jsMathUse) echo "<div id='question'><div class='math'>". $this->question . "</div></div>";
				else echo "<div id='question'>". $this->question . "</div>";
				
				echo "<div id='answerBar'>";
					for($i = 0; $i < count($this->answers); $i++)
					{
						echo "<button class='answerButton' onclick='CheckResult(this)'>". $this->answers[$i] ."</button>";
					}
					echo "<button id='next' onclick='Next()'>Nächste</button>";
				echo "</div>";
			echo "</div>";
		}
		
		public function AddScript()
		{
            echo "
				<script>
					var result = \"".$this->answers[$this->answerIndex]."\";
				</script>
				<script src=\"kernel/types/MultipleChoiceType.js\"></script>
            ";
		}
		
		public function AddTaskLinks()
		{
			echo "<div id='taskLinks'><span>". $this->links ."</span></div>";
		}
		
		public function AddHelp()
		{
			echo $this->help;
		}
	}
?>
