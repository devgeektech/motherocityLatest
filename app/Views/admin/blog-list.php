<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
<style>
  a.blogfeatureimage {
    margin-top: 24px;
    margin-bottom: 14px;
    color: blue;
    font-weight: 600;
  }
</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Blog list</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Blog list</a></li>
                            <li class="breadcrumb-item active">Blog list</li>
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
                        <h4 class="card-title mb-0">Blog list</h4>
                        <!--  <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</a> -->
                    </div>
                    <!-- end card header -->
                    <br>
                    <div class="row">
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Blog</button>
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
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>SubCategory</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Related Content</th>
                                            <th>Blog Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <?php if ($blog_list): $i = 1; ?>
                                        <?php foreach ($blog_list as $key => $value): ?>
                                        <tr>
                                            <td>#<?= $i; ?></td>
                                            <td><?= $value['title']; ?></td>
                                            <td style="white-space: pre-line;"><?php echo strip_tags(substr($value['description'],0,120)); ?></td>
                                            <td><?php //$value['description']; 
                                                $category = $this->common_model->GetSingleData('content_blog',array('id'=>$value['category']));
                                                echo $category['title'];
                                                ?></td>
                                            <td><?php //$value['description']; 
                                                $subcategory = $this->common_model->GetSingleData('content_blog',array('id'=>$value['subcategory']));
                                                echo $subcategory['title'];
                                                ?></td>
                                            <td><?php //$value['status']; 
                                                if($value['status'] == 1)
                                                {
                                                  echo "Paid";
                                                }else{
                                                  echo "Free";
                                                }
                                                
                                                ?></td>
                                            <td><?= $value['price']; ?></td>
                                            <?php $cat = explode(',',$value['related_content']);?>
                                            <td>
                                                <ul>
                                                    <?php foreach($cat as $cats):?>
                                                    <?php $spe = $this->common_model->GetSingleData(
                                                        'blog_management', array('id'=>$cats)) ?>
                                                    <li><?=$spe['title']?></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['blog_type'] == 0) ? 'checked' : ''; ?> value="0" class="radio" data-id="<?= $value['id']; ?>">
                                                <label>Normal</label>
                                                <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['blog_type']==1) ? 'checked':''; ?> value="1" class="radio" data-id="<?= $value['id']; ?>">
                                                <label>Primary</label>
                                                <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['blog_type'] == 2) ? 'checked' : ''; ?>  value="2" class="radio" data-id="<?= $value['id']; ?>">
                                                <label>Secondary</label>
                                                <input type="radio" name="blog_type<?= $key; ?>" <?= ($value['blog_type'] == 3) ? 'checked' : ''; ?>  value="3" class="radio" data-id="<?= $value['id']; ?>">
                                                <label>Home Picked</label>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id']; ?>">Edit</button>
                                                <a href="javascript:;" id="delbtn<?= $value['id']; ?>" onclick="deleteRow(<?= $value['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
                                                <div class="modal" id="editModal<?= $value['id']; ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header bg-light p-3">
                                                                <h4 class="modal-title p-0">Edit Blog</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form id="edit_Blog" method="post" action="#" onsubmit="return edit_Blog(this , <?= $value['id']; ?>)" >
                                                                <div class="modal-body">
                                                                    <div class="col-md-12 py-3">
                                                                        <div>
                                                                            <label>Title</label>
                                                                            <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title"  required>
                                                                            <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                                                                            <p id="result1"></p>
                                                                        </div>
                                                                        <div>
                                                                            <label>Description</label>
                                                                            <textarea class="form-control textarea" name="description"><?= $value['description']; ?></textarea>
                                                                        </div>
                                                                        <div>
                                                                            <label>Summary</label>
                                                                            <textarea class="form-control textarea" name="summary"><?= $value['summary']; ?></textarea>
                                                                        </div>
                                                                        <div>
                                                                            <label>Category</label>
                                                                            <select class="form-control editcategory-dropdown" name="category">
                                                                                <option value="">---Select----</option>
                                                                                <?php
                                                                                    foreach($blog_category as $blogcatV):
                                                                                    ?>
                                                                                <option <?= ($value['category'] == $blogcatV['id'])? 'Selected':''; ?> value="<?= $blogcatV['id']; ?>"><?= $blogcatV['title']; ?></option>
                                                                                <?php
                                                                                    endforeach
                                                                                    ?>
                                                                            </select>
                                                                        </div>
                                                                        <div >
                                                                            <label>SubCategory</label>
                                                                            <select class="form-control editsub-category" name="subcategory">
                                                                                <option value="">---Select----</option>
                                                                                <?php
                                                                                    $subcat = $this->common_model->GetAllData('content_blog',array('parent'=>$value['category']),'id','desc');
                                                                                    foreach ($subcat as $key => $subcatV) {
                                                                                      ?>
                                                                                <option <?= ($value['subcategory']==$subcatV['id'])?'Selected':''; ?> value="<?= $subcatV['id']; ?>"><?= $subcatV['title']; ?></option>
                                                                                <?php
                                                                                    }
                                                                                    ?>
                                                                            </select>
                                                                        </div>

                                                                        <div >
                                                                        <label>Feature Image</label>
                                                                           
                                                                          <input type="file" class="form-control" name="featured_image" accept="image/png, image/gif, image/jpeg, image/jpg">
                                                                          <?php
                                                                            
                                                                            if(!empty($value['featured_image'])){ ?>
                                                                              <a href="<?php echo base_url($value['featured_image']);?>" target="_blank" class="blogfeatureimage">View Current Image</a>
                                                                             <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <!-- <div>
                                                                            <label>Status</label>
                                                                            <select class="form-control" id="editprice<?= $value['id']; ?>" name="status" onchange="editprice_field(<?= $value['id']; ?>,this.value);">
                                                                                <option value="">---Select----</option>
                                                                                <option <?= ($value['status']==0)?'Selected':'';?> value="0">Free</option>
                                                                                <option <?= ($value['status']==1)?'Selected':'';?> value="1">Paid</option>
                                                                            </select>
                                                                        </div> -->
                                                                        <div id="editshow_price<?= $value['id']?>" style="display:<?= ($value['status']==1) ? 'block':'none'?>;">
                                                                            <label>price</label>
                                                                            <input type="text" class="form-control" name="price" value="<?= $value['price']; ?>"  required>
                                                                        </div>
                                                                        <div>
                                                                            <label>Related Content</label><br/>
                                                                            <select class="form-control select2" name="related_content[]" multiple>
                                                                                <option value="">--Select--</option>
                                                                                <?php $spe_cat = $this->common_model->GetAllData('blog_management',array('id !='=>$value['id'])) ?>
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
                                                                        <!--  <div>
                                                                            <label>Blog Type</label><br>
                                                                            <input type="radio" name="blog_type" <?= ($value['blog_type']==1) ? 'checked':''; ?> value="1">
                                                                            <label>Primary Blog</label>
                                                                            <input type="radio" name="blog_type" <?= ($value['blog_type']==2) ? 'checked':''; ?> value="2">
                                                                            <label>Secondary Blog</label>
                                                                            </div> -->
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
                                <div class="noresult" style="display: <?= ($blog_list) ? 'none' : 'block' ?>">
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
                    </div>
                    <!-- end card -->
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
                <h4 class="modal-title p-0">Add Blog</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <!-- Modal body -->
            <form method="post" onsubmit="return addBlog(event)" id="addBlog" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>Title</label>
                            <input type="text" class="form-control" name="title"  required>
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea class="form-control textarea"></textarea>
                        </div>
                        <textarea class="form-control" id="summernote">Lorem ipsum</textarea>
    <script>
        jQuery(document).ready(function() {
      
            jQuery('#summernote').summernote({height: 300});
        });
    </script>
                        
                        <div>
                            <label>Summary</label>
                            <textarea class="form-control textarea" name="summary"></textarea>
                        </div>
                        <div>
                            <label>Category</label>
                            <select class="form-control category-dropdown" name="category">
                                <option value="">---Select----</option>
                                <?php
                                    foreach($blog_category as $blogcatV):
                                    ?>
                                <option value="<?= $blogcatV['id']; ?>"><?= $blogcatV['title']; ?></option>
                                <?php
                                    endforeach
                                    ?>
                            </select>
                        </div>
                        <div >
                            <label>SubCategory</label>
                            <select class="form-control sub-category" name="subcategory">
                            </select>
                        </div>
                        <div >
                            <label>Feature Image</label>
                            <input type="file" class="form-control" name="featured_image" accept="image/png, image/gif, image/jpeg, image/jpg">
                            </select>
                        </div>
                        <!-- <div>
                            <label>Status</label>
                            <select class="form-control" id="addprice" name="status" onchange="return addprice_field();">
                                <option value="">---Select----</option>
                                <option value="0">Free</option>
                                <option value="1">Paid</option>
                            </select>
                        </div> -->
                        <!-- <div id="addshow_price" style="display:none;">
                            <label>price</label>
                            <input type="number" min="0" class="form-control" name="price" price>
                        </div> -->
                        <div>
                            <label>Related Content</label>
                            <select class="form-control select2" name="related_content[]" multiple>
                                <option value="">--Select--</option>
                                <?php foreach ($blog_list as $key => $value): ?>
                                <option value="<?=$value['id']?>"><?=$value['title']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                          <div>
                            <label>Blog Type</label><br>
                            <input type="radio" name="blog_type" value="1">
                            <label>Primary Blog</label>
                            <input type="radio" name="blog_type" value="2">
                            <label>Secondary Blog</label>
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
    
    
    function addBlog(event) {
          event.preventDefault();
      $('.alert-danger').remove();
          var data = new FormData($('#addBlog')[0]);
    
          $.ajax({
                url: '<?= base_url()?>/Admin/Blog/add_Blog',
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
    function edit_Blog(el , id) {
      $('.alert-danger').remove();
        $.ajax({
        url: '<?= base_url() ?>/Admin/Blog/edit_Blog',
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
            url: '<?= base_url()?>/Admin/Blog/delete_Blog',
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
              url: "<?= base_url()?>/Admin/Blog/fetch_subcat",
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
              url: "<?= base_url()?>/Admin/Blog/fetch_editsubcat",
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