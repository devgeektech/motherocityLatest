<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">FAQ Category</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ Category</a></li>
                            <li class="breadcrumb-item active">FAQ Category</li>
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
                        <h4 class="card-title mb-0">FAQ Category list</h4>
                       <!--  <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a> -->
                      </div><!-- end card header -->
                        <br>
                        <div class="row">
                          <div class="col-sm-10"></div>
                          <div class="col-sm-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Category</button>
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
                                    <table class="table align-middle table-nowrap" id="example23">
                                        <thead class="table-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($faqs_category): $i = 1; ?>
                                            <?php foreach ($faqs_category as $key => $value): ?>
                                                <tr>
                                               
                                                <td>#<?= $i; ?></td>
                                                <td><?= $value['name']; ?></td>
                                               <td>
                                                   
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                <a href="<?= base_url('Admin/Faqs/FaqsCategoryDelete?id='.$value["id"]); ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm">Delete</a>

            <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Faq Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                <div id="errorMsg<?= $value['id']; ?>"></div>
                  <!-- Modal body -->
                  <form id="edit_Blogcategory<?= $value['id']; ?>" method="post" action="#" onsubmit="return edit_Blogcategory(this , <?= $value['id']; ?>)" >
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>Title</label>
                          <input type="text" class="form-control" value="<?= $value['name']; ?>"  name="name"  required placeholder="Enter category name" />
                          <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
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
                                            <?php $i++; endforeach ?>
                                      
                                      <?php endif ?>    
                                        </tbody>
                                    </table>  

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
                    <h4 class="modal-title p-0">Add Faq Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form method="post" onsubmit="return addCategory(event)" id="addCategory" enctype="multipart/form-data">
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>Title</label>
                          <input type="text" class="form-control" name="name"  required placeholder="Enter category name" />
                          <p id="result1"></p>
                        </div> 

                         <div class="mt-3 modal-footer">
                            <button type="submit" id="update" class="btn btn-success">Add</button>
                        </div>
                          
                          </div>
                     </div>
                  </form>
                  
                </div>
              </div>
            </div>
    <script type="text/javascript">

function addCategory(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addCategory')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Faqs/add_Faqscategory',
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
            if(result.status == 1) { 
            window.location.reload();
            } else {
              console.log(result.message);
              for (var err in result.message) {
            
              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
              }
            }
        }
        });
    return false;
  } 
 function edit_Blogcategory(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Faqs/edit_FaqsCategory',
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
        } else {
            if (res.status == 2) {
                $("#errorMsg"+id).html(res.message);
            } else {
                  for (var err in res.message) {
                    
                    $("#edit_Blogcategory"+id).find("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
                  }
            }         
          
        }
      }
    });
return false;    
}

function deleteRow(id) {
    if(confirm('Are you sure ?')){
      $.ajax ({
          url: '<?= base_url()?>/Admin/Blog/delete_Blogcategory',
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