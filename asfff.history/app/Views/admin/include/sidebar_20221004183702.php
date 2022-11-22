<!-- ========== App Menu ========== -->
<style>
    @media (max-width: 767.98px){
.navbar-brand-box {
    display: block!important;
}
}
@media (max-width: 767.98px){
.logo span.logo-sm {
    display: none;
}
}
@media (max-width: 767.98px){
.logo span.logo-lg {
    display: block;
}
}
</style>
        
              
            <div class="app-menu navbar-menu">
            
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?= base_url() ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url() ?>/assets/images/logo-mini.png" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url() ?>/assets/images/logo-big.png" alt="" height="30">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?= base_url() ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url() ?>/assets/images/logo-mini.png" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url() ?>/assets/images/logo-big.png" alt="" height="30">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>/admin/dashboard" class="nav-link" data-key="t-one-page"><i class="ri-dashboard-2-line"></i>  Dashboard </a>
                        </li>
                        <?php if(CheckRoleAndPermission(1) || CheckRoleAndPermission(24)) : ?>
                         <li class="nav-item">
                            <a class="nav-link menu-link" href="#colaborater" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="colaborater">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Collaborators Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="colaborater" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                    <?php if(CheckRoleAndPermission(1)) : ?>
                                        <a href="/admin/collaborators" class="nav-link" data-key="t-analytics">Collaborators List</a>
                                    <?php endif ?>
                                    <?php if(CheckRoleAndPermission(1)) : ?>
                                        <a href="<?= base_url() ?>/admin/roles" class="nav-link" data-key="t-analytics">Roles Management</a>
                                    <?php endif ?>                                       
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>    
                       
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#userss" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="userss">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">User Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="userss" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                   
                                        <a href="/admin/verified_user" class="nav-link" data-key="t-analytics">Verified Specialist</a>
                                    
                   
                                        <a href="/admin/incoming_user" class="nav-link" data-key="t-analytics">Incoming Specialist</a>
                                   
                                  
                                        <a href="/admin/moms" class="nav-link" data-key="t-analytics">Moms</a>
                                   
                                    </li>
                                </ul>
                            </div>
                        </li>
                     
                        <?php if(CheckRoleAndPermission(5)) : ?>
                          <li class="nav-item">
                            <a class="nav-link menu-link" href="#plan" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="plan">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Membership</span>
                            </a>
                            <div class="menu-dropdown collapse" id="plan" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url('') ?>/admin/plan" class="nav-link" data-key="t-analytics">view</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(6) || CheckRoleAndPermission(7)) : ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Specialist Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarDashboards" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(6)) : ?>
                                        <a href="<?= base_url() ?>/admin/specialist-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(7)) : ?>
                                        <a href="<?= base_url() ?>/admin/specialist-subcategory" class="nav-link" data-key="t-analytics">SubCategory</a>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(8) || CheckRoleAndPermission(9)) : ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#nutrition" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="nutrition">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Toolkit Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="nutrition" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(8)) : ?>
                                        <a href="<?= base_url() ?>/admin/nutrition-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(9)) : ?>
                                        <a href="<?= base_url() ?>/admin/nutrition-subcategory" class="nav-link" data-key="t-analytics">SubCategory</a>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(10) || CheckRoleAndPermission(11) || CheckRoleAndPermission(12)) : ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#content_blog" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="content_blog">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Content Blog Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="content_blog" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(10)) : ?>
                                        <a href="<?= base_url() ?>/admin/blog-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(11)) : ?>
                                        <a href="<?= base_url() ?>/admin/blog-subcategory" class="nav-link" data-key="t-analytics">SubCategory</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(12)) : ?>
                                         <a href="<?= base_url() ?>/admin/blog-list" class="nav-link" data-key="t-analytics">Blog List</a>
                                         <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(13)) : ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#tips" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="tips">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Postpartum Tips</span>
                            </a>
                            <div class="menu-dropdown collapse" id="tips" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/tips-list" class="nav-link" data-key="t-analytics">View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(14) || CheckRoleAndPermission(15)) : ?>
                        <!--  <li class="nav-item">
                            <a class="nav-link menu-link" href="#contents-cat" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="contents-cat">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Content</span>
                            </a>
                            <div class="menu-dropdown collapse" id="contents-cat" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(14)) : ?>
                                        <a href="<?= base_url() ?>/admin/content-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(15)) : ?>
                                        <a href="<?= base_url() ?>/admin/content-subcategory" class="nav-link" data-key="t-analytics">Subcategory</a>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(16) || CheckRoleAndPermission(17)) : ?>
                        <!--  <li class="nav-item">
                            <a class="nav-link menu-link" href="#tollkit-cat" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="tollkit-cat">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Toolkit</span>
                            </a>
                            <div class="menu-dropdown collapse" id="tollkit-cat" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(16)) : ?>
                                        <a href="<?= base_url() ?>/admin/toolkit-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(17)) : ?>
                                        <a href="<?= base_url() ?>/admin/toolkit-subcategory" class="nav-link" data-key="t-analytics">Subcategory</a>
                                        <?php endif ?>
                                        
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(18) || CheckRoleAndPermission(19) || CheckRoleAndPermission(20) || CheckRoleAndPermission(22) || CheckRoleAndPermission(23)) : ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#content" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="content">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Content Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="content" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <?php if(CheckRoleAndPermission(22)) : ?>
                                        <!-- <a href="<?= base_url() ?>/admin/accountfaqs-list" class="nav-link" data-key="t-analytics">Account Details FAQ</a> -->
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(19)) : ?>
                                        <a href="<?= base_url() ?>/admin/privacy" class="nav-link" data-key="t-analytics">Privacy Policy</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(23)) : ?>
                                        <a href="<?= base_url() ?>/admin/term" class="nav-link" data-key="t-analytics">Terms</a>
                                        <?php endif ?>
                                        <?php if(CheckRoleAndPermission(20)) : ?>
                                        <a href="<?= base_url() ?>/admin/about" class="nav-link" data-key="t-analytics">About</a>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#contentFaq" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="contentFaq">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">FAQ Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="contentFaq" style="">
                                <ul class="nav nav-sm flex-column">
                                        <?php if(CheckRoleAndPermission(18)) : ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/faq-category" class="nav-link" data-key="t-analytics">Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/faqs-list" class="nav-link" data-key="t-analytics">List</a>
                                    </li>
                                        <?php endif ?> 
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#contact" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="contact">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Query Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="contact" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                     <?php if(CheckRoleAndPermission(19)) : ?>
                                        <a href="<?= base_url() ?>/admin/contact" class="nav-link" data-key="t-analytics">Query List</a>
                                        <?php endif ?>
                                       
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if(CheckRoleAndPermission(21)) : ?>
                         <li class="nav-item">
                            <a class="nav-link menu-link" href="#report" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="report">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Report Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="report" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a href="<?= base_url() ?>/admin/report-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <a href="<?= base_url() ?>/admin/report" class="nav-link" data-key="t-analytics">Report Bug List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link menu-link" href="#Help" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Help">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Help Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="Help" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a href="<?= base_url() ?>/admin/help-category" class="nav-link" data-key="t-analytics">Category</a>
                                        <a href="<?= base_url() ?>/admin/help" class="nav-link" data-key="t-analytics">Help List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#stage" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="stage">
                                 <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Stage Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="stage" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/stage" class="nav-link" data-key="t-analytics">view</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif ?>

                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= base_url() ?>/admin/country-management">
                               <i class="bx bx-book-content"></i> <span data-key="t-dashboards">Country Management</span>
                            </a>
                            
                        </li> -->
                       <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#feedback" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="feedback">
                               <i class="bx bx-book-content"></i> <span data-key="t-dashboards">Feedback</span>
                            </a>
                            <div class="menu-dropdown collapse" id="feedback" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/feedback" class="nav-link" data-key="t-analytics">View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#post" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="post">
                               <i class="bx bx-book-content"></i> <span data-key="t-dashboards">Post Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="post" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/post" class="nav-link" data-key="t-analytics">View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item" style="display: none;">
                            <a class="nav-link menu-link" href="#prompt" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="prompt">
                                <i class="bx bx-list-ul"></i> <span data-key="t-dashboards">Prompt Management</span>
                            </a>
                            <div class="menu-dropdown collapse" id="prompt" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/admin/prompt" class="nav-link" data-key="t-analytics">view</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                         <li class="nav-item">
                         <a class="nav-link menu-link" href="#state" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="state">
                            <i class="bx bx-category"></i> <span data-key="t-dashboards">State/City Management</span>
                         </a>
                           <div class="menu-dropdown collapse" id="state" style="">
                              <ul class="nav nav-sm flex-column">
                                  <li class="nav-item">
                                      <a href="<?= base_url() ?>/admin/state" class="nav-link" data-key="t-analytics">State</a>
                                        <a href="<?= base_url() ?>/admin/city" class="nav-link" data-key="t-analytics">City</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                       <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Apps</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="apps-calendar.html" class="nav-link" data-key="t-calendar"> Calendar </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-chat.html" class="nav-link" data-key="t-chat"> Chat </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                                            Email
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEmail">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-mailbox.html" class="nav-link" data-key="t-mailbox"> Mailbox </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#sidebaremailTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaremailTemplates" data-key="t-email-templates">
                                                        Email Templates <span class="badge badge-pill bg-danger" data-key="t-new">New</span>
                                                    </a>
                                                    <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                                        <ul class="nav nav-sm flex-column">
                                                            <li class="nav-item">
                                                                <a href="apps-email-basic.html" class="nav-link" data-key="t-basic-action"> Basic Action </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="apps-email-ecommerce.html" class="nav-link" data-key="t-ecommerce-action"> Ecommerce Action </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">
                                            Ecommerce
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-products.html" class="nav-link" data-key="t-products"> Products </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-product-details.html" class="nav-link" data-key="t-product-Details"> Product Details </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-add-product.html" class="nav-link" data-key="t-create-product"> Create Product </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-orders.html" class="nav-link" data-key="t-orders">
                                                        Orders </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-order-details.html" class="nav-link" data-key="t-order-details"> Order Details </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-customers.html" class="nav-link" data-key="t-customers"> Customers </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-cart.html" class="nav-link" data-key="t-shopping-cart"> Shopping Cart </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-checkout.html" class="nav-link" data-key="t-checkout"> Checkout </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-sellers.html" class="nav-link" data-key="t-sellers">
                                                        Sellers </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-ecommerce-seller-details.html" class="nav-link" data-key="t-sellers-details"> Seller Details </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects" data-key="t-projects">
                                            Projects
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarProjects">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-projects-list.html" class="nav-link" data-key="t-list"> List
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-projects-overview.html" class="nav-link" data-key="t-overview"> Overview </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-projects-create.html" class="nav-link" data-key="t-create-project"> Create Project </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTasks" data-key="t-tasks"> Tasks
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarTasks">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-tasks-kanban.html" class="nav-link" data-key="t-kanbanboard">
                                                        Kanban Board </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-tasks-list-view.html" class="nav-link" data-key="t-list-view">
                                                        List View </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-tasks-details.html" class="nav-link" data-key="t-task-details"> Task Details </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCRM" data-key="t-crm"> CRM
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarCRM">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-crm-contacts.html" class="nav-link" data-key="t-contacts">
                                                        Contacts </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crm-companies.html" class="nav-link" data-key="t-companies">
                                                        Companies </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crm-deals.html" class="nav-link" data-key="t-deals"> Deals
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crm-leads.html" class="nav-link" data-key="t-leads"> Leads
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrypto" data-key="t-crypto"> Crypto
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarCrypto">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-crypto-transactions.html" class="nav-link" data-key="t-transactions"> Transactions </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crypto-buy-sell.html" class="nav-link" data-key="t-buy-sell">
                                                        Buy & Sell </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crypto-orders.html" class="nav-link" data-key="t-orders">
                                                        Orders </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crypto-wallet.html" class="nav-link" data-key="t-my-wallet">
                                                        My Wallet </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crypto-ico.html" class="nav-link" data-key="t-ico-list"> ICO
                                                        List </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-crypto-kyc.html" class="nav-link" data-key="t-kyc-application"> KYC Application </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices" data-key="t-invoices">
                                            Invoices
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarInvoices">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-invoices-list.html" class="nav-link" data-key="t-list-view">
                                                        List View </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-invoices-details.html" class="nav-link" data-key="t-details">
                                                        Details </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-invoices-create.html" class="nav-link" data-key="t-create-invoice"> Create Invoice </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTickets" data-key="t-supprt-tickets">
                                            Support Tickets
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarTickets">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-tickets-list.html" class="nav-link" data-key="t-list-view">
                                                        List View </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-tickets-details.html" class="nav-link" data-key="t-ticket-details"> Ticket Details </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft" data-key="t-nft-marketplace">
                                            NFT Marketplace <span class="badge badge-pill bg-danger" data-key="t-new">New</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarnft">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="apps-nft-marketplace.html" class="nav-link" data-key="t-marketplace"> Marketplace </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-explore.html" class="nav-link" data-key="t-explore-now"> Explore Now </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-auction.html" class="nav-link" data-key="t-live-auction"> Live Auction </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-item-details.html" class="nav-link" data-key="t-item-details"> Item Details </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-collections.html" class="nav-link" data-key="t-collections"> Collections </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-creators.html" class="nav-link" data-key="t-creators"> Creators </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-ranking.html" class="nav-link" data-key="t-ranking"> Ranking </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-wallet.html" class="nav-link" data-key="t-wallet-connect"> Wallet Connect </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="apps-nft-create.html" class="nav-link" data-key="t-create-nft"> Create NFT </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li> -->


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">