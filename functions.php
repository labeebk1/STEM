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
		<h2 style="background-color: white";>
			<b>Instructor Calendar</b><br>
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
            <legend></legend>
        </h2>
		<div id="event_list" class="none"></div>
        <!--For Add Event-->
        <div id="event_add" class="none"">
        	<h2 style="text-align: center"><b>Add a class on <span id="eventDateView"></span>:</b><br>
        	<p style="text-align: left; font-size: 16px; line-height: 100%;">
            Student Name:<br>


			<input list="student" name="student">
			<datalist id="student">

			<?php


			include 'dbConfig.php';
			$userlogin = $_SESSION['username'];

			if($userlogin == 'labeeb' || $userlogin == 'm_mcmillan' || $userlogin == 'aman' || $userlogin == 'aziz'){
				$result = $db->query("SELECT distinct student FROM students;");
			} else {
				$result = $db->query("SELECT student FROM students where username = '".$userlogin."';");
			}

			$num_rows = mysql_num_rows($result);
			for ($i=0;$i<$num_rows;$i++) {
				$row = mysql_fetch_assoc($result);
				echo '<option value="$row['.$row['student'].']">';
			}

			?>
			</datalist>


            <br>
            Hours:<br>
            <input type="text" id="hours" value=""/> <!-- LK Edit -->
            <input type="hidden" id="eventDate" value=""/><br><br>
            <input type="button" id="addEventBtn" value="Add Class"/><br>
           	</p></h2>
        </div>
		<div id="calender_section_top">
			<ul style="font-size:15px;"><b>
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
						if($userlogin == "labeeb" || $userlogin == "m_mcmillan"){
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
								alert('Thank you for submitting your time sheet with STEM Academy! Session Successfully Added.');
							getCalendar('calendar_div',dateSplit[0],dateSplit[1]);
						}else{
							alert('Some problem occurred, please contact Labeeb or Marie.');
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
	if($userlogin == "labeeb" || $userlogin == "m_mcmillan"){
		$result = $db->query("SELECT username, student, hours FROM events WHERE date = '".$date."'");
	} else {
		$result = $db->query("SELECT username, student, hours FROM events WHERE username = '".$userlogin."' AND date = '".$date."'");
	}

	if($result->num_rows > 0){
		$eventListHTML = '<h2><b>Classes on '.date("l, d M Y",strtotime($date)).':</b>';
		$eventListHTML .= '<ul>';
		while($row = $result->fetch_assoc()){ 
            $eventListHTML .= '<li>'.$row['username'].' - '.$row['student'].' - '.$row['hours'].' hours</li>';
        }
		$eventListHTML .= '</ul></h2>';
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

	$insert = $db->query("INSERT INTO `events` (`username`, `student`, `hours`, `date`, `created`, `status`) VALUES
		('".$_SESSION['username']."', '".$student."', '".$hours."', '".$date."', '".$currentDate."', 1);");


	if($insert){
		echo 'ok';
	}else{
		echo 'err';
	}
}
?>