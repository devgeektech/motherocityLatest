<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Incoming Specialist list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Incoming Specialist list</a></li>
                            <li class="breadcrumb-item active">Incoming Specialist list</li>
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
                        <h4 class="card-title mb-0">Incoming Specialist list</h4>
                      </div><!-- end card header -->
                      <br>
                         <div class="row">
                          <div class="col-sm-10"></div>
                          <div class="col-sm-2">
                            <!-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Specialist</button> -->
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
                                                <th>Eamil</th>
                                                <!-- <th>Country</th> -->
                                                <th>Phone</th>
                                                <th>Expertise</th>
                                                <th>Specialist</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php if ($incoming_user): $i = 1; ?>
                                                <?php foreach ($incoming_user as $key => $value): ?>
                                                    <tr>
                                                
                                                    <td>#<?= $i; ?></td>
                                                    <td><?= $value['first_name'].' '.$value['last_name']; ?></td>
                                                    <td><?= $value['email']; ?></td>
                                                    <!-- <td><?= $value['country']; ?></td> -->
                                                    <td><?= $value['phone_withcode']; ?></td>
                                                    <td><?php //$value['your_expertise']; 
                                                     $experties =  $this->common_model->GetSingleData('specialist_category',array('id'=>$value['your_expertise']),'id','desc');
                                                     echo $experties['title']
                                                    ?></td>
                                                    <td><?php //$value['your_speciality']; 
                                                      $speciality =  $this->common_model->GetSingleData('specialist_category',array('id'=>$value['your_speciality']),'id','desc');
                                                     echo $speciality['title']


                                                    ?></td>
                                                    
                                                    <td>
                                                        <button class="btn btn-sm btn-success" id="verify_accept_btn" onclick="verify_accept(<?= $value['id'] ?>)">Accept</button>
                                                   
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#myModal<?= $value['id'] ?>" id="">Reject</button>
                                                      <!--   <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button> -->
                                                        <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
                                                        <a href="<?= base_url() ?>/admin/specialist-profile/<?= $value['id'];?>" class="btn btn-success btn-sm">Profile Detail</a>
<div class="modal fade" id="myModal<?= $value["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" onsubmit="return verify_reject('<?php echo $value['id']; ?>',event);" id="verify_reject<?php echo $value["id"]; ?>" >
            <div class="modal-body">
                    <div class="form-group">
                        <label>Reason</label>
                        <textarea class="form-control" rows="5"
                            placeholder="Enter Reason" name="reason" id="reason<?= $value["id"]; ?>"></textarea>
                        <input type="hidden" name="id" value="<?= $value["id"]; ?>" />
                        
                    </div>
             </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" id="verify_reject_btn<?= $value["id"]; ?>" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- my code -->

    <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Specialist</h4>
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
                            <label>Specialist Category</label>
                            <select class="form-control editcategory-dropdown" name="category">
                              <option value="">---Select----</option>
                              <?php
                                foreach($specialist_category as $CatVal):
                              ?>
                                 <option <?= ($value['specialist_category'] == $CatVal['id'])? 'Selected':''; ?> value="<?= $CatVal['id']; ?>"><?= $CatVal['title']; ?></option>

                              <?php
                               endforeach
                              ?>
                            </select>
                        </div>

                        <div >
                            <label>Specialist SubCategory</label>
                            <select class="form-control editsub-category" name="subcategory">
                              <option value="">---Select----</option>
                              <?php
                                $subcat = $this->common_model->GetAllData('specialist_category',array('parent'=>$value['specialist_category']),'id','desc');
                                foreach ($subcat as $key => $subcatV) {
                                  ?>
                                  <option <?= ($value['specialist_subcategory']==$subcatV['id'])?'Selected':''; ?> value="<?= $subcatV['id']; ?>"><?= $subcatV['title']; ?></option>
                                <?php
                              }
                              ?>
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

                                                        
                                                    </td>  
                                                    </tr>    
                                                <?php $i++; endforeach ?>
                                            <?php endif ?>    
                                        </tbody>
                                    </table> 
                                
                                    <div class="noresult" style="display: <?= ($incoming_user) ? 'none' : 'block' ?>">
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
                    <h4 class="modal-title p-0">Add Specialist</h4>
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
                            <label>Specialist Caegory</label>
                            <select class="form-control category-dropdown"  name="category" required="">
                              <option value="">---Select----</option>
                              <?php
                              foreach ($specialist_category as $key => $CatV) {
                                ?>
                                <option value="<?= $CatV['id']; ?>"><?= $CatV['title']; ?></option>
                              <?php
                              }
                            ?>
                            </select>
                        </div>
                        <div >
                            <label>Specialist SubCategory</label>
                            <select class="form-control sub-category" name="subcategory">
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

function verify_accept(id) {
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Users/verifyAccept',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#verify_accept_btn'+id).prop('disabled' , true);
        $('#verify_accept_btn'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#verify_accept_btn'+id).prop('disabled' , false);
        if (res.status == 1) {
        //    Swal.fire({
        //        title: "User has been verified successfully", 
        //        text: res.message, 
        //        icon: "success"
        //      }).then(function (result) {
                location.href = "<?= base_url() ?>/admin/incoming_user";
            // })
        }
        
      }
    });
    }
    
}

function verify_reject(id, e) {
     e.preventDefault();
      var reason=  $("#reason"+id).val()
      if(reason.trim()==''){
        alert ("Reason field is required");
        return false;
      }
   
        $.ajax({
      url: '<?= base_url() ?>/Admin/Users/verifyReject',
      type: 'POST',
      cache:false,
      data:{'id':id,'reason':reason},
      dataType: 'json',
      beforeSend: function() {
        $('#verify_reject_btn'+id).prop('disabled' , true);
        $('#verify_reject_btn'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#verify_reject_btn'+id).prop('disabled' , false);
        if (res.status == 1) {
        //    Swal.fire({
        //        title: "User has been rejected successfully", 
        //        text: res.message, 
        //        icon: "success"
        //      }).then(function (result) {
                location.href = "<?= base_url() ?>/admin/incoming_user";
            // })
        }
        
       }
      });
   
    
}


</script>

<script type="text/javascript">
    function addUser(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addUser')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Users/addUser',
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
      url: '<?= base_url() ?>/Admin/Users/editUser',
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
  $(document).ready(function() {
    $('.category-dropdown').on('change', function() {
        var category_id = $(this).val();
        //alert(category_id);
        $.ajax({
            url: "<?= base_url()?>/Admin/Users/fetch_subcat",
            type: "POST",
            data: {
                category_id: category_id
            },
            cache: false,
            success: function(result) {
                // $("#sub-category").empty();
                $(".sub-category").html(result);
              
            }
        });
    });
});
</script>
<script>
  $(document).ready(function() {
    $('.editcategory-dropdown').on('change', function() {
        var category_id = $(this).val();
        //alert(category_id);
        $.ajax({
            url: "<?= base_url()?>/Admin/Users/fetch_editsubcat",
            type: "POST",
            data: {
                category_id: category_id
            },
            cache: false,
            success: function(result) {
                // $("#sub-category").empty();
                $(".editsub-category").html(result);
              
            }
        });
    });
});
</script>
