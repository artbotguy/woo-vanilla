<?php
$description = get_bloginfo('description', 'display');
if ($description || is_customize_preview()) :
?>
  <div class="header-description"><?php echo $description; ?></div>
<?php
endif;
?>