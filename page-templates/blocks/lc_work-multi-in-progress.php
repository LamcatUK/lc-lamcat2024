<style>
    .project_images {
        display: block;
        position: relative;
        aspect-ratio: 16 / 9;
        width: 200px;
    }

    .project_images img {
        position: absolute;
        aspect-ratio: 16 / 9;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        object-fit: cover;
    }
</style>
<section class="work">
    <div class="container-xl">
        <ul class="nav nav-tabs" id="workTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="client-tab" data-bs-toggle="tab" data-bs-target="#client" type="button" role="tab" aria-controls="client" aria-selected="true">Types of Client</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="work-tab" data-bs-toggle="tab" data-bs-target="#work" type="button" role="tab" aria-controls="work" aria-selected="false">Types of Work</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">All Projects</button>
            </li>
        </ul>

        <div class="tab-content" id="workTabContent">
            <div class="tab-pane fade gallery show active" id="client" role="tabpanel" aria-labelledby="client-tab">
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
                            echo '<div class="project_images">';
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
            </div>
            <div class="tab-pane fade" id="work" role="tabpanel" aria-labelledby="work-tab">
                by work
            </div>
            <div class="tab-pane fade gallery" id="all" role="tabpanel" aria-labelledby="all-tab">
                <?php
                $q = new WP_Query(array(
                    'post_type' => 'work',
                    'posts_per_page' => -1
                ));
                while ($q->have_posts()) {
                    $q->the_post();

                    $work_type_terms = wp_get_post_terms(get_the_ID(), 'work-type');
                    $client_type_terms = wp_get_post_terms(get_the_ID(), 'client-type');

                    $work_type_classes = array_map(function ($term) {
                        return $term->slug;
                    }, $work_type_terms);
                    $client_type_classes = array_map(function ($term) {
                        return $term->slug;
                    }, $client_type_terms);

                    $work_type_class = implode(' ', $work_type_classes);
                    $client_type_class = implode(' ', $client_type_classes);

                ?>
                    <a href="<?= get_the_permalink() ?>" class="work__card" data-work-type="<?= esc_attr($work_type_class) ?>" data-client-sector="<?= esc_attr($client_type_class) ?>">
                        <?= get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'mb-2')) ?>
                        <?= get_the_title() ?>
                    </a>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>
<script>
    // JavaScript: script.js
    document.addEventListener('DOMContentLoaded', function() {
        const workTypeFilter = document.getElementById('work-type-filter');
        const clientSectorFilter = document.getElementById('client-sector-filter');
        const cards = document.querySelectorAll('.work__card');

        // console.log(cards); // Debugging: Check if the cards are selected properly

        function filterCards() {
            const selectedWorkType = workTypeFilter.value;
            const selectedClientSector = clientSectorFilter.value;

            cards.forEach(card => {
                const cardWorkTypes = card.getAttribute('data-work-type');
                const cardClientSector = card.getAttribute('data-client-sector');

                // console.log('Work Types:', cardWorkTypes);
                // console.log('Client Sector:', cardClientSector);

                // Continue with the filter logic
                const matchesWorkType = (workTypeFilter.value === 'all' || cardWorkTypes.includes(workTypeFilter.value));
                const matchesClientSector = (clientSectorFilter.value === 'all' || cardClientSector.includes(clientSectorFilter.value));

                if (matchesWorkType && matchesClientSector) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

        }

        // Attach the filter function to both filter dropdowns
        workTypeFilter.addEventListener('change', filterCards);
        clientSectorFilter.addEventListener('change', filterCards);

        // Initial filtering on page load
        filterCards();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sectorContainers = document.querySelectorAll('.project_images'); // Get all .sector_images containers

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