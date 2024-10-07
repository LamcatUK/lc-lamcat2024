<style>
    .sector_images {
        display: block;
        position: relative;
        aspect-ratio: 4 / 3;
        width: 200px;
    }

    .sector_images img {
        position: absolute;
        aspect-ratio: 4 / 3;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        object-fit: cover;
    }
</style>
<?php
$client_sectors = get_terms(array(
    'taxonomy' => 'client-type',
    'hide_empty' => true,
));

if (!empty($client_sectors) && !is_wp_error($client_sectors)) {
    foreach ($client_sectors as $sector) {
        $args = array(
            'post_type' => 'work',
            'tax_query' => array(
                array(
                    'taxonomy' => 'client-type',
                    'field'    => 'slug',
                    'terms'    => $sector->slug,
                ),
            ),
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            echo '<div>' . esc_html($sector->name) . '</div>';
            echo '<div class="sector_images">';
            $vis = 'visible';
            while ($query->have_posts()) {
                $query->the_post();

                // Get the post thumbnail (featured image)
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'large', array('style' => 'visibility:' . $vis)); // Adjust the size as needed
                    $vis = 'hidden';
                }
            }
            echo '</div>';
        }

        // Restore original Post Data
        wp_reset_postdata();
    }
}

?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sectorContainers = document.querySelectorAll('.sector_images'); // Get all .sector_images containers

        sectorContainers.forEach(container => {
            const images = container.querySelectorAll('img'); // Get the images within the current container
            let currentImageIndex = 0;
            let interval;

            // Function to show the next image and hide the others within the current container
            function showNextImage() {
                images.forEach((img, index) => {
                    img.style.visibility = (index === currentImageIndex) ? 'visible' : 'hidden';
                });
                currentImageIndex = (currentImageIndex + 1) % images.length; // Cycle through the images
            }

            // Start cycling images on hover for the current container
            container.addEventListener('mouseenter', function() {
                interval = setInterval(showNextImage, 200); // Change every 1 second (adjust as needed)
            });

            // Stop cycling and leave the current image visible when unhovered
            container.addEventListener('mouseleave', function() {
                clearInterval(interval); // Stop the cycling
            });
        });
    });
</script>