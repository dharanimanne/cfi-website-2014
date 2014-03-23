<?php
$activity_id =0; //$_GET['activity_id'];

include ('codebase/connector/gantt_connector.php');
 
$res=mysql_connect("localhost","root","") or die();
mysql_select_db("cfi-2014");
 
$gantt = new JSONGanttConnector($res);
$gantt->render_links("cfi_gantt_links","id","source,target,type");
$gantt->render_table(
    "cfi_gantt_tasks",$activity_id,
    "id",
    "start_date,duration,text,progress,sortorder,parent"
);

?>