
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">


      <form class="form-sample" action="<?=BASE_URL;?>/accountant/update" method="post">
        <div class="row">
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Budget Application</h4>
                    <p class="card-description">
                      <code>Fill the form details for budget application</code>
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Create Date</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?=date("d-m-Y", strtotime($this->budget[0]->create_dated));?>" disabled>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Update Date</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php if(!empty($this->budget[0]->update_dated)) { ?><?=date("d-m-Y", strtotime($this->budget[0]->update_dated));?><?php } ?>" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Application Title <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="txt_title" name="txt_title" value="<?=$this->budget[0]->title;?>" required>
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
                            <input type="text" class="form-control" id="txt_justify" name="txt_justify" data-toggle="tooltip" data-placement="bottom" title="Why need the budget" value="<?=$this->budget[0]->justify;?>" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Budget Type <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <select class="form-control" id="txt_budgettype" name="txt_budgettype" required>
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
                            <select class="form-control" id="txt_usagetype" name="txt_usagetype" required>
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
                                                <input class="form-control" type="text" id="txt_item" name="txt_item[]" value="<?=$value->name;?>" required>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type[]" required>
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
                                                <select class="form-control" id="txt_justification" name="txt_justification[]" required>
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
                																<input class="form-control" type="number" id="txt_price" name="txt_price[]" value="<?=$value->price;?>" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="number" id="txt_qty" name="txt_qty[]" value="<?=$value->qty;?>" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement">UoM <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_uom" name="txt_uom[]" value="<?=$value->uom;?>" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Total(RM)</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_total" name="txt_total[]" value="<?=$value->total;?>" readonly>
                															</div>
                														</div>
                														<div class="col-md-1">
                															<label class="col-form-label">&nbsp;</label>
                															<div class="form-group">
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon delete">
                                                  <i class="typcn typcn-times"></i>
                                                </button>
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
                                                <input class="form-control" type="text" id="txt_item" name="txt_item[]" value="" required>
                															</div>
                														</div>
                														<div class="col-md-2">
                															<label class="col-form-label">Type <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_type" name="txt_type[]" required>
                                                  <option value="">Please Select</option>
                                                  <option value="Asset">Asset</option>
                                                  <option value="Service">Service</option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Justification <span class="text-danger">*</span></label>
                															<div>
                                                <select class="form-control" id="txt_justification" name="txt_justification[]" required>
                                                  <option value=""></option>
                                                </select>
                															</div>
                														</div>
                                            <div class="col-md-2">
                															<label class="col-form-label">Price/unit(RM)<span class="text-danger">*</span></label>
                															<div>
                																<input class="form-control" type="number" id="txt_price" name="txt_price[]" value="0" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="number" id="txt_qty" name="txt_qty[]" value="0" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement">UoM <span class="text-danger">*</span></label>
                															<div>
                                                <input class="form-control" type="text" id="txt_uom" name="txt_uom[]" value="" data-toggle="tooltip" data-placement="bottom" title="Unit of Measurement" required>
                															</div>
                														</div>
                                            <div class="col-md-1">
                															<label class="col-form-label">Total(RM)</label>
                															<div>
                                                <input class="form-control" type="text" id="txt_total" name="txt_total[]" value="0" readonly>
                															</div>
                														</div>
                														<div class="col-md-1">
                															<label class="col-form-label">&nbsp;</label>
                															<div class="form-group">
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon delete">
                                                  <i class="typcn typcn-times"></i>
                                                </button>
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
                                    <div class="text-right">
                                      <button type="button" class="btn btn-warning btn-rounded btn-fw add-item"><i class="typcn typcn-plus"></i> Add Item</button>
                                    </div>
                  </div>
                </div>
              </div>
        </div>

        <div class="col-12 grid-margin text-center">
          <input type="hidden" class="form-control" id="txt_budget_id" name="txt_budget_id" value="<?=$this->budget[0]->budget_id;?>" required>
          <button type="submit" class="btn btn-primary btn-icon-text">
              <i class="typcn typcn-document btn-icon-prepend"></i>
                Submit
          </button>

        </div>
      </div>
    </form>
      <!-- content-wrapper ends -->
