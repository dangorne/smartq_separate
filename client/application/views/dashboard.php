<div class="container-fluid">

  <div class="row">

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success glyphicon glyphicon-plus" data-toggle="modal" data-target="#createModal"><strong> Create!</strong></button>
            </div>
          </div>
        </div>

        <div class="list-group list-group-class">

        </div>
      </div>
    </div>

    <div class="col-md-4">
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editName" data-toggle="modal" data-target="#nameModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editCode" data-toggle="modal" data-target="#codeModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editSeats" data-toggle="modal" data-target="#seatModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editDesc" data-toggle="modal" data-target="#descModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editReq" data-toggle="modal" data-target="#reqModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editVenue" data-toggle="modal" data-target="#venueModal">
                  <strong> Edit</strong>
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
                <button type="button" class="btn btn-info glyphicon glyphicon-edit pull-right" id="editRest" data-toggle="modal" data-target="#restModal">
                  <strong> Edit</strong>
              </div>

            </div>

            <div class="row top-buffer">
              <div class="col-md-12 top-buffer">
                <p class="buffer" id="detail-rest"></p>
              </div>
            </div>

          </div>

        </div>

          <!-- <h4>Queue Name</h4>
          <p id="detail-qname"></p>

          <h4>Queue Code</h4>
          <p id="detail-code"></p>

          <h4>Seats Offered</h4>
          <p id="detail-seats"></p>

          <h4>Description</h4>
          <p id="detail-desc"></p>

          <h4><button type="button" class="btn btn-default glyphicon glyphicon-edit" data-toggle="modal" data-target="#statusModal">Requirements</h4>
          <p id="detail-req"></p>

          <a href="<?php echo site_url('logout'); ?>"><span class="glyphicon glyphicon-edit"></span> Logout</a>
          <p id="detail-venue"></p>

          <h4>Restriction</h4>
          <p id="detail-rest"></p> -->

        <!-- </div> -->

        <div class="panel-footer content-detail" style="display:none;">
          <div class="btn-group btn-group-lg btn-group-justified" role="group">

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#statusModal">
                <span class="glyphicon glyphicon glyphicon-eye-open"></span>
                Status
              </button>
            </div>
          </div>
          <div class="btn-group btn-group-lg btn-group-justified" role="group">

            <!-- <div class="btn-group" role="group">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">
                <span class="glyphicon glyphicon glyphicon-edit"></span>
                Edit
              </button>
            </div> -->

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-close" >
                <span class="glyphicon glyphicon glyphicon-remove"></span>
                Close
              </button>
            </div>
          </div>
        </div>

      </div>

      <div class="panel panel-default content-create" style="display:none">
        <div class="panel-body content-create" style="display:none">
          <h1 class="text-center">No Queue Created Yet!</h1>
        </div>
        <div class="panel-footer content-create" style="display:none">
          <div class="btn-group btn-group-lg btn-group-justified" role="group">


            <!-- <div class="btn-group" role="group">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#createModal">
                <span class="glyphicon glyphicon glyphicon-plus"></span>
                Create
              </button>
            </div> -->

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
