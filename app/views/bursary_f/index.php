
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

        <div class="row">
          <div class="col-xl-12 grid-margin stretch-card flex-column">
              <h5 class="mb-2 text-titlecase mb-4">Statistics Application</h5>
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Application By Years</h4>
                    <canvas id="barChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Application By Monthly</h4>
                    <canvas id="barChart2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Application By Faculty</h4>
                    <canvas id="barChart3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total Amount By Monthly</h4>
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <table id="tbl-barchart" style="display:none;">
         <tbody>
            <tr>
               <th>head1</th>
               <th>head2</th>
            </tr>
            <?php if($this->years): ?>
              <?php foreach ($this->years as $year): ?>
                <tr>
                   <td><?=$year->years;?></td>
                   <td><?=$year->total;?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
         </tbody>
        </table>

      <table id="tbl-monthly" style="display:none;">
       <tbody>
          <tr>
             <th>head1</th>
             <th>head2</th>
          </tr>
          <?php if($this->month): ?>
            <?php foreach ($this->month as $month): ?>
              <tr>
                 <td><?=date("M", strtotime(date('Y').'-'.$month->month.'-01')).' '.date('Y');?></td>
                 <td><?=$month->total;?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
       </tbody>
      </table>

    <table id="tbl-faculty" style="display:none;">
     <tbody>
        <tr>
           <th>head1</th>
           <th>head2</th>
        </tr>
        <?php if($this->faculty): ?>
          <?php foreach ($this->faculty as $faculty): ?>
            <tr>
               <td><?=$faculty->centre_code;?></td>
               <td><?=$faculty->total;?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
     </tbody>
    </table>

    <table id="tbl-amount" style="display:none;">
     <tbody>
        <tr>
           <th>head1</th>
           <th>head2</th>
        </tr>
        <?php if($this->amounts): ?>
          <?php foreach ($this->amounts as $amount): ?>
            <tr>
              <td><?=date("M", strtotime(date('Y').'-'.$amount->month.'-'.date('d'))).' '.date('Y');?></td>
              <td><?=$amount->total;?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
     </tbody>
    </table>

      </div>
      <!-- content-wrapper ends -->
