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
                    <h4 class="mb-sm-0">Specialist</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Specialist</a></li>
                            <li class="breadcrumb-item active">Specialist</li>
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
                        <h4 class="card-title mb-0">Specialist Details</h4>
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
                                           <div class="col-md-8"><b><?= $view['first_name']." ".$view["last_name"]; ?></b></div>
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
                                           <div class="col-md-4">Country</div>
                                           <div class="col-md-8"><b><?= $view['country']; ?></b></div>
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
                                            if($view['user_type'] == 1){ ?>
                                              <span class="badge badge-soft-info text-uppercase">Specialist</span>
                                          <?php
                                            }else{ ?>
                                              <span class="badge badge-soft-info text-uppercase">Mom</span>
                                           <?php } 
                                        ?></b></div>
                                      </div>
                                      <hr> 
                                      <div class="row">
                                           <div class="col-md-4">Language</div>
                                           <div class="col-md-8"><b><?= $view['lang']; ?></b></div>
                                        </div>
                                        <hr>

                                       <div class="row">
                                         <div class="col-md-4">Profile Image</div>
                                         <div class="col-md-8"><b>
                                           <?php if(!empty($view["profile_image"])) { ?>
                                              <img style="height: 100px;width: 100px;" class="img-thumbnail rounded-circle" src="<?php echo base_url($view["profile_image"]);?>">
                                              <?php }else{
                                                ?>
                                                <img style="height: 100px;width: 100px;" class="img-thumbnail rounded-circle" src="<?php echo base_url('assets/profile_image/dummy-profile-pic.png');?>">
                                               <?php } ?>

                                         </b></div>
                                      </div>
                                      <hr> 

                                 <div class="row">
                                     <div class="col-md-4">Your Expertise</div>
                                     <div class="col-md-8"><b><?php
                                  $spcat = $this->common_model->GetSingleData('specialist_category',array('id'=>$view['specialist_category']),);
                                  echo $spcat['title'];

                                    ?></b></div>
                                  </div>
                                  <hr>
                                   <div class="row">
                                     <div class="col-md-4">Your Speciality</div>
                                     <div class="col-md-8"><b><?php
                                  $spsubcat = $this->common_model->GetSingleData('specialist_category',array('id'=>$view['specialist_subcategory']),);
                                  echo $spsubcat['title'];

                                    ?></b></div>
                                  </div>
                                  <hr>
                                <div class="row">
                                     <div class="col-md-4">Experience Year</div>
                                     <div class="col-md-8"><b><?= $view['year_experience']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Office Hours</div>
                                     <div class="col-md-8"><b><?= $view['office_hours']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Office Days</div>
                                     <div class="col-md-8"><b><?= $view['office_days']; ?></b></div>
                                </div>
                                <hr>
                                  <div class="row">
                                     <div class="col-md-4">Fees</div>
                                     <div class="col-md-8"><b>$<?= $view['fees']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Insurance</div>
                                     <div class="col-md-8"><b><?= $view['insurance']; ?></b></div>
                                </div>
                                <hr>
                                <div class="row">
                                     <div class="col-md-4">Your Websites</div>
                                     <div class="col-md-8"><b><?= $view['your_website']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Primary Contact</div>
                                     <div class="col-md-8"><b><?= $view['primary_contact']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Latitude</div>
                                     <div class="col-md-8"><b><?= $view['lat']; ?></b></div>
                                </div>
                                <hr>
                                 <div class="row">
                                     <div class="col-md-4">Longitude</div>
                                     <div class="col-md-8"><b><?= $view['lng']; ?></b></div>
                                </div>
                                <hr>
                                <div class="row">
                                   <div class="col-md-4">Plan Detail</div>
                                   <div class="col-md-8"><b><?php //$view['plan_id']; 
                                    $plan = $this->common_model->GetSingleData('plan_management',array('id'=>$view['plan_id']));?>
                                    <span class='badge badge-soft-info text-uppercase'><?= $plan['title'];?></span><br>
                                    <?php
                                      if($plan){

                                     'Trial Days: '.$plan['free_trail_days'];
                                      echo "<br>";
                                      }else{?>
                                        <span class='badge badge-soft-danger text-uppercase'>Plan Not Available</span><br>
                                      <?php }
                                     ?>
                                  <?php  
                                   $transaction = $this->common_model->GetSingleData('transaction',array('plan_id'=>$view['plan_id'],'user_id'=>$view['id']),'id','desc');
                                   if($transaction){
                                   echo 'Start Date: '.$transaction['start_date'];echo "<br>";
                                   echo 'End Date: '.$transaction['end_date'];
                                   }
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

 