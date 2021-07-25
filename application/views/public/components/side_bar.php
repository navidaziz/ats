

<div class="col-lg-4 sidebar-widgets">
					<div class="widget-wrap">
						
						
						
						
						<div class="single-sidebar-widget post-category-widget">
							
                            
                            
                            <ul class="unordered-list">
        <?php foreach($menu_pages as $menu_page){ ?>
        <?php if(count($menu_page->menu_sub_pages)>0){ ?>
        <li> <a  href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>"><?php echo $menu_page->page_name; ?></a>
          <ul >
           <?php foreach($menu_page->menu_sub_pages as $menu_sub_page){ ?>
             <li> <a  href="<?php echo base_url("page/view_page/".$menu_sub_page->page_id); ?>"><?php echo $menu_sub_page->page_name; ?></a>
             <?php } ?>
          </ul>
        </li>
        <?php }else{?>
         <li  > <a href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>"><?php echo $menu_page->page_name; ?></a>
        <?php } ?>
        
      <?php } ?>
      </ul>
      
						</div>
						
						
					</div>
				</div>
  