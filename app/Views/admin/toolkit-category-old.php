<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Toolkit Category list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Toolkit Category list</a></li>
                            <li class="breadcrumb-item active">Toolkit Category list</li>
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
                        <h4 class="card-title mb-0">Toolkit Category list</h4>
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
                                                <th>Heading</th>
                                                <th>Body</th>
                                                <th>Preview</th>
                                                <th>Content Related</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($toolkit_cat): $i = 1; ?>
                                            <?php foreach ($toolkit_cat as $key => $value): ?>
                                                <tr>
                                               
                                                <td><?= $i; ?></td>
                                                <td><?= $value['title']; ?></td>
                                                <td style="white-space: pre-line;"><?php echo substr(stripe_tag($value['description']),0,120); ?></td>
                                                <td style="white-space: pre-line;"><?= $value['preview']; ?></td>
                                                <td><?= $value['related_content']; ?></td>
                                                <td>
                                                   
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
            <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Toolkit Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form id="edit_toolCat" method="post" action="#" onsubmit="return edit_toolCat(this , <?= $value['id']; ?>)" >
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>Heading</label>
                          <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title"  required>
                          <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                          <p id="result1"></p>
                        </div>

                        <div>
                            <label>Body</label>
                            <textarea required class="form-control textarea" name="description"><?= $value['description']; ?></textarea>
                        </div>
                     
                      <div>
                        <label>Preview/Summary</label>
                        <textarea class="form-control" name="preview" required value=""><?= $value['preview']?></textarea>
                      </div>

                      <div>
                        <label>Related Content</label>
                        <textarea class="form-control" name="related_content" required value=""><?= $value['related_content']?></textarea>
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
                                
                                    <div class="noresult" style="display: <?= ($toolkit_cat) ? 'none' : 'block' ?>">
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
                    <h4 class="modal-title p-0">Add Toolkit Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form method="post" onsubmit="return addToolCat(event)" id="addToolCat" enctype="multipart/form-data">
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>Heading</label>
                          <input type="text" class="form-control" name="title"  required>
                        </div>

                        <div>
                            <label>Body</label>
                            <textarea required class="form-control textarea" name="description"></textarea>
                        </div>
                     <div>
                        <label>Preview/Summary</label>
                        <textarea  class="form-control" name="preview" required></textarea>
                      </div>

                      <div>
                        <label>Related Content</label>
                        <textarea class="form-control" name="related_content" required></textarea>
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

  function addprice_field()
  {
     //alert('hsjdj');
    var x = $("#addprice").val();

    if(x==0)
    {
      $("#addshow_price").hide();
      
    }
    else
    {
      $("#addshow_price").show();
    }
      return false;
  }
 function editprice_field(id,val)
  {
     //alert('hsjdj');
    //var x = $("#editprice").val();
      if(val==0)
      {
        $("#editshow_price"+id).hide();
        
      }
      else
      {
        $("#editshow_price"+id).show();
      }
        return false;
  }


function addToolCat(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addToolCat')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Toolkit/add_Toolkit_Category',
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
 function edit_toolCat(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Toolkit/edit_toolCat',
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
          url: '<?= base_url()?>/Admin/Toolkit/delete_ToolkitCat',
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
    $(".radio").click(function(){
      var blog_id = $(this).data('id');
      var blog_val = $(this).val();
      //alert(blog_id);

       $.ajax({
            url: "<?= base_url()?>/Admin/Blog/change_blogtype",
            type: "POST",
            data: {
                blog_id:blog_id,blog_val: blog_val
            },
            cache: false,
            success: function(result) {
               // window.location.reload();
            }
        });
    });
});
</script>
