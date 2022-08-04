
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">


      <form class="form-sample" action="<?=BASE_URL;?>/dean/update" method="post">
        <div class="row">
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Application Review</h4>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Application Date</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?=date("d-m-Y", strtotime($this->budget[0]->create_dated));?>" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Application Title <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="txt_title" name="txt_title" value="<?=$this->budget[0]->title;?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" data-toggle="tooltip" data-placement="bottom" title="Why need the budget">Justification <span class="text-danger">*</span>
                            <p class="card-description ts-10">
                            Why need the budget
                            </p>
                          </label>

                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="txt_justify" name="txt_justify" data-toggle="tooltip" data-placement="bottom" title="Why need the budget" value="<?=$this->budget[0]->justify;?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Budget Type <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <select class="form-control" id="txt_budgettype" name="txt_budgettype" readonly>
                              <option value="">Please Select</option>
                              <option value="OCAR" <?php if($this->budget[0]->budget_type == 'OCAR') { echo 'selected'; }?>>OCAR</option>
                              <option value="BM" <?php if($this->budget[0]->budget_type == 'BM') { echo 'selected'; }?>>BM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Usage Type <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <select class="form-control" id="txt_usagetype" name="txt_usagetype" readonly>
                              <option value="">Please Select</option>
                              <option value="Procurement" <?php if($this->budget[0]->usage_type == 'Procurement') { echo 'selected'; }?>>Procurement</option>
                              <option value="Payment" <?php if($this->budget[0]->usage_type == 'Payment') { echo 'selected'; }?>>Payment</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Item Details</h4>
                      <!--<p class="card-description">
                        <code>Fill the form details for budget application</code>
                      </p>-->

                      <table id="item-add" style="width:100%;">
                                <tbody>
                                  <?php if(!empty($this->items)): ?>
                                  <?php foreach ($this->items as $value): ?>
                											<tr class="list-item">
                												<td>
                													<div class="row">
                														<div class="col-md-2">
                															<label class="col-form-label">Item Name <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_item" name="txt_item[]" value="<?=$value->name;?>" readonly>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type[]" readonly>
                                                  <option value="">Please Select</option>
                                                  <option value="Asset" <?php if($value->type == 'Asset') { echo 'selected'; } ?>>Asset</option>
                                                  <option value="Service" <?php if($value->type == 'Service') { echo 'selected'; } ?>>Service</option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Justification <span class="text-danger">*</span></label>
                															<div>
                                                <?php
                                                  $New = $Replace = $Maintenance = $Training = $Consultation = $Honorarium = $Reimbursement = '';
                                                  if($value->justification == 'New') {
                                                    $New = "selected";
                                                  }
                                                  if($value->justification == 'Replace') {
                                                    $Replace = "selected";
                                                  }
                                                  if($value->justification == 'Maintenance') {
                                                    $Maintenance = "selected";
                                                  }
                                                  if($value->justification == 'Training') {
                                                    $Training = "selected";
                                                  }
                                                  if($value->justification == 'Consultation') {
                                                    $Consultation = "selected";
                                                  }
                                                  if($value->justification == 'Honorarium') {
                                                    $Honorarium = "selected";
                                                  }
                                                  if($value->justification == 'Reimbursement') {
                                                    $Reimbursement = "selected";
                                                  }

                                                  $assets = '<option value="New" '.$New.'>New Purchase</option><option value="Replace" '.$Replace.'>Replace Old Asset</option>';
                                                  $services = '<option value="Maintenance" '.$Maintenance.'>Maintenance</option><option value="Training" '.$Training.'>Training</option><option value="Consultation" '.$Consultation.'>Consultation</option><option value="Honorarium" '.$Honorarium.'>Honorarium</option><option value="Reimbursement" '.$Reimbursement.'>Reimbursement</option>';

                                                 ?>
                                                <select class="form-control" id="txt_justification" name="txt_justification[]" readonly>
                                                  <option value="">Please Select</option>
                                                  <?php if($value->type == 'Asset'): ?>
                                                    <?=$assets;?>
                                                  <?php elseif($value->type == 'Service'): ?>
                                                    <?=$services;?>
                                                  <?php endif; ?>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Price/unit(RM) <span class="text-danger">*</span></label>
                															<div>
                																<input class="form-control" type="number" id="txt_price" name="txt_price[]" value="<?=$value->price;?>" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="number" id="txt_qty" name="txt_qty[]" value="<?=$value->qty;?>" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement">UoM <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_uom" name="txt_uom[]" value="<?=$value->uom;?>" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Total(RM)</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_total" name="txt_total[]" value="<?=$value->total;?>" readonly>
                															</div>
                														</div>
                													</div>
                												</td>
                											</tr>
                                      <?php endforeach; ?>
                                    <?php else: ?>
                                      <tr class="list-item">
                												<td>
                													<div class="row">
                														<div class="col-md-2">
                															<label class="col-form-label">Item Name <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_item" name="txt_item[]" value="" readonly>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type[]" readonly>
                                                  <option value="">Please Select</option>
                                                  <option value="Asset">Asset</option>
                                                  <option value="Service">Service</option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Justification <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_justification" name="txt_justification[]" readonly>
                                                  <option value=""></option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Price/unit(RM)<span class="text-danger">*</span></label>
                															<div>
                																<input class="form-control" type="number" id="txt_price" name="txt_price[]" value="0" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="number" id="txt_qty" name="txt_qty[]" value="0" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement">UoM <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_uom" name="txt_uom[]" value="" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement" readonly>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Total(RM)</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_total" name="txt_total[]" value="0" readonly>
                															</div>
                														</div>
                													</div>
                												</td>
                											</tr>
                                    <?php endif;?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th>
                                          <div class="row">
                                            <div class="col-md-10 text-right"><label class="col-form-label">Total</label></div>
                														<div class="col-md-1 align-items-center justify-content-end">
                															<div class="form-group">
                                                <input class="form-control" type="text" id="txt_fulltotal" name="txt_fulltotal" value="<?=$this->budget[0]->fulltotal;?>" readonly>
                															</div>
                                            </div>
                                        </th>
                                      </tr>
                                    </tfoot>
                										</table>
                  </div>
                </div>
              </div>
        </div>

        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Approval Application</h4>
                  <p class="card-description">
                    <code>Application approved/reject</code>
                  </p>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Status Application <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                          <select class="form-control" id="txt_status_dean" name="txt_status_dean">
                            <option value="">Please Select</option>
                            <option value="Approved">Approve</option>
                            <option value="Rejected">Reject</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Remark (if application reject)</label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="txt_remark_dean" name="txt_remark_dean" rows="4"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>

        <div class="col-12 grid-margin text-center">
          <input type="hidden" class="form-control" id="txt_budget_id" name="txt_budget_id" value="<?=$this->budget[0]->budget_id;?>" readonly>
          <button type="submit" class="btn btn-primary btn-icon-text">
              <i class="typcn typcn-document btn-icon-prepend"></i>
                Submit
          </button>

        </div>
      </div>
    </form>
      <!-- content-wrapper ends -->
