
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

        <div class="row">

          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">History Application</h4>
                  <div class="">
                    <div class="dropdown text-right mb-2">
                      <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Filter
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <h6 class="dropdown-header">Display</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list">All</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?status=Approved">Status: Approved</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?status=Waiting">Status: Waiting</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?status=Rejected">Status: Reject</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">Budget Type</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?type=OCAR">OCAR</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?type=BM">BM</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">GL Type</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?GL=Asset">Asset</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/bursary/list?GL=Service">Service</a>
                      </div>
                    </div>
                    <table class="table table-striped">
                      <thead>
                        <tr class="table-info">
                          <th class="text-center">#</th>
                          <th class="text-center" style="width:20%;">Work ID/Title</th>
                          <th class="text-center">Justification</th>
                          <th class="text-center">Grand Total(RM)</th>
                          <th class="text-center">Application Date</th>
                          <th class="text-center">Status Application</th>
                          <!--<th class="text-center">Status Approval From Dean</th>
                          <th class="text-center">Status Approval From Bursary</th>-->
                          <!--<th class="text-center">Action</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($this->budgetlist): ?>
                          <?php $no = 1; ?>
                          <?php $work_id = ''; ?>
                          <?php foreach ($this->budgetlist as $value): ?>
                            <?php if($value->work_id != $work_id):
                              $work_id = $value->work_id;
                            ?>
                              <tr>
                                <td class="text-center"><?=$no++;?></td>
                                <td><b><span class="text-primary"><?=$value->name;?> (<?=$value->work_id;?>)</span><br/><?=$value->title;?><b/></td>
                                <td class="text-center"><?=$value->justify;?></td>
                                <td class="text-center"><?=$value->fulltotal;?></td>
                                <td class="text-center"><?=date("d-m-Y", strtotime($value->create_dated));?></td>
                                <td class="text-center">
                                  <?php if($value->status == 'Not Approved'): ?>
                                    <span class="text-danger"><?=$value->status;?></span>
                                  <?php elseif($value->status == 'Approved'): ?>
                                    <span class="text-success"><?=$value->status;?></span>
                                  <?php else: ?>
                                    <?=$value->status;?>
                                  <?php endif;?>
                                  <?php if(!empty($value->dean_approve_dated)): ?>
                                    <br/><br/><br/>
                                    <?php if($value->status_dean == 'Approved'): ?>
                                      <?='DEAN: <span class="text-success">'.$value->status_dean;?></span><br/>
                                    <?php elseif($value->status_dean == 'Rejected'): ?>
                                      <?='DEAN: <span class="text-danger">'.$value->status_dean;?></span><br/>
                                    <?php endif;?>
                                    <?=date("d-m-Y", strtotime($value->dean_approve_dated));?>
                                  <?php endif;?>
                                  <?php if(!empty($value->bursary_approve_dated)): ?>
                                    <br/><br/><br/>
                                    <?php if($value->status_dean == 'Approved'): ?>
                                      <?='BURSARY: <span class="text-success">'.$value->status_bursary;?></span><br/>
                                    <?php elseif($value->status_dean == 'Rejected'): ?>
                                      <?='BURSARY: <span class="text-danger">'.$value->status_bursary;?></span><br/>
                                    <?php endif;?>
                                    <?=date("d-m-Y", strtotime($value->bursary_approve_dated));?>
                                  <?php endif;?>
                                </td>
                                <!--<td class="text-right">
                                  <div class="d-flex align-items-right">
                                    <?php if(empty($value->status_dean)): ?>
                                    <a href="<?=BASE_URL;?>/bursary/edit?id=<?=$value->budget_id;?>" class="btn btn-success btn-sm btn-icon-text mr-3"><i class="typcn typcn-edit btn-icon-append"></i></a>
                                    <a href="<?=BASE_URL;?>/bursary/delete?id=<?=$value->budget_id;?>" class="btn btn-danger btn-sm btn-icon-text mr-3"><i class="typcn typcn-trash btn-icon-append"></i></a>
                                  <?php endif; ?>
                                  </div>

                                </td>-->
                              </tr>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>

      </div>
      <!-- content-wrapper ends -->
