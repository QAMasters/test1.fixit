<?php

$xheader = '
<link href="'.base_url().'assets/plugins/iCheck/custom.css" rel="stylesheet">
<link href="'.base_url().'assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
<link href="'.base_url().'assets/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" media="print">
<link href="'.base_url().'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">

';
$xfooter='
<script src="'.base_url().'assets/plugins/dataTables/datatables.min.js"></script>
<script src="'.base_url().'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="'.base_url().'assets/plugins/fullcalendar/moment.min.js"></script>

<!-- jQuery UI  -->
<script src="'.base_url().'assets/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Full Calendar -->
<script src="'.base_url().'assets/plugins/fullcalendar/fullcalendar.min.js"></script>

<script src="'.base_url().'assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
';
include 'header.php';
?>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $this->lang->line('calendar');?></h5>                    
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<!-- Mainly scripts -->
<?php
include 'footer.php';
?>

</body>

</html>

<!-- Localized -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add_calendar_event');?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url("calendar/add_event"), array("class" => "form-horizontal")) ?>
      <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('event_name');?></label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="name" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('description');?></label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="description">
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('start_date');?></label>
            <div class="col-md-8">
                <input size="16" type="text" readonly class="start_datetime form-control" name="start_date" value="<?php echo date("Y-m-d h:m"); ?>">
                <small><?php echo $this->lang->line('date_format');?> YYYY/MM/DD HH:MM</small>
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('end_date');?></label>
            <div class="col-md-8">
                <input size="16" type="text" readonly class="end_datetime form-control" name="end_date" value="<?php echo date("Y-m-d h:m"); ?>">
                <small><?php echo $this->lang->line('date_format');?> YYYY/MM/DD HH:MM</small>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('add_event');?>">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('update_calendar_event');?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url("calendar/edit_event"), array("class" => "form-horizontal")) ?>
      <div class="form-group">
        <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('event_name');?></label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="name" value="" id="name">
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('description');?></label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="description" id="description">
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('start_date');?></label>
            <div class="col-md-8">
                <!--<input type="text" class="form-control" name="start_date" id="start_date">-->
                <input size="16" type="text" readonly class="start_datetime form-control" name="start_date" id="start_date">
                <small><?php echo $this->lang->line('date_format');?> YYYY/MM/DD HH:MM</small>
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('end_date');?></label>
            <div class="col-md-8">
                <!--<input type="text" class="form-control" name="end_date" id="end_date">-->
                <input size="16" type="text" readonly class="end_datetime form-control" name="end_date" id="end_date">
                <small><?php echo $this->lang->line('date_format');?> YYYY/MM/DD HH:MM</small>
            </div>
        </div>
        <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading"><?php echo $this->lang->line('delete_event');?></label>
            <div class="col-md-8">
                <input type="checkbox" name="delete" value="1">
            </div>
        </div>
            <input type="hidden" name="eventid" id="event_id" value="0" />
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('update_event');?>">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(".start_datetime").datetimepicker({
    format: 'yyyy-mm-dd hh:ii',
    //startDate: "2017-10-14 10:00",
    autoclose: true
});
</script>

<script type="text/javascript">
$(".start_datetime").change(function(){
    $('.end_datetime').datetimepicker('remove');
    var s_date = this.value;
    $(".end_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        startDate: s_date,
        autoclose: true
    });
});
</script>

<script type="text/javascript">
    $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
</script>

<script type="text/javascript">
$(document).ready(function() {
    var date_last_clicked = null;

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        droppable: true,
        drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
        eventSources: [
           {
           events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '<?php echo base_url() ?>calendar/get_events',
                    dataType: 'json',
                    data: {
                        // our hypothetical feed requires UNIX timestamps
                        start: start.unix(),
                        end: end.unix()
                    },
                    success: function(msg) {
                        var events = msg.events;
                        callback(events);
                    }
                });
              }
            },
        ],
        dayClick: function(date, jsEvent, view) {
            date_last_clicked = $(this);
            $(this).css('background-color', '#bed7f3');
            $('#addModal').modal();
        },
       eventClick: function(event, jsEvent, view) {
          $('#name').val(event.title);
          $('#description').val(event.description);
          $('#start_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
          if(event.end) {
            $('#end_date').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
          } else {
            $('#end_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
          }
          $('#event_id').val(event.id);
          $('#editModal').modal();
       },
    });
});
</script>