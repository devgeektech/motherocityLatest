<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tips list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tips list</a></li>
                            <li class="breadcrumb-item active">Tips list</li>
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
                        <h4 class="card-title mb-0">Tips list</h4>
                       <!--  <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a> -->
                      </div><!-- end card header -->
                        <br>
                        <div class="row">
                          <div class="col-sm-10"></div>  
                          <div class="col-sm-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Tips</button>
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
                                                <!-- <th>Is Free</th>
                                                <th>Price</th>
                                                <th>Blog</th>
                                                <th>Date</th> -->
                                                <th>Weeks</th>
                                                <th>Days</th>
                                                <th>Preview</th>
                                                <th>Related Content</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <?php if ($tips_list): $i = 1; ?>
                                            <?php foreach ($tips_list as $key => $value): 
                                                $blog_id = $value['blog_id'];
                                                $tips_blog = $this->common_model->GetSingleData('blog_management',array('id'=> $blog_id));
                                                // print_r($tips_blog);
                                                ?>
                                                <tr>
                                               
                                                <td><?= $i; ?></td>
                                                <td><?= $value['title']; ?></td>
                                                <td style="white-space: pre-line;"><?php echo substr(strip_tags($value['description']),0,120); ?></td>
                                                <!-- <td><?= ($value['is_free']==1) ? "Yes" : "No" ?></td>
                                                <td><?= $value['price']; ?></td>
                                                <td><?= $tips_blog['title']; ?></td>
                                                <td><?= humanDate($value['tips_date']); ?></td> -->
                                                <td><?= $value['week_no']; ?></td>
                                                <td><?= $value['days']; ?> Days</td>
                                                <td style="white-space: pre-line;">
                                                    <?php echo substr(strip_tags($value['preview']),0,120); ?>
                                                </td>
                                                <?php $cat = explode(',',$value['related_content']);?>
                                                <td><ul><?php foreach($cat as $cats):?>
                                                <?php $spe = $this->common_model->GetSingleData(
                                                'blog_management', array('id'=>$cats)) ?>
                                                <li><?=$spe['title']?></li>
                                                <?php endforeach ?></ul></td>
                                                <td><?= humanDate($value['created_at']); ?></td>

                                               <td>
                                                   
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>

<div class="modal" id="editModal<?= $value['id']; ?>">                 
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header bg-light p-3">
    <h4 class="modal-title p-0">Edit Postpartum Tips</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
</div>

<!-- Modal body -->
<form id="edit_Tips" method="post" action="#" onsubmit="return edit_Tips(this , <?= $value['id']; ?>)" >
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
            <textarea class="form-control textarea summernote" name="description"><?= $value['description']; ?></textarea>
        </div>

        <!-- <div>
            <label>Blog</label>
            <select class="form-control" name="blog_id" required>
            <option value="">---Select----</option>
            <?php
                $blog_list = $this->common_model->GetAllData('blog_management','','id','desc');

                foreach($blog_list as $blogs):
                ?>
                    <option value="<?= $blogs['id']; ?>" <?= ($blogs['id']) ? 'selected' : '' ?>><?= $blogs['title']; ?></option>

                <?php
                endforeach
                ?>
            </select>
        </div>

        <div>
        <label>Date</label>
        <input type="date" class="form-control" value="<?= $value['tips_date']; ?>"  name="tips_date"  required>
        </div>

        <div>
            <label>Is Free</label>
            <select class="form-control" name="is_free" onchange="return editprice_field(this.value,<?= $value['id']; ?>);">
            <option value="">---Select----</option>
            <option <?= ($value['is_free']==1)?'selected':'';?> value="1">Yes</option>
            <option <?= ($value['is_free']==0)?'selected':'';?> value="0">No</option>
            </select>
        </div>

        <div id="editshow_price<?= $value['id'] ?>"  style="<?= ($value['is_free']==1) ? 'display:none;' : ''?>">
        <label>Price</label>
        <input type="text" class="form-control" name="price" value="<?= $value['price']; ?>" id="price<?= $value['id'] ?>" required>
        </div> -->

         <div>
            <label>Week Number</label>
            <select class="form-control blog-dropdown" name="week_no" required>
                <option value="">---Select---</option>
                <?php
                    for($i=1;$i<=52;$i++) { ?>
                        <option <?= ($value['week_no'] == $i) ? 'Selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                    <?php }
                ?>
            </select>
        </div>

        <div>
            <label>Days</label>
            <select class="form-control blog-dropdown" name="days" required>
                <option value="">---Select---</option>
                <option <?= ($value['days']==1) ? 'selected':'';?> value="1">1 Days</option>
                <option <?= ($value['days']==2) ? 'selected':'';?> value="2">2 Days</option>
                <option <?= ($value['days']==3) ? 'selected':'';?> value="3">3 Days</option>
                <option <?= ($value['days']==4) ? 'selected':'';?> value="4">4 Days</option>
                <option <?= ($value['days']==5) ? 'selected':'';?> value="5">5 Days</option>
                <option <?= ($value['days']==6) ? 'selected':'';?> value="6">6 Days</option>
                <option <?= ($value['days']==7) ? 'selected':'';?> value="7">7 Days</option>
            </select>
        </div>
        <div>
            <label>Preview/Summary</label>
             <textarea required class="form-control" name="preview"><?= $value['preview']; ?></textarea>
        </div>
        <div>
            <label>Related Content</label><br/>
             <select class="form-control select2" name="related_content[]" multiple>
                                <option value="">--Select--</option>
                                <?php $spe_cat = $this->common_model->GetAllData('blog_management','','id','desc') ?>
                                
                            <?php foreach ($spe_cat as $key => $values): ?>
                                <?php if(in_array($values['id'], $cat)) {
                                    $selected = 'selected';
                                }  else {
                                    $selected = '';
                                }?>
                                <option <?=$selected?> value="<?=$values['id']?>"><?=$values['title']?></option>
                            <?php endforeach ?>
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
                    <?php $i++; endforeach ?>
              
              <?php endif ?>    
                </tbody>
            </table> 
        
                                    <div class="noresult" style="display: <?= ($tips_list) ? 'none' : 'block' ?>">
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
    
    <div class="modal" id="addModal">                 
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header bg-light p-3">
            <h4 class="modal-title p-0">Add Postpartum Tips</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            
            <!-- Modal body -->
            <form method="post" onsubmit="return addTips(event)" id="addTips" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="col-md-12 py-3">
                <div>
                    <label>Heading</label>
                    <input type="text" class="form-control" name="title"  required>
                </div>

                <div>
                    <label>Body</label>
                    <textarea class="form-control textarea summernote" name="description"></textarea>
                </div>
               <!--  <div>
                    <label>Date</label>
                    <input type="date" class="form-control" name="tips_date"  required>
                </div>
                <div>  
                    <label>Blog</label>
                    <select class="form-control blog-dropdown" name="blog_id">
                        <option value="">---Select----</option>
                        <?php
                            $blog_list = $this->common_model->GetAllData('blog_management','','id','desc');

                        foreach($blog_list as $blogs):
                        ?>
                            <option value="<?= $blogs['id']; ?>"><?= $blogs['title']; ?></option>

                        <?php
                        endforeach
                        ?>
                    </select>
                </div>

                    <div>
                    <label>Is Free</label>
                    <select class="form-control" id="addprice" name="is_free" onchange="return addprice_field();">
                        <option value="">---Select----</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div id="addshow_price" style="display:none;">
                    <label>price</label>
                    <input type="number" min="0" class="form-control" name="price" price>
                </div> -->
                    
                <div>
                    <label>Week Number</label>
                     <select class="form-control blog-dropdown" name="week_no" required="">
                        <option value="">---Select---</option>
                        <?php
                            for($i=1;$i<=52;$i++ ) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php }
                        ?>
                    </select>
                </div>

                <div>
                    <label>Days</label>
                    <select class="form-control blog-dropdown" name="days" required="">
                        <option value="">---Select---</option>
                        <option value="1">1 Days</option>
                        <option value="2">2 Days</option>
                        <option value="3">3 Days</option>
                        <option value="4">4 Days</option>
                        <option value="5">5 Days</option>
                        <option value="6">6 Days</option>
                        <option value="7">7 Days</option>
                    </select>
                </div>
                <div>
                    <label>Preview/Summary</label>
                     <textarea required class="form-control" name="preview"></textarea>
                </div>
                <div>
                    <label>Related Content</label>
                     <select class="form-control select2" name="related_content[]" multiple>
                                <option value="">--Select--</option>
                                 <?php $blogs = $this->common_model->GetAllData('blog_management','','id','desc') ?>
                            <?php foreach ($blogs as $key => $value): ?>
                                <option value="<?=$value['id']?>"><?=$value['title']?></option>
                            <?php endforeach ?>
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
    </div><?php include 'include/footer.php'; ?>
<script type="text/javascript">

  function addprice_field()
  {
     //alert('hsjdj');
    var x = $("#addprice").val();

    if(x==1)
    {
      $("#addshow_price").hide();
      
    }
    else
    {
      $("#addshow_price").show();
    }
      return false;
  }
  function editprice_field(x , id){
    // alert(x);
    if(x==0){
        $('#editshow_price'+id).show();
    }else{
        $('#editshow_price'+id).hide();
        $('#price'+id).val(0);
    }
}

function addTips(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addTips')[0]);

        $.ajax({
              url: '<?= base_url()?>/index.php/Admin/Tips/add_Tips',
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
 function edit_Tips(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/index.php/Admin/Tips/edit_Tips',
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
          url: '<?= base_url()?>/Admin/Tips/delete_Tips',
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
