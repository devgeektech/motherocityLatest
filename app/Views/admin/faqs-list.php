<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">FAQ list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ list</a></li>
                            <li class="breadcrumb-item active">FAQ list</li>
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
                        <h4 class="card-title mb-0">FAQ list</h4>
                       <!--  <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a> -->
                      </div><!-- end card header -->
                        <br>
                        <div class="row">
                          <div class="col-sm-10"></div>
                          <div class="col-sm-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add FAQ</button>
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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Screen</th>
                                                <th>Target Users</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($faqs_list): $i = 1; ?>
                                            <?php foreach ($faqs_list as $key => $value): ?>
                                                <tr>
                                               
                                                <td><?= $i; ?></td>
                                                <td><?= $value['title']; ?></td>
                                                <td><?=  strip_tags($value['description'],20); ?></td>
                                                  <td><?php

                                                  $categoryData = $this->common_model->GetColumnName("faq_category", array("id"=>$value['category']));

                                                   echo $categoryData->name; ?></td>
                                                  <td><?= $value['screen']; ?></td>
                                                  <td><?= $value['faq_about']; ?></td>
                                               <td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>" onclick="fetchdata(<?= $value['id']?>)">Edit</button>
                                                <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
            <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit FAQ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form id="edit_faqs" method="post" action="#" onsubmit="return edit_faqs(this , <?= $value['id']; ?>)" >
                      <div class="modal-body">
                      <div class="col-md-12 py-3">

                         <div>
                                <label>Category</label>
                                <select name="category" required class="form-control">
                                    <option value="">---Select Category---</option>
                                    <?php
                                    if ($category) {
                                       foreach ($category as $key121 => $value121) {
                                          ?>                              
                                            <option value="<?= $value121["id"] ?>" <?= ($value121["id"] == $value['category']) ? "selected":""; ?> ><?= $value121['name']; ?></option>
                                          <?php
                                       }
                                    }
                                    ?>
                                </select>
                        </div>

                        <div>
                          <label>Title</label>
                          <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title"  required>
                          <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                          <p id="result1"></p>
                        </div>

                        <div>
                            <label>Description</label>
                            <textarea  class="form-control textarea" name="description"><?= $value['description']; ?></textarea>
                        </div>

                 <div>
                    <label>Screen Name</label>
                    <select class="form-control" name="screen"  required>
                       <option value="">---Select----</option> 
                       <option <?= ($value['screen'] == 'help')?'Selected':'';?> value="help">Help Screen</option> 
                       <option <?= ($value['screen'] == 'account')?'Selected':'';?> value="account">Account Screen</option> 
                    </select>
                </div> 

                <div>
                    <label>Target Users</label>
                    <select class="form-control" name="faq_about"  required>
                       <option value="">---Select----</option> 
                       <option <?= ($value['faq_about'] == 'Both')?'Selected':'';?> value="Both">Both</option> 
                       <option <?= ($value['faq_about'] == 'Specialist')?'Selected':'';?> value="Specialist">Specialist</option> 
                       <option <?= ($value['faq_about'] == 'Mom')?'Selected':'';?> value="Mom">Mom</option> 
                    </select>
                </div>
                         
                        <div class="mt-3 text-center">
                            <div class="modal-footer">
                                <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>

                            </div>
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
            <h4 class="modal-title p-0">Add FAQ</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            
            <!-- Modal body -->
            <form method="post" onsubmit="return addfaqs(event)" id="addfaqs" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="col-md-12 py-3">

                <div>
                    <label>Category</label>
                    <select name="category" required class="form-control">
                        <option value="">---Select Category---</option>
                        <?php
                        if ($category) {
                           foreach ($category as $key121 => $value121) {
                              ?>                              
                                <option value="<?= $value121["id"] ?>"><?= $value121['name']; ?></option>
                              <?php
                           }
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div>
                    <label>Description</label>
                    <textarea class="form-control textarea" name="description"></textarea>
                </div>

                <div>
                    <label>Screen Name</label>
                    <select class="form-control" name="screen"  required>
                       <option value="">---Select----</option> 
                       <option value="help">Help Screen</option> 
                       <option value="account">Account Screen</option> 
                    </select>
                </div>

                <div>
                    <label>Target Users</label>
                    <select class="form-control" name="faq_about"  required>
                       <option value="">---Select----</option> 
                       <option value="Both">Both</option> 
                       <option value="Specialist">Specialist</option> 
                       <option value="Mom">Mom</option> 
                    </select>
                </div>

                <div class="mt-3 modal-footer">
                    <button type="submit"  id="add" class="btn btn-success">Add</button>
                </div>
                    
                    </div>
                </div>
            </form>
            
        </div>
        </div>
    </div>
<script type="text/javascript">
function addfaqs(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addfaqs')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Faqs/add_faqs',
              data: data,
              processData: false,
              contentType: false,
              type: 'POST',
        dataType:'json',
        beforeSend: function() {        
            $('#add').prop('disabled' , true);
            $('#add').text('Processing..');
          },
              success: function(result){
            $('#add').prop('disabled' , false);
            $('#add').text('Add');
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
 function edit_faqs(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Faqs/edit_faqs',
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
            // Swal.fire({
            //    title: "Success", 
            //    text: res.message, 
            //    icon: "success"
            //  }).then(function (result) {
            window.location.reload();
            // })         
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
          url: '<?= base_url()?>/Admin/Faqs/delete_faqs',
          data: {id:id},
          type: 'POST',
          dataType:'json',
          beforeSend: function() {        
              $('#delbtn'+id).prop('disabled' , true);
              $('#delbtn'+id).text('Processing..');
            },
          success: function(result){
              $('#delbtn'+id).prop('disabled' , false);
              $('#delbtn'+id).text('Delete');
              if(result.status == 1)
              {
            //    Swal.fire({
            //    title: "Success", 
            //    text: result.message, 
            //    icon: "success"
            //      }).then(function (result) {
                window.location.reload();
                // })   
              }
          }
          });
    }
}

</script>
