
<script>

$(document).ready(function(){

  // $('.content-detail').show();
  var create_input = {};
  var selected_list

  $('#editName').click(function(){
    $('#new-name').val($('#detail-qname').text());
  });

  $('#editCode').click(function(){
    $('#new-code').val($('#detail-code').text());
  });

  $('#editSeats').click(function(){
    $('#new-seats').val($('#detail-seats').text());
  });

  $('#editDesc').click(function(){
    $('#new-desc').val($('#detail-desc').text());
  });

  $('#editReq').click(function(){
    $('#new-req').val($('#detail-req').text());
  });

  $('#editVenue').click(function(){
    $('#new-venue').val($('#detail-venue').text());
  });

  $('#editRest').click(function(){
    $('#new-rest').val($('#detail-rest').text());
  });

  $('#save-name').click(function(){

    // alert($('#new-name').val());
    $.ajax({
      url: "<?php echo site_url('editdetail'); ?>",
      method: "POST",
      data: {type:"name", content:$('#new-name').val()},
      dataType: "json",
      success:function(data){
        // alert(data);
      },
      error:function(){
       alert("ajax errorx");
      },
    });
  });

  var q_list = function(){

    $.ajax({
     url: "<?php echo site_url('fetchlist'); ?>",
     method: "GET",
     dataType: "text",
     success:function(data){
       $('.list-group-class').html(data);
       $('.panel-qlist').show();
     },
     error:function(){
       alert("ajax error");
     },
   });
  }

  var q_status = function(){
    $.ajax({
      url: "<?php echo site_url('load_status'); ?>",
      method: "GET",
      dataType: "json",
      success:function(data){
         $('.queue-num').html(data['qnum']);
         $('.id-num').html(data['idnum']);
         $('.q-status').html(data['qstatus']);
         $('.q-total-sub').html(data['totalsub']);

         if(data['qstatus'] == 'PAUSED'){

           if($('.btn-pause-glyph').hasClass('glyphicon glyphicon-pause')){
             $('.btn-pause').removeClass("btn-warning").addClass("btn-info");
             $('.btn-pause-glyph').removeClass("glyphicon glyphicon-pause").addClass("glyphicon glyphicon-play");
           }
         }

         if(data['qstatus'] == 'ONGOING'){

           if($('.btn-pause-glyph').hasClass('glyphicon glyphicon-play')){
             $('.btn-pause').removeClass("btn-info").addClass("btn-warning");
             $('.btn-pause-glyph').removeClass("glyphicon glyphicon-play").addClass("glyphicon glyphicon-pause");
           }
         }
      },
      error:function(){
       alert("ajax error");
      },
    });
  }

  var q_detail = function(){
    $.ajax({
      url: "<?php echo site_url('load_detail'); ?>",
      method: "GET",
      dataType: "json",
      success:function(data){

        if(data['display'] == 'true'){
          $('#detail-qname').html(data['qname']);
          $('#detail-code').html(data['code']);
          $('#detail-seats').html(data['seats']);
          $('#detail-desc').html(data['desc']);
          $('#detail-req').html(data['req']);
          $('#detail-venue').html(data['venue']);
          $('#detail-rest').html(data['rest']);
          $('.content-detail').show();
        }else{
          q_list();
        }

      },
      error:function(data){
       alert("ajax error");
      },
    });
  }

  q_detail();

  $('.btn-create').click(function(){

    input = {
      name:$('#create-name').val(),
      code:$('#create-code').val(),
      seat:$('#create-seat').val(),
      desc:$('#create-desc').val(),
      req:$('#create-req').val(),
      venue:$('#create-venue').val(),
      rest:$('#create-rest').val()
    };

    $.ajax({
       url: "<?php echo site_url('createq'); ?>",
       method: "POST",
       data: {input: input},
       dataType: "text",
       success:function(data){
         if(data){
           q_detail();
         }else{
           alert("Queue cannot be closed!")
         }
       },
       error:function(){
         alert("ajax error");
       },
     });
  });

  $('.btn-join').click(function(){

    if(selected_list){
      $.ajax({
         url: "<?php echo site_url('joinq'); ?>",
         method: "POST",
         data: {selected: selected_list},
         dataType: "text",
         success:function(data){
           if(data){
             q_detail();
             $('.panel-qlist').hide();
           }else{
             alert("Queue cannot be closed!")
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
    }else{
      alert("You must choose a queue!");
    }

  });


  $('.btn-leave').click(function(){

     $.ajax({
      type: "GET",
      url: "<?php echo site_url('leave'); ?>",
      dataType: "json",
      success:function(data){

        if(data['success']){
          $('.content-detail').hide();
          $('.panel-qlist').show();
          q_list();
        }
      },
      error:function(){
        alert("ajax error");
      },
    });

  });

  $('.btn-status').click(function(){
    q_status();
  });

  $('.btn-close').click(function(){
    $.ajax({
       url: "<?php echo site_url('closeq'); ?>",
       method: "GET",
       success:function(data){
          q_status();
       },
       error:function(){
          alert("ajax error");
       },
     });
  });

  $('.btn-next').click(function(){
    $.ajax({
      type: 'GET',
      url: "<?php echo site_url('nextqueuer'); ?>",
      dataType: 'json',
      error: function () {alert("ajax error")},
      success: function (data) {

        $('.queue-num').html(data['servicenum']);
        $('.id-num').html(data['idnum']);
      }
    });

    $('.btn-next').attr("disabled", "disabled");
    $('.btn-success-glyph').removeClass("glyphicon glyphicon-forward").addClass("glyphicon glyphicon-ban-circle");

    setTimeout(function() {
      $('.btn-success-glyph').removeClass("glyphicon glyphicon-ban-circle").addClass("glyphicon glyphicon-forward");
      $('.btn-next').removeAttr("disabled");
    }, 3000);

  });

  $('.btn-pause').click(function(){

    if($('.btn-pause-glyph').hasClass('glyphicon glyphicon-pause')){
      $(this).removeClass("btn-warning").addClass("btn-info");
      $('.btn-pause-glyph').removeClass("glyphicon glyphicon-pause").addClass("glyphicon glyphicon-play");

      $.ajax({
        type: 'GET',
        url: "<?php echo site_url('pauseq'); ?>",
        dataType: 'json',
        error: function () {alert("ajax error")},
        success: function (data) {
          $('.q-status').html(data);
        }
      });
    }else{
      $(this).removeClass("btn-info").addClass("btn-warning");
      $('.btn-pause-glyph').removeClass("glyphicon glyphicon-play").addClass("glyphicon glyphicon-pause");

      $.ajax({
        type: 'GET',
        url: "<?php echo site_url('resumeq'); ?>",
        dataType: 'json',
        error: function () {alert("ajax error")},
        success: function (data) {
          $('.q-status').html(data);
        }
      });
    }
  });

  $('.list-group-class').on('click', '.list-selected', function(){

      $(this).addClass('list-group-item-success').siblings().removeClass('list-group-item-success');

      selected_list=$(this).find('.list-qname').text();
    });

  var interval = 5000;
  function dbUpdate() {

    if($('.panel-qlist').is(":visible")){

      q_list();
    }

    if($('.content-detail').is(":visible")){

      q_status();
    }
    setTimeout(dbUpdate, interval);
  }

  setTimeout(dbUpdate, interval);

});

</script>
