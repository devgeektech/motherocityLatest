<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Content Category list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Content Category list</a></li>
                            <li class="breadcrumb-item active">Content Category list</li>
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
                        <h4 class="card-title mb-0">Content Category list</h4>
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
                                                <th>Heading</th>
                                                <th>Body</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>Hand Picked</th>
                                                <th>Preview</th>
                                                <th>Related Content</th>
                                                <th>Date</th>
                                                <th>Content Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($content_cat): $i = 1; ?>
                                            <?php foreach ($content_cat as $key => $value): ?>
                                                <tr>
                                               
                                                <td>#<?= $i; ?></td>
                                                <td><?= $value['title']; ?></td>
                                                <td style="white-space: pre-line;"><?php echo substr(strip_tags($value['description']),0,120); ?></td>
                                                <td><p>
                                                <?php if(!empty($value["image"])) { ?>
                                                  <img style="height: 100px;width: 100px;" src="<?php echo base_url($value["image"]);?>">
                                                  <?php } ?>
                                              </p></td>
                                               <td><?php //$value['status']; 
                                                  if($value['status'] == 1)
                                                  {
                                                    echo "Paid";
                                                  }else{
                                                    echo "Free";
                                                  }

                                                ?></td>
                                                <td><?= $value['price']; ?></td>
                                                <td><?= $value['hand_picked']; ?></td>
                                                <td><?= $value['preview']; ?></td>
                                                <td><?= $value['related_content']; ?></td>
                                                <td><?= humanDate($value['created_at']); ?></td>
                                                <td>
                                                  <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['content_type'] == 0) ? 'checked' : ''; ?> value="0" class="radio" data-id="<?= $value['id']; ?>">
                                                  <label>General</label>
                                                  <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['content_type']==1) ? 'checked':''; ?> value="1" class="radio" data-id="<?= $value['id']; ?>">
                                                  <label>Primary</label>
                                                  <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['content_type'] == 2) ? 'checked' : ''; ?>  value="2" class="radio" data-id="<?= $value['id']; ?>">
                                                  <label>Secondary</label>
                                                </td>
                                               <td>
                                                   
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
            <div class="modal" id="editModal<?= $value['id']; ?>">                 
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                   <div class="modal-header bg-light p-3">
                    <h4 class="modal-title p-0">Edit Content Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form id="edit_Content" method="post" action="#" onsubmit="return edit_Content(this , <?= $value['id']; ?>)" >
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
                            <label>Content Type</label>
                            <select class="form-control"  name="content_type" required="">
                              <option value="">---Select----</option>
                              <option <?= ($value['content_type']==0)?'Selected':'';?> value="0">General</option>
                              <option <?= ($value['content_type']==1)?'Selected':'';?> value="1">Primary</option>
                              <option <?= ($value['content_type']==2)?'Selected':'';?> value="2">Secondary</option>
                            </select>
                        </div>
                        <div>
                          <label>Image</label>
                          <input type="file" class="form-control" name="image" accept="image/*" >
                        </div>
                        <p>
                          <?php if(!empty($value["image"])) { ?>
                            <img style="height: 100px;width: 100px;" src="<?php echo base_url($value["image"]);?>">
                            <?php } ?>
                        </p>
                        
                       <div>
                            <label>Status</label>
                            <select class="form-control" id="editprice<?= $value['id']; ?>" name="status" onchange="editprice_field(<?= $value['id']; ?>,this.value);">
                              <option value="">---Select----</option>
                              <option <?= ($value['status']==0)?'Selected':'';?> value="0">Free</option>
                              <option <?= ($value['status']==1)?'Selected':'';?> value="1">Paid</option>
                            </select>
                        </div>

                        <div id="editshow_price<?= $value['id']?>" style="display:<?= ($value['status']==1) ? 'block':'none'?>;">
                          <label>price</label>
                          <input type="text" id="pricevalue<?= $value['id']?>" class="form-control" name="price" value="<?= $value['price']; ?>"  required>
                        </div>

                    <div>
                      <label>Hand Picked</label>
                      <input type="text"  class="form-control" name="hand_picked" required="" value="<?= $value['hand_picked']?>">
                    </div>
                      <div>
                        <label>Preview/Summary</label>
                        <input type="text"  class="form-control" name="preview" required value="<?= $value['preview']?>">
                      </div>

                      <div>
                        <label>Related Content</label>
                        <input type="text"  class="form-control" name="related_content" required value="<?= $value['related_content']?>">
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
                                
                                    <div class="noresult" style="display: <?= ($content_cat) ? 'none' : 'block' ?>">
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
                    <h4 class="modal-title p-0">Add Content Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                  </div>
                  
                  <!-- Modal body -->
                  <form method="post" onsubmit="return addcontent(event)" id="addcontent" enctype="multipart/form-data">
                      <div class="modal-body">
                      <div class="col-md-12 py-3">
                        <div>
                          <label>heading</label>
                          <input type="text" class="form-control" name="title"  required>
                        </div>

                        <div>
                            <label>Body</label>
                            <textarea required class="form-control textarea" name="description"></textarea>
                        </div>

                        <div>
                            <label>Content Type</label>
                            <select class="form-control"  name="content_type" required="">
                              <option value="">---Select----</option>
                              <option value="0">General</option>
                              <option value="1">Primary</option>
                              <option value="2">Secondary</option>
                            </select>
                        </div>
                        <div>
                          <label>Image</label>
                          <input type="file" class="form-control" name="image" accept="image/*"  required>
                        </div>


                         <div>
                            <label>Status</label>
                            <select class="form-control" id="addprice" name="status" onchange="return addprice_field();" required>
                              <option value="">---Select----</option>
                              <option value="0">Free</option>
                              <option value="1">Paid</option>
                            </select>
                        </div>

                        <div id="addshow_price" style="display:none;">
                          <label>price</label>
                          <input type="number" min="0" class="form-control" name="price" price>
                        </div>
                    <div>
                      <label>Home Picked</label>
                      <input type="text"  class="form-control" name="hand_picked" required>
                    </div>
                      <div>
                        <label>Preview/Summary</label>
                        <input type="text"  class="form-control" name="preview" required>
                      </div>

                      <div>
                        <label>Related Content</label>
                        <input type="text"  class="form-control" name="related_content" required>
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
         $("#pricevalue"+id).val('0');
      }
      else
      {
        $("#editshow_price"+id).show();
      }
        return false;
  }


function addcontent(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addcontent')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Content/add_Content_Category',
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
 function edit_Content(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Content/edit_ContentCat',
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
          url: '<?= base_url()?>/Admin/Content/delete_ContentCat',
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
      var content_id = $(this).data('id');
      var content_val = $(this).val();
      //alert(blog_id);

       $.ajax({
            url: "<?= base_url()?>/Admin/Content/change_Contenttype",
            type: "POST",
            data: {
                content_id:content_id,content_val: content_val
            },
            cache: false,
            success: function(result) {
               // window.location.reload();
            }
        });
    });
});
</script>
