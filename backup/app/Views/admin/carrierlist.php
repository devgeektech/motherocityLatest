<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Carrier</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Carrier</a></li>
                            <li class="breadcrumb-item active">Carrier</li>
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
                        <h4 class="card-title mb-0">Carrier list</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div id="customerList">
                                <?= $this->session->getFlashdata('msg'); ?>
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal" id="add_btns">Add</button>
                                    </div>
                                 
                                </div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="example23">
                                        <thead class="table-light">
                                            <tr>
                                               <th>S.No</th>
                                                <th>Title</th>
                                                <th>Added By</th>
                                                <th>Created At</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($data): $i = 1; ?>
                                            <?php foreach ($data as $key => $value): ?>
                                                <tr>
                                                
                                                <td><?= $i; ?></td>
                                                <td><?= $value['title'] ?></td>
                                                <td><?php //$value['user_id'] 
                                                  if($value['user_id'] == 0)
                                                  {
                                                    echo "Admin";
                                                  }else
                                                  {
                                                    $userdata = $this->common_model->GetSingleData('users', array('id'=> $value['user_id']));
                                                    echo $userdata['first_name']." ".$userdata['last_name'];
                                                  }


                                                ?></td>
                                                <td><?= humanDate($value['created_at']) ?></td>
                                                
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
              <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Carrier</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form id="edit_carrier" method="post" action="#" onsubmit="return edit_carrier(this , <?= $value['id']; ?>)" >
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>Title</label>
                          <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title" placeholder="Carrier">
                          <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                          <p id="result1"></p>
                        </div>
                      


                        <div class="mt-3 text-center">
                            <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                        </div>
                          
                          </div>
                     </div>
                  </form>
                  
                </div>
              </div>
            </div>
                          </div>
                          
                          <div class="remove">
                              <button class="btn btn-danger" id="delete_btns" onclick="delete_carrier(<?= $value['id'] ?>)">Delete</button>
                          </div>
                                   
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach ?>
                  
                  <?php endif ?>    
                    </tbody>
                </table> 
                                
                      <div class="noresult" style="display: <?= ($data) ? 'none' : 'block' ?>">
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
    <div class="modal" id="myModal">                 
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
              
                <!-- Modal Header -->
                 <div class="modal-header bg-light p-3">
                  <h4 class="modal-title">Add Carrier</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                
                <!-- Modal body -->
                <form id="add_carrier" method="post" action="#" onsubmit="return add_carrier()" >
                     <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>Title</label>
                            <input type="text" class="form-control"  name="title"  placeholder="Carrier">
                        </div>
                       
                        <div class="mt-3 text-center">
                            <button type="submit" id="add_btn"  class="btn btn-success">Add</button>
                        </div>
                        
                    </div>
                </div>
                </form>
                
                
              </div>
            </div>
          </div>
    <?php include 'include/footer.php'; ?>
    <script type="text/javascript">
        function add_carrier() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Carrier/addcarrier',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_carrier')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#add_btn').prop('disabled' , true);
        $('#add_btn').text('Processing..');
      },
      success : function(res){
        $('#add_btn').prop('disabled' , false);
        $('#add_btn').text('Add');
        if (res.status == 1) {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })         
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;    
}
function edit_carrier(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Carrier/editcarrier',
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
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            window.location.reload();
            })         
        }
        else
        {
         
          $('#result1').html(res.message);
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;    
}

function delete_carrier(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Carrier/deletecarrier',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
           Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
        }
        
      }
    });
    }
    
}

    </script>