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
                    <h4 class="mb-sm-0">Mom</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mom</a></li>
                            <li class="breadcrumb-item active">Mom</li>
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
                        <h4 class="card-title mb-0">Moms Details</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div id="customerList">
                            <div class="row g-4 mb-3">
                                    <div class="col-sm-12">
                                    <?= $this->session->getFlashdata('msg'); ?>
                                    </div>
                                    
                                </div>
                                <div class="">
                                        <div class="row">
                                           <div class="col-md-4">Name</div>
                                           <div class="col-md-8"><b><?= $view['name']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Email</div>
                                           <div class="col-md-8"><b><?= $view['email']; ?></b></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="col-md-4">Phone</div>
                                           <div class="col-md-8"><b><?= $view['phone_withcode']; ?></b></div>
                                        </div>
                                        <hr>
                                      <div class="row">
                                           <div class="col-md-4">Phone Verified</div>
                                           <div class="col-md-8"><b><?php
                                              if($view['is_phone_verified'] == 0){ ?>
                                                <span class="badge badge-soft-warning text-uppercase">Pending</span>
                                            <?php
                                              }else{ ?>
                                                <span class="badge badge-soft-success text-uppercase">Verified</span>
                                             <?php } 
                                          ?></b></div>
                                        </div>
                                        <hr> 
                                     <div class="row">
                                         <div class="col-md-4">User Type</div>
                                         <div class="col-md-8"><b><?php
                                            if($view['user_type'] == 2){ ?>
                                              <span class="badge badge-soft-info text-uppercase">Mom</span>
                                          <?php
                                            }else{ ?>
                                              <span class="badge badge-soft-info text-uppercase">Specilaist</span>
                                           <?php } 
                                        ?></b></div>
                                      </div>
                                      <hr> 
                                        <div class="row">
                                         <div class="col-md-4">Status</div>
                                         <div class="col-md-8"><b>
                                          <?php 
                                              if($view['status'] == 1){ ?>
                                                  <span class="badge badge-soft-success text-uppercase">Active</span>
                                              <?php }else{ ?>

                                                <span class="badge badge-soft-danger text-uppercase">Blocked</span>
                                            <?php  }
                                              ?>
                                        </b></div>
                                      </div>
                                      <hr>
                                      <div class="row">
                                         <div class="col-md-4">Account Status</div>
                                         <div class="col-md-8"><b>
                                       <?php  //$value['phone']; 
                                            if($view['is_deactive'] == 1){ ?>
                                                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                                            <?php }else{ ?>

                                              <span class="badge badge-soft-success text-uppercase">Live</span>
                                          <?php  }

                                        ?>
                                        </b></div>
                                      </div>
                                      <hr> 
                                      <div class="row">
                                         <div class="col-md-4">Profile Type</div>
                                         <div class="col-md-8"><b>
                                          <?php 
                                              if($view['profile_type'] == 1){ ?>
                                                  <span class="badge badge-soft-success text-uppercase">Private</span>
                                              <?php }else{ ?>

                                                <span class="badge badge-soft-success text-uppercase">Public</span>
                                            <?php  }

                                          ?>
                                        </b></div>
                                      </div>
                                      <hr>
                                      <div class="row">
                                           <div class="col-md-4">Language</div>
                                           <div class="col-md-8"><b><?= $view['lang']; ?></b></div>
                                        </div>
                                        <hr>
                                  <!-- <div class="row">
                                     <div class="col-md-4">Birth Type</div>
                                     <div class="col-md-8"><b><?php //$view['plan_id']; 
                                      $birthType = $this->common_model->GetSingleData('birth_type',array('id'=>$view['birth_type_id']),);
                                      echo $birthType['title'];
                                     ?></b></div>
                                  </div>
                                  <hr> -->

                                 <!--  <div class="row">
                                     <div class="col-md-4">Milestone</div>
                                     <div class="col-md-8"><b><?php 
                                      
                                    $current_date = date('d-M-Y');

                                    $stage_1_complete =  date('d-M-Y',strtotime('+30 days',strtotime($view['created_at'])));
                                     $stage_2_complete =  date('d-M-Y',strtotime('+90 days',strtotime($view['created_at'])));
                                     $stage_3_complete =  date('d-M-Y',strtotime('+180 days',strtotime($view['created_at'])));
                                     $stage_4_complete =  date('d-M-Y',strtotime('+270 days',strtotime($view['created_at'])));

                                     echo "Delivery Date : ". date('d-M-Y',strtotime($view['created_at']));echo "<br>";

                                     if(strtotime($current_date)>=strtotime($stage_1_complete))
                                     {
                                       echo "Homecoming "." - ". $stage_1_complete; echo "<br>";
                                     }
                                     if(strtotime($current_date)>=strtotime($stage_2_complete))
                                     {
                                        echo "Connection "." - ".$stage_2_complete; echo "<br>";
                                     }
                                     if(strtotime($current_date)>=strtotime($stage_3_complete))
                                     {
                                        echo "Acceptance "." - ".$stage_3_complete; echo "<br>";
                                     }
                                     if(strtotime($current_date)>=strtotime($stage_3_complete))
                                     {
                                      echo "Discovery "." - ".$stage_4_complete; echo "<br>";
                                     }

                                      ?></b></div>
                                  </div>
                                  <hr> -->
                                   <div class="row">
                                     <div class="col-md-4">Delivery Date</div>
                                     <div class="col-md-8"><b><?= $view['delivery_date']; ?></b></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                     <div class="col-md-4">Why Should Call You</div>
                                     <div class="col-md-8"><b><?= $view['why_should_call']; ?></b></div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                     <div class="col-md-4">Residency</div>
                                     <div class="col-md-8"><b><?= $view['residency']; ?></b></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                     <div class="col-md-4">Was Your Birth</div>
                                     <div class="col-md-8"><b><?= $view['was_your_birth']; ?></b></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                     <div class="col-md-4">Via Baby Born</div>
                                     <div class="col-md-8"><b><?= $view['via_baby_born']; ?></b></div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                     <div class="col-md-4">Current Week</div>
                                     <div class="col-md-8"><b><?= $view['current_week']; ?></b></div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                     <div class="col-md-4">Week Start Date</div>
                                     <div class="col-md-8"><b><?= $view['week_start_date']; ?></b></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                     <div class="col-md-4">Week End Date</div>
                                     <div class="col-md-8"><b><?= 
                                       $week_end =  date('Y-m-d', strtotime($view['week_start_date']. '+ 6 days'));
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

 