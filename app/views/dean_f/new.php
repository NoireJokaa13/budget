
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

        <div class="row">

          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Application From Faculty</h4>
                  <div class="">
                    <div class="dropdown text-right mb-2">
                      <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Filter
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <h6 class="dropdown-header">Display</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new">All</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new?status=waiting">Status: Waiting</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">Budget Type</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new?type=OCAR">OCAR</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new?type=BM">BM</a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">GL Type</h6>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new?GL=Asset">Asset</a>
                        <a class="dropdown-item" href="<?=BASE_URL;?>/dean/new?GL=Service">Service</a>
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
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($this->budgetlist): ?>
                          <?php $no = 1; ?>
                          <?php $work_id = ''; ?>
                          <?php foreach ($this->budgetlist as $value): ?>
                              <tr>
                                <td class="text-center"><?=$no++;?></td>
                                <td><b><span class="text-primary"><?=$value->name;?> (<?=$value->work_id;?>)</span><br/><?=$value->title;?><b/></td>
                                <td class="text-center"><?=$value->justify;?></td>
                                <td class="text-center"><?=$value->fulltotal;?></td>
                                <td class="text-center"><?=date("d-m-Y", strtotime($value->create_dated));?></td>
                                <td class="text-center"><?=$value->status;?></td>
                                <td class="text-right">
                                  <div class="d-flex align-items-right">
                                    <?php if(empty($value->status_dean)): ?>
                                    <a href="<?=BASE_URL;?>/dean/edit?id=<?=$value->budget_id;?>" class="btn btn-success btn-sm btn-icon-text mr-3"><i class="typcn typcn-edit btn-icon-append"></i></a>
                                  <?php endif; ?>
                                  </div>

                                </td>
                              </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                    <?php if(!empty($this->pagination)): $this->view($this->pagination); endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </div>

      </div>
      <!-- content-wrapper ends -->
