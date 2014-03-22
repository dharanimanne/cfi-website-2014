/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
gantt.config.quickinfo_buttons=["icon_delete","icon_edit"];gantt.config.quick_info_detached=!0;gantt.attachEvent("onTaskClick",function(b){gantt.showQuickInfo(b);return!0});(function(){for(var b=["onEmptyClick","onViewChange","onLightbox","onBeforeTaskDelete","onBeforeDrag"],a=function(){gantt._hideQuickInfo();return!0},c=0;c<b.length;c++)gantt.attachEvent(b[c],a)})();gantt.templates.quick_info_title=function(b,a,c){return c.text.substr(0,50)};
gantt.templates.quick_info_content=function(b,a,c){return c.details||c.text};gantt.templates.quick_info_date=function(b,a,c){return gantt.templates.task_time(b,a,c)};gantt.showQuickInfo=function(b){if(b!=this._quick_info_box_id){this.hideQuickInfo(!0);var a=this._get_event_counter_part(b);if(a)this._quick_info_box=this._init_quick_info(a),this._fill_quick_data(b),this._show_quick_info(a)}};gantt._hideQuickInfo=function(){gantt.hideQuickInfo()};
gantt.hideQuickInfo=function(b){var a=this._quick_info_box;this._quick_info_box_id=0;if(a&&a.parentNode){if(gantt.config.quick_info_detached)return a.parentNode.removeChild(a);a.style.right=="auto"?a.style.left="-350px":a.style.right="-350px";b&&a.parentNode.removeChild(a)}};dhtmlxEvent(window,"keydown",function(b){b.keyCode==27&&gantt.hideQuickInfo()});
gantt._show_quick_info=function(b){var a=gantt._quick_info_box;if(gantt.config.quick_info_detached){(!a.parentNode||a.parentNode.nodeName.toLowerCase()=="#document-fragment")&&gantt.$task_data.appendChild(a);var c=a.offsetWidth,d=a.offsetHeight,e=this.getScrollState(),f=this.$task.offsetWidth+e.x-c;a.style.left=Math.min(Math.max(e.x,b.left-b.dx*(c-b.width)),f)+"px";a.style.top=b.top-(b.dy?d:-b.height)-25+"px"}else a.style.top="20px",b.dx==1?(a.style.right="auto",a.style.left="-300px",setTimeout(function(){a.style.left=
"-10px"},1)):(a.style.left="auto",a.style.right="-300px",setTimeout(function(){a.style.right="-10px"},1)),a.className=a.className.replace("dhx_qi_left","").replace("dhx_qi_left","")+" dhx_qi_"+(b==1?"left":"right"),gantt._obj.appendChild(a)};
gantt._init_quick_info=function(){if(!this._quick_info_box){var b=this._quick_info_box=document.createElement("div");b.className="dhx_cal_quick_info";gantt.$testmode&&(b.className+=" dhx_no_animate");var a='<div class="dhx_cal_qi_title"><div class="dhx_cal_qi_tcontent"></div><div  class="dhx_cal_qi_tdate"></div></div><div class="dhx_cal_qi_content"></div>';a+='<div class="dhx_cal_qi_controls">';for(var c=gantt.config.quickinfo_buttons,d=0;d<c.length;d++)a+='<div class="dhx_qi_big_icon '+c[d]+'" title="'+
gantt.locale.labels[c[d]]+"\"><div class='dhx_menu_icon "+c[d]+"'></div><div>"+gantt.locale.labels[c[d]]+"</div></div>";a+="</div>";b.innerHTML=a;dhtmlxEvent(b,"click",function(a){a=a||event;gantt._qi_button_click(a.target||a.srcElement)});gantt.config.quick_info_detached&&dhtmlxEvent(gantt.$task_data,"scroll",function(){gantt.hideQuickInfo()})}return this._quick_info_box};
gantt._qi_button_click=function(b){var a=gantt._quick_info_box;if(b&&b!=a){var c=b.className;if(c.indexOf("_icon")!=-1){var d=gantt._quick_info_box_id;gantt.$click.buttons[c.split(" ")[1].replace("icon_","")](d)}else gantt._qi_button_click(b.parentNode)}};
gantt._get_event_counter_part=function(b){for(var a=gantt.getTaskNode(b),c=0,d=0,e=a;e&&e.className!="gantt_task";)c+=e.offsetLeft,d+=e.offsetTop,e=e.offsetParent;var f=this.getScrollState();if(e){var g=c+a.offsetWidth/2-f.x>gantt._x/2?1:0,h=d+a.offsetHeight/2-f.y>gantt._y/2?1:0;return{left:c,top:d,dx:g,dy:h,width:a.offsetWidth,height:a.offsetHeight}}return 0};
gantt._fill_quick_data=function(b){var a=gantt.getTask(b),c=gantt._quick_info_box;gantt._quick_info_box_id=b;var d=c.firstChild.firstChild;d.innerHTML=gantt.templates.quick_info_title(a.start_date,a.end_date,a);var e=d.nextSibling;e.innerHTML=gantt.templates.quick_info_date(a.start_date,a.end_date,a);var f=c.firstChild.nextSibling;f.innerHTML=gantt.templates.quick_info_content(a.start_date,a.end_date,a)};
