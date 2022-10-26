   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>">
           <div class="sidebar-brand-icon rotate-n-15">
               <i class="">G</i>
           </div>
           <div class="sidebar-brand-text mx-3">Growth CRM</div>
       </a>


       <!-- Nav Item -->
       <?php
        $index = 0;
        foreach ($menu as $header => $menu_items) {
            $index++;
        ?>

           <hr class="sidebar-divider">


           <li class="nav-item ">
               <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse<?php echo $index ?>" aria-expanded="true" aria-controls="collapse<?php echo $index ?>">
                   <i class="fas fa-fw fa-cog"></i>
                   <span> <?php echo $header ?></span>
               </a>
               <div id="collapse<?php echo $index ?>" class="collapse " aria-labelledby="heading<?php echo $index ?>" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">
                       <h6 class="collapse-header"> <?php echo $header ?></h6>
                       <?php
                        foreach ($menu_items as $menu_item) {
                        ?>
                           <a class="collapse-item" href="<?php echo base_url() . $menu_item['url'] ?>">
                               <i class="<?php echo $menu_item['icons'] ?>"></i>
                               <span><?php echo $menu_item['name'] ?></span></a>
                       <?php }
                        ?>
                   </div>
               </div>
           </li>

       <?php
        } ?>




       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>

   </ul>
   <!-- End of Sidebar -->