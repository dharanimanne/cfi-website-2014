 

	gantt.config.fit_tasks = true;



		gantt.config.xml_date = "%Y-%m-%d %H:%i";
		gantt.init(".gantt_here");
		gantt.load('/cfi-website-2014/projects/plugins/data.php');//loads data to Gantt from the database
		var dp=new dataProcessor("/cfi-website-2014/projects/plugins/data.php");   
		dp.init(gantt);
		
		function showScaleDesc(){
			var min = gantt.getState().min_date,
				max = gantt.getState().max_date,
				to_str = gantt.templates.task_date;

			return dhtmlx.message("Scale shows days from " + to_str(min) + " to " + to_str(max));
		}
		gantt.attachEvent("onScaleAdjusted", showScaleDesc);
  