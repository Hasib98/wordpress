<?php
/* Template Name: Reservation */
?>
<?php get_header(); ?>



<?php
// $location_section_group = get_field('location_section_group');
// var_dump($location_section_group);
// get_template_part('template-parts/section', 'contact_form');
 get_template_part('template-parts/section', 'reservation');


get_template_part('template-parts/section', 'location_address');

get_template_part('template-parts/section', 'newsletter');

?>






<?php get_footer(); ?>