<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Moms list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Moms list</a></li>
                            <li class="breadcrumb-item active">Moms list</li>
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
                        <h4 class="card-title mb-0">Moms list</h4>
                      </div><!-- end card header -->
                      <br>
                         <div class="row">
                          <div class="col-sm-10"></div>
                          <div class="col-sm-2">
                           <!--  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Mom</button> -->
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
                                                <th width="5%"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Bulk Delete</button></th>

                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Eamil</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Account Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php if ($moms): $i = 1; ?>
                                                <?php foreach ($moms as $key => $value): ?>
                                                    <tr>
                                                <td><input type="checkbox" class="delete_checkbox" value=<?= $value['id']; ?> /></td>
                                                    <td>#<?= $i; ?></td>
                                                    <td><?= $value['name']; ?></td>
                                                    <td><?= $value['email']; ?></td>
                                                    <td><?= $value['phone_withcode']; ?></td>
                                                    <td><?php  //$value['phone']; 
                                                        if($value['status'] == 1){ ?>
                                                            <span class="badge badge-soft-success text-uppercase">Active</span>
                                                        <?php }else{ ?>

                                                          <span class="badge badge-soft-danger text-uppercase">Blocked</span>
                                                      <?php  }

                                                    ?></td>
                                                    <td><?php  //$value['phone']; 
                                                        if($value['is_deactive'] == 1){ ?>
                                                            <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                                                        <?php }else{ ?>

                                                          <span class="badge badge-soft-success text-uppercase">Live</span>
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
                                                      <!--   <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button> -->
                                                         <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
                                                        <a href="<?= base_url() ?>/admin/mom-profile/<?= $value['id'];?>" class="btn btn-success btn-sm">Profile Detail</a>
                                                    </td>

<!-- my code -->

    <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Mom</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form id="editUser" method="post" action="#" onsubmit="return editUser(this , <?= $value['id']; ?>)" >
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                         <div>
                          <label>First Name</label>
                          <input type="text" class="form-control" name="first_name" required value="<?= $value['first_name']; ?>">
                          <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                        </div>
                        <div>
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="last_name" required value="<?= $value['last_name']; ?>">
                        </div>

                        <div>
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" required value="<?= $value['email']; ?>">
                        </div>

                        <div>
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" required value="<?= $value['password']; ?>">
                        </div>
                        <div>
                          <label>Phone</label>
                          <input type="number" min="0" class="form-control" name="phone" required value="<?= $value['phone']; ?>">
                        </div>
                        <div>
                          <label>Phone With Code</label>
                          <input type="number" min="0" class="form-control" name="phone_withcode"  required value="<?= $value['phone_withcode']; ?>">
                        </div>
                        <div>
                          <label>Country</label>
                          <input type="text" class="form-control" name="country" required value="<?= $value['country']; ?>">
                        </div>
                        <div>
                          <label>Birth Type</label>
                            <select class="form-control" name="birth_type" required>
                              <option value="">---Select---</option>
                              <?php
                                foreach ($birth_type as $key => $birth) {
                              ?>
                                 <option <?= ($value['birth_type_id']==$birth['id'])? 'Selected':'' ?> value="<?= $birth['id']; ?>"><?= $birth['title']; ?></option>
                              <?php  } ?>

                            </select>
                        </div>
                     
                         
                        <div class="mt-3 modal-footer">
                            <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                        </div>
                          
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
                                
                                    <div class="noresult" style="display: <?= ($moms) ? 'none' : 'block' ?>">
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
                    <h4 class="modal-title p-0">Add Mom</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form method="post" onsubmit="return addUser(event)" id="addUser" enctype="multipart/form-data">
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>First Name</label>
                          <input type="text" class="form-control" name="first_name"  required>
                        </div>
                        <div>
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="last_name"  required>
                        </div>

                        <div>
                          <label>Email</label>
                          <input type="email" class="form-control" name="email"  required>
                        </div>

                        <div>
                          <label>Password</label>
                          <input type="password" class="form-control" name="password"  required>
                        </div>
                        <div>
                          <label>PhoneCode</label>
                          <input type="number" min="0" class="form-control" name="phone_code"  required>
                        </div>
                        <div>
                          <label>Phone</label>
                          <input type="number" min="0" class="form-control" name="phone"  required>
                        </div>
                        <div>
                          <label>Country</label>
                          <input type="text" class="form-control" name="country"  required>
                        </div>
                        <div>
                          <label>Birth Type</label>
                            <select class="form-control" name="birth_type" required>
                              <option value="">---Select---</option>
                              <?php
                                foreach ($birth_type as $key => $birth) {
                              ?>
                                 <option value="<?= $birth['id']; ?>"><?= $birth['title']; ?></option>
                              <?php  } ?>

                            </select>
                        </div>
                     
                         
                     <div class="mt-3 modal-footer">
                        <button type="submit"  id="update" class="btn btn-success">Add</button>
                    </div>
                          
                          </div>
                     </div>
                  </form>
                  
                </div>
              </div>
            </div>
   
<script type="text/javascript">

function enable_user(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
          url: '<?= base_url() ?>/Admin/Users/enableMom',
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

</script>
<script type="text/javascript">
    function addUser(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addUser')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Users/addMom',
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
 function editUser(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Users/editMom',
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
<script>
$(document).ready(function(){
 
 $('.delete_checkbox').click(function(){
  if($(this).is(':checked'))
  {
   $(this).closest('tr').addClass('removeRow');
  }
  else
  {
   $(this).closest('tr').removeClass('removeRow');
  }
 });

 $('#delete_all').click(function(){ 
  var checkbox = $('.delete_checkbox:checked'); 
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({  
    url:"<?= base_url()?>/Admin/Admin/delete_all",
    method:"POST",
    dataType: 'json', 
    data:{checkbox_value:checkbox_value},
    success:function(result)
    { 
      alert("Data deleted successfully.");  
      window.location.reload(); 
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
</script>