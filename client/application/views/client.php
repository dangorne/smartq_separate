
<script>

$(document).ready(function(){

  // $('.content-detail').show();
  var create_input = {};

  var listfetch = function(){
    // alert('oi');
      $.ajax({
       url: "<?php echo site_url('fetchlist'); ?>",
       method: "POST",
       dataType: "text",
       success:function(data){
         $('.list-group-class').html(data);

         var listGroup = $(".list-group-class .list-qname").filter(function() {
              return $(this).text() == selected_list;
          }).closest(".list-group-item");

        // alert(listGroup.find('.list-qname').text());
         if(listGroup.find('.list-qname').text() != ''){

           listGroup.addClass('list-group-item-success');
         }else{
           selected_list = null;
         }

        //  $(this).addClass('list-group-item-success').siblings().removeClass('list-group-item-success');
         //
        //  selected_list=$(this).find('.list-qname').text();

       },
       error:function(){
         alert("ajax error");
       },
     });
   }

   listfetch();

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
      },
      error:function(){
       alert("ajax error");
      },
    });
  }

  q_status();

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
          $('.content-create').show();
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

  $('.content-detail').on('click', '.btn-close', function(){
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

  // var interval = 5000;
  // function dbUpdate() {
  //   $.ajax({
  //     type: 'GET',
  //     url: "<?php echo site_url('dbupdate'); ?>",
  //     dataType: 'json',
  //     error: function () {alert("ajax error")},
  //     success: function (data) {
  //       $('.q-total-sub').html(data);
  //     },
  //     complete: function () {
  //       setTimeout(dbUpdate, interval);
  //     }
  //   });
  // }
  //
  // setTimeout(dbUpdate, interval);

});

</script>
