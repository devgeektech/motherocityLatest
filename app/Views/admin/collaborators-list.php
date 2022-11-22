<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Collaborators list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Collaborators list</a></li>
                            <li class="breadcrumb-item active">Collaborators list</li>
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
                        <h4 class="card-title mb-0">Collaborators list</h4>
                      </div><!-- end card header -->
                      <br>
                         <div class="row">
                          <div class="col-sm-10"></div>
                          <div class="col-sm-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Collaborators</button>
                           </div>
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
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php if ($collaborators): $i = 1; ?>
                                                <?php foreach ($collaborators as $key => $value): ?>
                                                    <tr>
                                                
                                                    <td>#<?= $i; ?></td>
                                                    <td><?= $value['name']; ?></td>
                                                    <td><?= $value['email']; ?></td>
                                                    <td><?= $value['phone']; ?></td>
                                                    <td>
                                                        <?php                                           $role_name = $this->common_model->GetSingleData('roles',array('id'=>$value['role_id'])); 
                                                        if($role_name){ echo $role_name['name']; } ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#passwordModal<?= $value['id']; ?>">Change Password</button>
                                                        <button class="btn btn-danger btn-sm" onclick="return deleteRow(<?= $value['id']; ?>)">delete</button>
                                                    </td>

<!-- my code -->

<div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header bg-light p-3">
                <h4 class="modal-title p-0">Edit Collaborators</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
                  
            <!-- Modal body -->
            <form id="editsub" method="post" action="#" onsubmit="return editSub(this , <?= $value['id']; ?>)" >
                <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $value['name']; ?>" placeholder="Name" required>
                            <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" value="<?= $value['email']; ?>" class="form-control" placeholder="Email" name="email"  readonly>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="tel" class="form-control" value="<?= $value['phone']; ?>" placeholder="Phone" name="phone"  required>
                        </div>
                        <div>
                            <label>Role</label>
                            <select class="form-control" name="role_id" required>
                                <option value="">---Select---</option>
                                <?php $roles = $this->common_model->GetAllData('roles','','id','desc'); ?>
                                <?php if($roles) : ?>
                                <?php foreach($roles as $role) : ?>
                                    <?php if($role['id'] == $value['role_id']) { ?>
                                    <?php $selected = 'selected'; ?>
                                    <?php } else { ?>
                                    <?php $selected = ''; ?>
                                    <?php }  ?>
                                    <option <?=$selected?> value="<?=$role['id']?>"><?=$role['name']?></option>
                                <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>                    
                         
                    <div class="mt-3 modal-footer">
                        <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                    </div>
                          
                </div>
            </form>
        </div>
        
                  
    </div>
</div>
<div class="modal" id="passwordModal<?= $value['id']; ?>">                 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header bg-light p-3">
                <h4 class="modal-title p-0">Change Password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
                  
            <!-- Modal body -->
            <form id="editsub" method="post" action="#" onsubmit="return changePass(this , <?= $value['id']; ?>)" >
                <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password"  placeholder="New Password" required>
                            <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="cnfm_password"  required>
                        </div>
                    </div>                    
                         
                    <div class="mt-3 modal-footer">
                        <button type="submit"  id="change<?= $value['id']; ?>" class="btn btn-success">Update</button>
                    </div>
                          
                </div>
            </form>
        </div>
        
                  
    </div>
</div>


    <!-- my code -->                                                        
                                                    </tr>
                                                
                                                <?php $i++; endforeach ?>
                                            <?php endif ?>    
                                        </tbody>
                                    </table> 
                                
                                    <div class="noresult" style="display: <?= ($collaborators) ? 'none' : 'block' ?>">
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
<div class="modal" id="addModal">                 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                
        <!-- Modal Header -->
            <div class="modal-header bg-light p-3">
                <h4 class="modal-title p-0">Add Collaborators</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
                  
            <!-- Modal body -->
            <form method="post" onsubmit="return addSub(event)" id="addSub" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email"  required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password"  required>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="tel" class="form-control" placeholder="Phone" name="phone"  required>
                        </div>
                        <div>
                            <label>Role</label>
                            <select class="form-control" name="role_id" required>
                                <option value="">---Select---</option>
                                <?php $roles = $this->common_model->GetAllData('roles','','id','desc'); ?>
                                <?php if($roles) : ?>
                                <?php foreach($roles as $role) : ?>
                                    <option value="<?=$role['id']?>"><?=$role['name']?></option>
                                <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>                     
                         
                    <div class="mt-3 modal-footer">
                        <button type="submit"  id="update" class="btn btn-success">Add</button>
                    </div>
                          
                </div>
            </form>                  
        </div>
    </div>
</div>
   

<script type="text/javascript">
    function addSub(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addSub')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Collaborators/addSubadmin',
              data: data,
              processData: false,
              contentType: false,
              type: 'POST',
        dataType:'json',
        beforeSend: function() {        
            $('#update').prop('disabled' , true);
            $('#update').text('Processing..');
          },
              success: function(result){
            $('#update').prop('disabled' , false);
            $('#update').text('Add');
            if(result.status == 1)
            {
            //  Swal.fire({
            //    title: "Success", 
            //    text: result.message, 
            //    icon: "success"
            //  }).then(function (result) {
            window.location.reload();
            // })    
            }
            else
            {
              console.log(result.message);
              for (var err in result.message) {
            
              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
              }
            }
        }
        });
    return false;
  } 
 function editSub(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Collaborators/editSubadmin',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($(el)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#update'+id).prop('disabled' , true);
        $('#update'+id).text('Processing..');
      },
      success : function(res){
        $('#update'+id).prop('disabled' , false);
        $('#update'+id).text('Update');
        if (res.status == 1) {
            
            window.location.reload();
            
        }
        else
        {
         
          $('#result1').html(res.message);
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}
 function changePass(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Collaborators/changePassword',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($(el)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#change'+id).prop('disabled' , true);
        $('#change'+id).text('Processing..');
      },
      success : function(res){
        $('#change'+id).prop('disabled' , false);
        $('#change'+id).text('Update');
        if (res.status == 1) {
            
            window.location.reload();
            
        }
        else
        {
         
          $('#result1').html(res.message);
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}

function deleteRow(id) {
    if(confirm('Are you sure ?')){
      $.ajax ({
          url: '<?= base_url()?>/Admin/Collaborators/deleteSubadmin',
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
              
                window.location.reload();  
              
          }
          });
    }
}


</script>
