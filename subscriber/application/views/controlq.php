<div class="container-fluid">

  <div class="row">

    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-body">

          <div class="row">

            <div class="col-md-6 col-md-offset-3">

              <div class="panel panel-default">

                <div class="panel-heading">
                  <h1 class="text-center queue-num"><strong><?php echo $qnum; ?></strong></h1>
                </div>

                <div class="panel-body">

                  <div class="page-header top-buffer">
                    <h4 class="text-center id-num"><?php echo $idnum; ?></h4>
                  </div>

                  <div class="page-header top-buffer">
                    <h4 class="text-center q-status"><?php echo $status; ?></h4>
                  </div>

                  <!-- <div class="page-header top-buffer">
                    <h4 class="text-center q-status"><?php echo $status; ?></h4>
                  </div> -->

                  <div class="page-header top-buffer">
                    <h4 class="text-center">Deployed:</h4>
                    <h4 class="text-center q-total-sub"><?php echo $dbupdate; ?></h4>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">

                  <div class="col-md-6 col-md-offset-3">
                    <button type="button" class="btn btn-warning btn-pause" >
                      <span class="glyphicon glyphicon-pause btn-pause-glyph"></span>
                    </button>

                    <button type="button" class="btn btn-success btn-next">
                      <span class="glyphicon glyphicon-forward btn-success-glyph"></span>
                    </button>

                    <button type="button" class="btn btn-danger btn-stop" >
                      <span class="glyphicon glyphicon-stop btn-stop-glyph"></span>
                    </button>

                    <?php echo form_open('closeq') ?>
                      <button type="submit" class="btn btn-danger btn-close" href="<?php echo site_url('closeq'); ?>" >
                      <span class="glyphicon glyphicon-remove btn-stop-glyph"></span
                    <?php echo form_close() ?>

                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-body">

        </div>
      </div>
    </div>

  </div>
</div>

<script>

$(document).ready(function(){
  $('.btn-next').click(function(){
    $.ajax({
      type: 'GET',
      url: "<?php echo site_url('nextqueuer'); ?>",
      dataType: 'json',
      error: function () {alert("ajax error")},
      success: function (data) {
        // alert(data['servicenum']);
        // alert(data['idnum']);
        // $.each(data, function(key, value) { alert(key + "=" + value); });
        $('.queue-num').html(data['servicenum']);
        $('.id-num').html(data['idnum']);
      }
    });

    $('.btn-next').attr("disabled", "disabled");
    $('.btn-success-glyph').removeClass("glyphicon glyphicon-forward").addClass("glyphicon glyphicon-ban-circle");
// glyphicon glyphicon-ban-circle
    setTimeout(function() {
      $('.btn-success-glyph').removeClass("glyphicon glyphicon-ban-circle").addClass("glyphicon glyphicon-forward");
      $('.btn-next').removeAttr("disabled");
    }, 3000);

  });

  // glyphicon glyphicon-play
  $('.btn-pause').click(function(){

    if($('.btn-pause-glyph').hasClass('glyphicon glyphicon-pause')){
      $('.btn-pause-glyph').removeClass("glyphicon glyphicon-pause").addClass("glyphicon glyphicon-play");
      //ajax
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
      $('.btn-pause-glyph').removeClass("glyphicon glyphicon-play").addClass("glyphicon glyphicon-pause");
      //ajax
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

  $('.btn-stop').click(function(){

    $.ajax({
      type: 'GET',
      url: "<?php echo site_url('stopq'); ?>",
      dataType: 'json',
      error: function () {alert("ajax error")},
      success: function (data) {
        $('.q-status').html(data);
      }
    });
    // q-total-sub
  });


  var interval = 2000;
  function dbUpdate() {
    $.ajax({
      type: 'GET',
      url: "<?php echo site_url('dbupdate'); ?>",
      dataType: 'json',
      error: function () {alert("ajax error")},
      success: function (data) {
        $('.q-total-sub').html(data);
      },
      complete: function () {
        setTimeout(dbUpdate, interval);
      }
    });
  }

  setTimeout(dbUpdate, interval);
});

// $(document).ready(function(){
//   $('#nextbtn').click(function(){
//     $.ajax({
//       type: 'GET',
//       url: "<?php echo site_url('nextqueuer'); ?>",
//
//       error: function () {},
//       success: function (data) {
//         $('#count').html(data);
//       }
//     });
//
//     $('#nextbtn').attr("disabled", "disabled");
//
//     setTimeout(function() {
//       $('#nextbtn').removeAttr("disabled");
//     }, 3000);
//
//   });
// });

// $('form#feedInput').submit(function(e) {
//
//     var form = $(this);
//
//     e.preventDefault();
//
//     $.ajax({
//         type: "POST",
//         url: "<?php echo site_url('post_feed_item'); ?>",
//         data: form.serialize(), // <--- THIS IS THE CHANGE
//         dataType: "html",
//         success: function(data){
//             $('#feed-container').prepend(data);
//         },
//         error: function() { alert("Error posting feed."); }
//    });
//
// });

</script>
