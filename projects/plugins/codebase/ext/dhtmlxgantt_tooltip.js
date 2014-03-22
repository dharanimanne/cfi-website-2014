/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
gantt._tooltip={};gantt._tooltip_class="gantt_tooltip";gantt.config.tooltip_timeout=30;gantt._create_tooltip=function(){if(!this._tooltip_html)this._tooltip_html=document.createElement("div"),this._tooltip_html.className=gantt._tooltip_class;return this._tooltip_html};
gantt._show_tooltip=function(a,b){if(!gantt.config.touch||gantt.config.touch_tooltip){var c=this._create_tooltip();c.innerHTML=a;gantt.$task_data.appendChild(c);var d=c.offsetWidth+20,f=c.offsetHeight+40,g=this.$task.offsetHeight,h=this.$task.offsetWidth,e=this.getScrollState();b.x+=e.x;b.y+=e.y;b.y=Math.min(Math.max(e.y,b.y),e.y+g-f);b.x=Math.min(Math.max(e.x,b.x),e.x+h-d);c.style.left=b.x+"px";c.style.top=b.y+"px"}};
gantt._hide_tooltip=function(){this._tooltip_html&&this._tooltip_html.parentNode&&this._tooltip_html.parentNode.removeChild(this._tooltip_html);this._tooltip_id=0};gantt._is_tooltip=function(a){var b=a.target||a.srcElement;return gantt._is_node_child(b,function(a){return a.className==this._tooltip_class})};gantt._is_task_line=function(a){var b=a.target||a.srcElement;return gantt._is_node_child(b,function(a){return a==this.$task_data})};
gantt._is_node_child=function(a,b){for(var c=!1;a&&!c;)c=b.call(gantt,a),a=a.parentNode;return c};gantt._tooltip_pos=function(a){if(a.pageX||a.pageY)var b={x:a.pageX,y:a.pageY};var c=_isIE?document.documentElement:document.body,b={x:a.clientX+c.scrollLeft-c.clientLeft,y:a.clientY+c.scrollTop-c.clientTop},d=gantt._get_position(gantt.$task);b.x-=d.x;b.y-=d.y;return b};
gantt.attachEvent("onMouseMove",function(a,b){if(this.config.tooltip_timeout){document.createEventObject&&!document.createEvent&&(b=document.createEventObject(b));var c=this.config.tooltip_timeout;if(this._tooltip_id&&!a&&!isNaN(this.config.tooltip_hide_timeout))c=this.config.tooltip_hide_timeout;clearTimeout(gantt._tooltip_ev_timer);gantt._tooltip_ev_timer=setTimeout(function(){gantt._init_tooltip(a,b)},c)}else gantt._init_tooltip(a,b)});
gantt._init_tooltip=function(a,b){if(!this._is_tooltip(b)&&(a!=this._tooltip_id||this._is_task_line(b))){if(!a)return this._hide_tooltip();this._tooltip_id=a;var c=this.getTask(a),d=this.templates.tooltip_text(c.start_date,c.end_date,c);d||this._hide_tooltip();this._show_tooltip(d,this._tooltip_pos(b))}};gantt.attachEvent("onMouseLeave",function(a){gantt._is_tooltip(a)||this._hide_tooltip()});gantt.templates.tooltip_date_format=gantt.date.date_to_str("%Y-%m-%d");
gantt.templates.tooltip_text=function(a,b,c){return"<b>Task:</b> "+c.text+"<br/><b>Start date:</b> "+gantt.templates.tooltip_date_format(a)+"<br/><b>End date:</b> "+gantt.templates.tooltip_date_format(b)};
