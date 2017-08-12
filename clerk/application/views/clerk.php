<script type="text/javascript" language="javascript" >
  var selected_list
  var selected_table
  var panel_toggle
 $(document).ready(function(){

   var fetch_table = function() {

    var txt = $('#q-search-txt').val();

    if(txt == ''){

      $.ajax({
        url: "<?php echo site_url('fetchsearch'); ?>",
        method: "POST",
        dataType: "text",
        success:function(data){
          $('#q-tbl-body').html(data);

          var tableRow = $("#q-tbl-body td").filter(function() {
              return $(this).text() == selected_table;
          }).closest("tr");

         if(tableRow.find('td:first').text() != ''){

           tableRow.addClass('success');
         }else{
           selected_table = null;
         }
       },
        error:function(){
          alert("ajax error");
        },
      });

    }else{

      $.ajax({
        url: "<?php echo site_url('fetchsearch'); ?>",
        method: "POST",
        data: {search:txt},
        dataType: "text",
        success:function(data){

          $('#q-tbl-body').html(data);

          var tableRow = $("#q-tbl-body td").filter(function() {
              return $(this).text() == selected_table;
          }).closest("tr");

         if(tableRow.find('td:first').text() != ''){

           tableRow.addClass('success');
         }else{
           selected_table = null;
         }

        },
        error:function(){
          alert("ajax error");
        },
      });
    }
  }

  fetch_table();

  var fetchqueuers = function(){
    $.ajax({
      url: "<?php echo site_url('fetchqueuers'); ?>",
      method: "POST",
      data: {selected:selected_table},
      dataType: "text",
      success:function(data){
        $('#q-tbl-queuer-body').html(data);
      },
      error:function(){
        alert("ajax error");
      },
    });
  };

  $.ajax({
    url: "<?php echo site_url('fetchsearch'); ?>",
    method: "POST",
    dataType: "text",
    success:function(data){
      $('#q-tbl-body').html(data);
    },
    error:function(){
      alert("ajax error");
    },
  });

   $('#q-search-txt').keyup(function(){

      var txt = $(this).val();
      if(txt == ''){

        $.ajax({
          url: "<?php echo site_url('fetchsearch'); ?>",
          method: "POST",
          dataType: "text",
          success:function(data){
            $('#q-tbl-body').html(data);

            var tableRow = $("#q-tbl-body td").filter(function() {
                return $(this).text() == selected_table;
            }).closest("tr");

           if(tableRow.find('td:first').text() != ''){

             tableRow.addClass('success');
           }else{
             selected_table = null;
           }
          },
          error:function(){
            alert("ajax error");
          },
        });

      }else{

        $.ajax({
          url: "<?php echo site_url('fetchsearch'); ?>",
          method: "POST",
          data: {search:txt},
          dataType: "text",
          success:function(data){

            $('#q-tbl-body').html(data);

            var tableRow = $("#q-tbl-body td").filter(function() {
                return $(this).text() == selected_table;
            }).closest("tr");

           if(tableRow.find('td:first').text() != ''){

             tableRow.addClass('success');
           }else{
             selected_table = null;
           }

          },
          error:function(){
            alert("ajax error");
          },
        });
      }
    });

   $('.btn-join').click(function(){

      if(selected_table != null){
        $.ajax({
         type: "POST",
         url: "<?php echo site_url('joinselected'); ?>",
         data: {selected: selected_table},
         dataType: "json",
         success:function(data){

           if(data.res == "ONGOING"){
             fetchqueuers();
           }else{
             alert("You can't join. The queue is paused.")
           }
         },
         error:function(){
           alert("ajax error");
         },
       });
     }
    });

    $('#q-tbl-body').on('click', 'tr', function(){
      $(this).not(".head").addClass('success').siblings().removeClass('success');
      // alert("clicked");
      selected_table=$(this).find('td:first').text();
      fetchqueuers();
    });

    $(".panel-body-toggle").hide();

      var interval = 5000;
    function dbUpdate() {

      fetch_table();
      setTimeout(dbUpdate, interval);
    }

    setTimeout(dbUpdate, interval);
  });
 </script>
