<?php
/*
 * Function requested by Ajax
 */
session_start();
if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		//For Add Event
		case 'addEvent':
			addEvent($_POST['student'],$_POST['hours'],$_POST['date']);
			break;
		default:
			break;
	}
}
/*
 * Get calendar full HTML
 */
function getCalender($year = '',$month = '')
{
	$dateYear = ($year != '')?$year:date("Y");
	$dateMonth = ($month != '')?$month:date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>

	<div id="calender_section">
		<h2 style="background-color: white;">


		  <div class="container" style="position: relative; left: 50%; transform: translateX(-50%);">
		      <div class="well form-horizontal" style="text-align: center; color: white; font-size: 21px; 
		                                               background-color: #00bfff; display: inline-block;" >
		  		<fieldset>
					<b>Instructor Calendar</b>
		  		</fieldset>
		  	</div>
		  </div><!-- /.container -->
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </h2>
        <legend></legend>
		<div id="event_list" class="none"></div>
        <!--For Add Event-->
        <div id="event_add" class="none">
        	<h2 style="text-align: center;"><b>Add a class on <span id="eventDateView"></span>:</b><br>
        	<p style="text-align: center; font-size: 17px; line-height: 100%; background-color: #99FF99; border: 1px solid black; width: 300px; display: inline-block;">
        	<br>
            <b>Student Name:</b><br>
			<input list="students" name="student" id="student" style="width:140px; text-align: center;">
			<datalist id="students">
			<?php
				include 'dbConfig.php';
				$userlogin = $_SESSION['username'];
				if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman' || $userlogin == 'aziz'){
					$result = $db->query("SELECT distinct student FROM students;");
				} else {
					$result = $db->query("SELECT student FROM students where username = '".$userlogin."';");
				}
				while($results = mysqli_fetch_assoc($result)) {
					echo "<option value=".$results['student']."></option>";
	    		}
			?>	
			</datalist>
            <br><br>
            <b>Hours:</b><br>
            <input list="hour" name="hours" id="hours" style="width:140px; text-align: center;">
            <datalist id="hour">
            	<option value="0.5"></option>
            	<option value="1.0"></option>
            	<option value="1.5"></option>
            	<option value="2.0"></option>
            	<option value="2.5"></option>
            	<option value="3.0"></option>
            	<option value="3.5"></option>
            	<option value="4.0"></option>
            </datalist>
            <input type="hidden" id="eventDate" value=""/><br><br>
            <input type="button" id="addEventBtn" value="Add Class"/><br>
            <br>
           	</p>
           	</h2>
        </div>

		<div id="calender_section_top" >
			<ul><b>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</b></ul>
		</div>

		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						//Current date
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						$eventNum = 0;
						$userlogin = $_SESSION['username'];
						//Include db configuration filess
						include 'dbConfig.php';
						//Get number of events based on the current date
						if($userlogin == "labeeb" || $userlogin == "m_mcmillan" || $userlogin == "aziz" || $userlogin == "aman"){
							$result = $db->query("SELECT student FROM events WHERE date = '".$currentDate."'");

						} else {
							$result = $db->query("SELECT student FROM events WHERE username = '".$userlogin."' AND date = '".$currentDate."'");
							
						}
						$eventNum = $result->num_rows;
						//Define date cell color
						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif($eventNum > 0){
							echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						//Date cell
						echo '<span>';
						echo $dayCount;
						echo '</span>';
						
						//Hover event popup
						echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo '<div class="popup_event">Classes ('.$eventNum.')</div>';
						echo ($eventNum > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">view classes</a><br/>':'';
						//For Add Event
						echo '<a href="javascript:;" onclick="addEvent(\''.$currentDate.'\');">add class</a>';
						echo '</div></div>';
						
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>

		</div>
	</div>


	<script type="text/javascript">
		function getCalendar(target_div,year,month){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getCalender&year='+year+'&month='+month,
				success:function(html){
					$('#'+target_div).html(html);
				}
			});
		}
		
		function getEvents(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getEvents&date='+date,
				success:function(html){
					$('#event_list').html(html);
					$('#event_add').slideUp('slow');
					$('#event_list').slideDown('slow');
				}
			});	
		}
		//For Add Event
		function addEvent(date){
			$('#eventDate').val(date);
			$('#eventDateView').html(date);
			$('#event_list').slideUp('slow');
			$('#event_add').slideDown('slow');
		}
		//For Add Event
		$(document).ready(function(){
			$('#addEventBtn').on('click',function(){
				var date = $('#eventDate').val();
				var student = $('#student').val();
				var hours = $('#hours').val();
				$.ajax({
					type:'POST',
					url:'functions.php',
					data: 'func=addEvent&student='+student+'&hours='+hours+'&date='+date,
					success:function(msg){
						if(msg == 'ok'){
							var dateSplit = date.split("-");
							$('#student').val('');
							$('#hours').val('');
								alert('Session Successfully Added. Thank you for submitting your time sheet with STEM Academy!');
							getCalendar('calendar_div',dateSplit[0],dateSplit[1]);
						}else{
							alert('Error. Please confirm your Student Name and Hours are following the dropdown entries. If the problem persists, please contact Labeeb.');
						}
					}
				});
			});
		});
		
		$(document).ready(function(){
			$('.date_cell').mouseenter(function(){
				date = $(this).attr('date');
				$(".date_popup_wrap").fadeOut();
				$("#date_popup_"+date).fadeIn();	
			});
			$('.date_cell').mouseleave(function(){
				$(".date_popup_wrap").fadeOut();		
			});
			$('.month_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$('.year_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$(document).click(function(){
				$('#event_list').slideUp('slow');
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 01)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = ''){
	$options = '';
	for($i=2015;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}

/*
 * Get events by date
 */
function getEvents($date = ''){
	//Include db configuration file
	include 'dbConfig.php';
	$eventListHTML = '';
	$date = $date?$date:date("Y-m-d");
	//Get events based on the current date

	$userlogin = $_SESSION['username'];
	if($userlogin == "labeeb" || $userlogin == "m_mcmillan" || $userlogin == "aziz" || $userlogin == "aman"){
		$result = $db->query("SELECT username, student, hours, status FROM events WHERE date = '".$date."'");
	} else {
		$result = $db->query("SELECT username, student, hours, status FROM events WHERE username = '".$userlogin."' AND date = '".$date."'");
	}

	if($result->num_rows > 0){
		$eventListHTML = '<h2><b>Classes on '.date("l, d M Y",strtotime($date)).':</b>';
		$eventListHTML .= '<div class="table">';
		$eventListHTML .= '<div class="row header green">';
		$eventListHTML .= '<div class="cell">Instructor</div>';
		$eventListHTML .= '<div class="cell">Student</div>';
		$eventListHTML .= '<div class="cell">Hours</div>';
		$eventListHTML .= '<div class="cell">Status</div>';
		$eventListHTML .= '</div>';

		while($row = $result->fetch_assoc()){ 
			$eventListHTML .= '<div class="row">';
				$eventListHTML .= '<div class="cell">'.$row['username'].'</div>';
				$eventListHTML .= '<div class="cell">'.$row['student'].'</div>';
				$eventListHTML .= '<div class="cell">'.$row['hours'].'</div>';
				if($row['status'] == 1) {
					$eventListHTML .= '<div class="cell">Unpaid</div>';
				} else {
					$eventListHTML .= '<div class="cell">Paid</div>';
				}
			$eventListHTML .= '</div>';
        }
		$eventListHTML .= '</div>';
	}
	echo $eventListHTML;
}

/*
 * Add event to date
 */
function addEvent($student,$hours,$date){
	//Include db configuration file
	include 'dbConfig.php';
	$currentDate = date("Y-m-d H:i:s");
	//Insert the event data into database
	$userlogin = $_SESSION['username'];

	if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman' || $userlogin == 'aziz'){
		$result = $db->query("SELECT distinct student FROM students;");
	} else {
		$result = $db->query("SELECT student FROM students where username = '".$userlogin."';");
	}
	
	$rejectStudent = true;
	$rejectHours = true;

	while($results = mysqli_fetch_assoc($result)) {
		if($results['student'] == $student){
			$rejectHours = false;
		}
	}
	while($results = mysqli_fetch_assoc($result)) {
		if($hours == '0.5' || 
			$hours == '1.0' || 
			$hours == '1.5' || 
			$hours == '2.0' || 
			$hours == '2.5' || 
			$hours == '3.0' || 
			$hours == '3.5' || 
			$hours == '4.0'){
			$rejectHours = false;
		}
	}
	if($rejectHours == true || $rejectHours == true){
		echo 'err';
	} else {
		$insert = $db->query("INSERT INTO `events` (`username`, `student`, `hours`, `date`, `created`, `status`) VALUES
			('".$_SESSION['username']."', '".$student."', '".$hours."', '".$date."', '".$currentDate."', 1);");
		if($insert){
			echo 'ok';
		}else{
			echo 'err';
		}
	}

}
?>