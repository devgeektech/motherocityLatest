<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Verified Specialist list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Verified Specialist list</a></li>
                            <li class="breadcrumb-item active">Verified Specialist list</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Verified Specialist list</h4>
                       <!--  <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a> -->
                      </div><!-- end card header -->
                        <br>
                        <div class="row">
                          <div class="col-sm-10"></div>
                          
                         </div>
                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-12">
                                    <?= $this->session->getFlashdata('msg'); ?>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle " id="example23">
                                        <thead class="table-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Eamil</th>
                                                <!-- <th>Country</th> -->
                                                <th>Plan Detail</th>
                                                <th>Phone</th>
                                                <th>Expertise</th>
                                                <th>Specialist</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php if ($verified_user): $i = 1; ?>
                                                <?php foreach ($verified_user as $key => $value): ?>
                                                    <tr>
                                                
                                                    <td>#<?= $i; ?></td>
                                                    <td><?= $value['first_name'].' '.$value['last_name']; ?></td>
                                                    <td><?= $value['email']; ?></td>
                                                    <!-- <td><?= $value['country']; ?></td> -->
                                                    <td><?php //$view['plan_id']; 
                                    $plan = $this->common_model->GetSingleData('plan_management',array('id'=>$value['plan_id']));?>
                                    <span class='badge badge-soft-info text-uppercase'><?= $plan['title'];?></span><br>
                                    <?php
                                      if($plan){

                                     'Trial Days: '.$plan['free_trail_days'];
                                      echo "<br>";
                                      }else{?>
                                        <span class='badge badge-soft-danger text-uppercase'>Plan Not Available</span><br>
                                      <?php }
                                     ?>
                                  <?php  
                                   $transaction = $this->common_model->GetSingleData('transaction',array('plan_id'=>$value['plan_id'],'user_id'=>$value['id']),'id','desc');
                                   if($transaction){
                                   echo 'Start Date: '.$transaction['start_date'];echo "<br>";
                                   echo 'End Date: '.$transaction['end_date'];
                                   }
                                   ?></td>
                                                    <td><?= $value['phone_withcode']; ?></td>
                                                    <td><?php //$value['your_expertise']; 
                                                     $experties =  $this->common_model->GetSingleData('specialist_category',array('id'=>$value['your_expertise']),'id','desc');
                                                     echo $experties['title']
                                                    ?></td>
                                                    <td><?php //$value['your_speciality']; 
                                                      $speciality =  $this->common_model->GetSingleData('specialist_category',array('id'=>$value['your_speciality']),'id','desc');
                                                     echo $speciality['title']


                                                    ?></td>
                                                    <td><?php  //$value['phone']; 
                                                        if($value['status'] == 1){ ?>
                                                            <span class="badge badge-soft-success text-uppercase">Active</span>
                                                        <?php }else{ ?>

                                                          <span class="badge badge-soft-danger text-uppercase">Blocked</span>
                                                      <?php  }

                                                    ?></td>
                                                    <td><?php if ($value['status'] == 0): ?>
                                                        <div class="remove">
                                                            <button onclick="enable_user(<?= $value['id'] ?>)" class="btn btn-sm btn-success remove-item-btn" >Unblock</button>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="remove">
                                                            <button onclick="enable_user(<?= $value['id'] ?>)" class="btn btn-sm btn-danger remove-item-btn" >Block</button>
                                                        </div>
                                                        <?php endif ?>
                                                         <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
                                                        <a href="<?= base_url() ?>/admin/specialist-profile/<?= $value['id'];?>" class="btn btn-success btn-sm">Profile Detail</a>
                                                    </td>
                                                    </tr>
                                                
                                                <?php $i++; endforeach ?>
                                            <?php endif ?>    
                                        </tbody>
                                    </table> 
                                
                                    <div class="noresult" style="display: <?= ($verified_user) ? 'none' : 'block' ?>">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="#">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            
            <!-- Modal -->
            
            <!--end modal -->
        </div>
        <!-- container-fluid -->
    </div>
    <?php include 'include/footer.php'; ?>
   
<script type="text/javascript">

function enable_user(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
          url: '<?= base_url() ?>/Admin/Users/enableUser',
          type: 'POST',
          cache:false,
          data:{'id':id},
          dataType: 'json',
          beforeSend: function() {
            $('#del_btn').prop('disabled' , true);
            // $('#del_btn').text('Processing..');
          },
          success : function(res){
            if (res.status == 1) {
              window.location.reload();
            }
            else
            {
              $('#result').html(res.msgs)
            }
          }
        });
    }
}

function deleteRow(id) {
    if(confirm('Are you sure ?')){
      $.ajax ({
          url: '<?= base_url()?>/Admin/Users/deleteUser',
          data: {id:id},
          type: 'POST',
          dataType:'json',
          beforeSend: function() {        
              $('#delbtn'+id).prop('disabled' , true);
              $('#delbtn'+id).text('Processing..');
            },
          success: function(result){
              $('#delbtn'+id).prop('disabled' , false);
              $('#delbtn'+id).text('Add');
              if(result.status == 1)
              {
              //  Swal.fire({
              //  title: "Success", 
              //  text: result.message, 
              //  icon: "success"
              //    }).then(function (result) {
                window.location.reload();
                // })   
              }
          }
          });
    }
}
</script>
