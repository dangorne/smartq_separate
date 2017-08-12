<script type="text/javascript" language="javascript" >
  var selected_list
  var selected_list_ref
  var selected_table
  var selected_table_ref
  var panel_toggle
 $(document).ready(function(){

   var init = function(){
     $('.text-title').html("No Queue Selected");
     $('.text-status').html("");
     $('.text-current').html("#");
     $('.text-last').html("#");
     $('.text-self').html("#");
     $('.text-desc').html("");
     $('.text-rest').html("");
     $('.text-req').html("");
     $('.text-venue').html("");
   }

   init();

   var listfetch = function(){
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
            // alert(tableRow.text());
           if(tableRow.find('td:first').text() != ''){
            //  alert("yes");
             tableRow.addClass('success');
           }else{
              selected_table = null;
           }

          //  alert(tableRow.find('td:first').text());

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

          //  if(tableRow.text()){
            //  alert(tableRow.text());
           if(tableRow.find('td:first').text() != ''){
            //  alert("yes");
             tableRow.addClass('success');
           }else{
             selected_table = null;
           }
          //  }else{
          //    alert("no");
          //  }
          //  tableRow.addClass('success');
         },
         error:function(){
           alert("ajax error");
         },
       });
     }
   }

   $('#q-search-txt').keyup(function(){

      var txt = $(this).val();
      if(txt == ''){

        $.ajax({
          url: "<?php echo site_url('fetchsearch'); ?>",
          method: "POST",
          dataType: "text",
          success:function(data){
            $('#q-tbl-body').html(data);

            if(tableRow.find('td:first').text() != ''){
             //  alert("yes");
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
            if(tableRow.find('td:first').text() != ''){
             //  alert("yes");
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

    $('.btn-leave').click(function(){
      // alert("leave clicked!");
      // alert(selected_table);
       if(selected_list != null){

         $.ajax({
          type: "POST",
          url: "<?php echo site_url('leave'); ?>",
          data: {selected: selected_list},
          dataType: "json",
          success:function(data){

             if(data.res == "NOTINQUEUE"){
               alert("You have not joined this queue!");
             }else if(data.res == "LEFT"){
               listfetch();
               init();
               $(".panel-body-toggle").hide();
               $(".footer").hide();
               alert("You have left the queue!");
             }else{
               alert("An error occured.")
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

            if(data.res == "EXIST"){
              alert("You are already in the queue!");
            }else if(data.res == "ONGOING"){
              listfetch();
              // fetch_table();
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
      // selected_table_ref=$(this);
      // alert(selected_table_ref);
    });



    $('.list-group-class').on('click', '.list-selected', function(){

      $(this).addClass('list-group-item-success').siblings().removeClass('list-group-item-success');

      selected_list=$(this).find('.list-qname').text();
      // alert(selected_list);
      $(".panel-body-toggle").show();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('listselected'); ?>",
        data: {selected: selected_list},
        dataType: "json",
        success:function(data){

          $('.text-title').html(data.queue_name);
          $('.text-status').html(data.status);
          $('.text-current').html(data.serving_atNo);
          $('.text-last').html(data.total_deployNo);
          $('.text-self').html(data.self);
          $('.text-desc').html(data.queue_description);
          $('.text-rest').html(data.queue_ristriction);
          $('.text-req').html(data.requirements);
          $('.text-venue').html(data.venue);
          // $('.footer').html(data.btn);
          $('.footer').show();

        },
        error:function(){
          alert("ajax errors");
        },
      });
    });


    $(".panel-body-toggle").hide();


  var interval = 5000;
  function dbUpdate() {

    listfetch();
    fetch_table();
    setTimeout(dbUpdate, interval);
  }

  setTimeout(dbUpdate, interval);

  });
 </script>
