<?php
//index.php
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Events</title>
  <link href="../css/fullcalendar.css"      rel="stylesheet"  />
  <link href="../css/bootstrap.css"         rel="stylesheet" />
  <!--link href='../css/coremain.css'          rel='stylesheet'-->
  <link href='../css/daygrid.css'           rel='stylesheet'>
  <link href='../css/timegridmain.css'      rel='stylesheet'>
  <link href='../css/listmain.css'          rel='stylesheet'>
  <link href='../css/bootstrap4main.css'    rel='stylesheet'>
  <link href='../css/all.css'               rel='stylesheet'>
  <link href='../css/bootstrap.min.css'     rel='stylesheet' />
  
  
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-ui.min.js"></script>    
  <script src="../js/moment.min.js"></script>
  <script src="../js/fullcalendar.min.js"></script>
  <script src="../js/coremain.min.js"></script>
  <script src="../js/daygridmain.min.js"></script>
  <script src="../js/timegridmain.min.js"></script>
  <script src="../js/bootstrap4.min.js"></script>
  <script src="../js/daygridmain.min.js"></script>

  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    plugins : [ 'bootstrap' ],
    themeSystem : 'bootstrap' ,
    editable:true,
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
        
        var title = prompt("What's The Title ?");
        //var details = prompt("Say Something About it..");
        if(title)
        {
            var member_id = 2;
            var charges = 2000;
             
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            $.ajax({
                url:"insert.php",
                type:"POST",
                data: {mem_id:member_id, date_of_booking:start, start_time:start, end_time:end, fun_details:title, charges:charges},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Added Successfully \n Now set starting time and Ending Time from Week or Day Tab");
                }
            })
        }
    },
    editable:true,
    eventResize:function(event)
    {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
            url :   "update.php",
            type:   "POST",
            data:   {title:title, start:start, end:end, id:id},
            success:    function() 
            {
                calendar.fullCalendar('refetchEvents');
                alert('Event Update');
            }
        })
    },

    eventDrop:function(event)
    {
        var mem_id = 1;
        var start   = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end     = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title   = event.title;
        var id      = event.id;
        $.ajax({
            url:"update.php",
            type:"POST",
            data:{title:title, start:start, end:end, id:id, mem_id:mem_id},
            success:function(data)
            {
                calendar.fullCalendar('refetchEvents');
                alert(data);//"Event Updated");
            }
        });
    },

    eventClick:function(event)
    {   
        var id = event.id;
        $.ajax({
                url     : "eventDetails.php",
                type    : "POST",
                data    : {id:id},
                success : function(data)
                {
                    var earr = data.split(",");
                    var title = earr[0];
                    var eventday = earr[1].substr(0,10);
                    var starttime = earr[1].substr(10,8);
                    var endtime = earr[2].substr(10,8);
                    var place = earr[3];

                    var html =  " <b>Hosted By :</b> " + "" + "<br>" +
                                " <b>Event is :</b> " + title + "<br>" +
                                " <b>Date :</b> " + eventday + "<br>" +
                                " <b>Starts at :</b> " + starttime + "<br>" +
                                " <b>Ends at :</b> " + endtime + "<br>" +
                                " <b>Place :</b> " + place ;
                    document.getElementById('eventdetails').innerHTML = "<div>" + html +"</div>";
                    
                }
            })

        //document.getElementById("eventdetails").innerHTML = "kjgshkahbdck";
        /*
        if(confirm("Are you sure you want to remove it?"))
        {
            var id = event.id;
            $.ajax({
                url     : "delete.php",
                type    : "POST",
                data    : {id:id},
                success : function()
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Removed");
                }
            })
        }
        */
    },
    
   });
  });
   
</script>
</head>
<body>
<div class="wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 ">
            <h1>Event Booking</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Event Details</h4>
                </div>
                <div class="card-body" id="eventdetails">
                  <!-- the events -->
                  <h3>Click on an event to see its details</h3>
                </div>
                <!-- /.card-body -->
              </div>              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div  id="calendar" ></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
</body>
</html>

