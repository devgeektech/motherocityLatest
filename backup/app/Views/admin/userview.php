<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>
<style type="text/css">
  
.slick-slider .element{
  height:100px;
  width:100px;
  display:inline-block;
  margin:0px 10px;
  display:-webkit-box;
  display:-ms-flexbox;
  display:flex;
  -webkit-box-pack:center;
      -ms-flex-pack:center;
          justify-content:center;
  -webkit-box-align:center;
      -ms-flex-align:center;
          align-items:center;
  font-size:20px;
}
.slick-slider .slick-disabled {
  opacity : 0; 
  pointer-events:none;
}


</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Users</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                        <h4 class="card-title mb-0">Users Details</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        
                                    </div>
                                </div>
                                <div class="">
                                        <div class="row">
                                           <div class="col-md-4">Name</div>
                                           <div class="col-md-8"><b><?= $view['first_name']." ".$view["last_name"]; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">User Name</div>
                                           <div class="col-md-8"><b><?= $view['username']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Title</div>
                                           <div class="col-md-8"><b><?= $view['title']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Email</div>
                                           <div class="col-md-8"><b><?= $view['email']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Image</div>
                                           <div class="col-md-8"><b>
                                            
                                        <div class="slick-slider">
                                          <?php if(!empty($user_image)) { 
                                            foreach ($user_image as $key => $value) { ?>
                                          <div class="element <?= $key; ?>"><img style="height: 100px;width: 100px;" src="<?php echo ($value["image"]);?>"></div>
                                            <?php }
                                              }
                                             ?>
                                        </div>
                                       
                                      </b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Address</div>
                                           <div class="col-md-8"><b><?= $view['street_address']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">LinkedIn Id</div>
                                           <div class="col-md-8"><b><?= $view['linkedin_id']; ?></b></div>
                                        </div>
                                        <hr>
                                         <div class="row">
                                           <div class="col-md-4">Prononus</div>
                                           <div class="col-md-8"><b><?= $view['prononus']; ?></b></div>
                                        </div>
                                        <hr>
                                         <div class="row">
                                           <div class="col-md-4">City</div>
                                           <div class="col-md-8"><b><?= $view['city']; ?></b></div>
                                        </div>
                                        <hr>
                                         <div class="row">
                                           <div class="col-md-4">State</div>
                                           <div class="col-md-8"><b><?= $view['state']; ?></b></div>
                                        </div>
                                        <hr>
                                         <div class="row">
                                           <div class="col-md-4">Status</div>
                                           <div class="col-md-8"><b>
                                            <?php if ($view['status'] == 1): ?>
                                                <span class="badge badge-soft-success text-uppercase">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-soft-danger text-uppercase">Blocked</span>
                                            <?php endif ?>
                                        </b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">About Me</div>
                                           <div class="col-md-8"><b><?= $view['about_me']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">My Skils</div>
                                           <div class="col-md-8"><b><?= $view['my_skills']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Free Time Act</div>
                                           <div class="col-md-8"><b><?= $view['free_time_act']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Dumbest Act</div>
                                           <div class="col-md-8"><b><?= $view['dumbest_act']; ?></b></div>
                                        </div>
                                        <hr>
                                         <div class="row">
                                           <div class="col-md-4">Category</div>
                                           <div class="col-md-8"><b><?php  
                                           if(!empty($view['category'])){
                                            $category = $this->common_model->GetAllData("category", "id in (".$view['category'].")", 'id','desc');
                                                          $cate  = '';
                                                        foreach ($category as $key => $vcat) 
                                                        {
                                                          $cate .= '<span class="badge badge-soft-success text-uppercase">'.$vcat['title'].'</span>'."  ";
                                                        }
                                                        echo $cate;
                                                      }
                                           ?></b></div>
                                        </div>
                                        <hr>

                                         <div class="row">
                                           <div class="col-md-4">Carrier Goals</div>
                                           <div class="col-md-8"><b><?php 
                                            if(!empty($view['career_goals'])){
                                            $carrier = $this->common_model->GetAllData("carrier_management", "id in (".$view['career_goals'].")", 'id','desc');
                                                          $carr  = '';
                                                        foreach ($carrier as $key => $vcarr) {
                                                          $carr .= '<span class="badge badge-soft-success text-uppercase">'.$vcarr['title'].'</span>'."  ";
                                                        }
                                                        echo $carr;
                                                    }
                                           ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Privacy Status</div>
                                           <div class="col-md-8"><b><?php //$view['dumbest_act']; 
                                            if ($view['privacy_status'] == 1): ?>
                                                <span class="badge badge-soft-success text-uppercase">Private</span>
                                            <?php else: ?>
                                                <span class="badge badge-soft-danger text-uppercase">Public</span>
                                            <?php endif
                                           ?></b></div>
                                        </div>
                                        <hr>


                             
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
    <script type="text/javascript">
    
     $(document).ready(function(){
         $(".slick-slider").slick({
           slidesToShow: 3,
           infinite:false,
           slidesToScroll: 1,
           autoplay: true,
           autoplaySpeed: 2000
             // dots: false, Boolean
            // arrows: false, Boolean
          });
});

</script>

<script src="js/jquery-3.4.1.min.js"></script>
     <script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> 

 