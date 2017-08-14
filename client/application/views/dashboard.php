<div class="container-fluid">

  <div class="row">

    <div class="col-md-4 col-md-offset-4">

      <div class="panel panel-default panel-qlist" style="display:none;">
        <div class="panel-heading">
          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success glyphicon glyphicon-plus" data-toggle="modal" data-target="#createModal"><strong> Create!</strong></button>
            </div>
          </div>
        </br>

          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-info btn-join" ><span class="glyphicon glyphicon-circle-arrow-down"></span> Join!</button>
            </div>
            <!-- <div class="btn-group" role="group">
              <button type="button" class="btn btn-danger btn-leave glyphicon glyphicon-remove"><strong> Leave!</strong></button>
            </div> -->
          </div>

        </div>

        <div class="list-group list-group-class">

        </div>
      </div>

      <div class="panel panel-default content-detail" style="display:none;">

        <!-- <div class="panel-body content-detail" style="display:none;"> -->

        <div class="list-group">
        <!-- <div class="list-group list-group-class"> -->
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Queue Name</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editName" data-toggle="modal" data-target="#nameModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                  <!-- <strong> Edit</strong> -->
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-qname"></p>
              </div>
            </div>

          </div>

          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Queue Code</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editCode" data-toggle="modal" data-target="#codeModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-code"></p>
              </div>
            </div>

          </div>

          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Seats Offered</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editSeats" data-toggle="modal" data-target="#seatModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-seats"></p>
              </div>
            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Description</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editDesc" data-toggle="modal" data-target="#descModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-desc"></p>
              </div>
            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Requirements</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editReq" data-toggle="modal" data-target="#reqModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-req"></p>
              </div>
            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Venue</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editVenue" data-toggle="modal" data-target="#venueModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-venue"></p>
              </div>
            </div>

          </div>
          <div class="list-group-item">

            <div class="row">
              <div class="col-md-6">
                <h4 class="buffer">Restriction</h4>
              </div>

              <div class="col-md-6">
                <button type="button" class="btn btn-info pull-right" id="editRest" data-toggle="modal" data-target="#restModal"><span class="glyphicon glyphicon-edit"></span> Edit</button>
              </div>

            </div>

            <div class="row top-buffer">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-rest"></p>
              </div>
            </div>

          </div>

        </div>

        <div class="panel-footer content-detail" style="display:none;">
          <div class="btn-group btn-group-lg btn-group-justified" role="group">

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-status" data-toggle="modal" data-target="#statusModal">
                <span class="glyphicon glyphicon glyphicon-stats"></span>
                Status
              </button>
            </div>
          </div>

          </br>

          <div class="btn-group btn-group-lg btn-group-justified" role="group">
            <div class="btn-group" role="group">
            <button type="button" class="btn btn-info btn-close" >
                <span class="glyphicon glyphicon-alert"></span>
                Close
              </button>
            </div>
          </div>

        </br>

        <div class="btn-group btn-group-lg btn-group-justified" role="group">
          <div class="btn-group" role="group">
          <button type="button" class="btn btn-danger btn-leave" >
              <span class="glyphicon glyphicon-share-alt"></span>
              Leave
            </button>
          </div>
        </div>

        </div>

      </div>

    </div>

    <div class="col-md-4">
      <div class="panel panel-default">

        <div class="panel-heading">
          <label for="displayname">Display Name</label>
          <input type="text" id="q-search-txt" name="displayname" class="form-control" placeholder="Name" aria-describedby="sizing-addon1">
          </br>
          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <a href="<?php echo site_url('windowrio'); ?>"  target="_blank" role="button" class="btn btn-info btn-join glyphicon glyphicon-new-window"> Display</a>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
