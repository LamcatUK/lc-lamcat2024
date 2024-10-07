<section class="work">
    <div class="container-xl">
        <div class="filters">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <label for="work-type-filter">Work Type:</label>
                    <select id="work-type-filter" class="form-select">
                        <option value="all">Show All</option>
                        <?php
                        // Fetch the terms from the 'work-type' taxonomy
                        $work_types = get_terms(array(
                            'taxonomy' => 'work-type',
                            'hide_empty' => true,
                        ));

                        // Loop through each work type term and create an option element
                        if (! empty($work_types) && ! is_wp_error($work_types)) {
                            foreach ($work_types as $work_type) {
                                echo '<option value="' . esc_attr($work_type->slug) . '" data-name="' . esc_html($work_type->name) . '">' . esc_html($work_type->name) . ' (' . $work_type->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="client-sector-filter">Client Sector:</label>
                    <select id="client-sector-filter" class="form-select">
                        <option value="all">Show All</option>
                        <?php
                        // Fetch the terms from the 'client-type' taxonomy
                        $client_sectors = get_terms(array(
                            'taxonomy' => 'client-type',
                            'hide_empty' => true,
                        ));

                        // Loop through each client sector term and create an option element
                        if (! empty($client_sectors) && ! is_wp_error($client_sectors)) {
                            foreach ($client_sectors as $client_sector) {
                                echo '<option value="' . esc_attr($client_sector->slug) . '" data-name="' . esc_html($client_sector->name) . '">' . esc_html($client_sector->name) . ' (' . $client_sector->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 align-self-end">
                    <div class="button" id="reset-filters" type="button"><span>Reset Filters</span></div>
                </div>
                <div class="col-md-2 align-items-start justify-content-end d-flex flex-column sort-options">
                    <label>
                        <input type="radio" name="sort" value="chronological" checked> Chronological
                    </label>
                    <label>
                        <input type="radio" name="sort" value="alphabetical"> Alphabetical
                    </label>
                </div>
            </div>
        </div>
        <hr class="pb-5 mt-4">
        <div class="gallery">
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

                $post_date = get_the_date('Y-m-d'); // Format the date appropriately

            ?>
                <a href="<?= get_the_permalink() ?>" class="work__card" data-work-type="<?= esc_attr($work_type_class) ?>" data-client-sector="<?= esc_attr($client_type_class) ?>" data-title="<?= esc_attr(get_the_title()) ?>" data-date="<?= esc_attr($post_date) ?>">
                    <?= get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'mb-2')) ?>
                    <?= get_the_title() ?>
                </a>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php
$validCombinations = [];

// Fetch all client sectors and work types to create the valid combinations array
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
            // Initialize the array for this client sector
            $validCombinations[$sector->slug] = [
                'name' => $sector->name,
                'work_types' => []
            ];

            while ($query->have_posts()) {
                $query->the_post();
                $work_type_terms = wp_get_post_terms(get_the_ID(), 'work-type');

                foreach ($work_type_terms as $term) {
                    if (!isset($validCombinations[$sector->slug]['work_types'][$term->slug])) {
                        // Store both slug and name
                        $validCombinations[$sector->slug]['work_types'][$term->slug] = $term->name;
                    }
                }
            }
        }

        wp_reset_postdata();
    }
}

// echo json_encode($validCombinations);
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const workTypeFilter = document.getElementById('work-type-filter');
        const clientSectorFilter = document.getElementById('client-sector-filter');
        const resetButton = document.getElementById('reset-filters');
        const sortOptions = document.querySelectorAll('input[name="sort"]');
        const cards = Array.from(document.querySelectorAll('.work__card')); // Convert NodeList to Array
        const gallery = document.querySelector('.gallery');

        // Simulate validCombinations based on the structure provided
        const validCombinations = <?php echo json_encode($validCombinations); ?>;

        // Utility function to decode HTML entities
        function decodeHtmlEntities(text) {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = text;
            return textarea.value;
        }

        // Initialize filters with proper names
        function initializeFilters() {
            // Initialize Work Type filter
            const workTypeOptions = workTypeFilter.querySelectorAll('option');
            workTypeOptions.forEach(option => {
                const workTypeSlug = option.value;
                if (workTypeSlug === 'all') {
                    option.textContent = 'Show All';
                } else {
                    const workTypeName = Object.keys(validCombinations).reduce((acc, sector) => {
                        return validCombinations[sector].work_types[workTypeSlug] || acc;
                    }, workTypeSlug);
                    option.textContent = decodeHtmlEntities(workTypeName);
                }
            });

            // Initialize Client Sector filter
            const clientSectorOptions = clientSectorFilter.querySelectorAll('option');
            clientSectorOptions.forEach(option => {
                const clientSectorSlug = option.value;
                if (clientSectorSlug === 'all') {
                    option.textContent = 'Show All';
                } else {
                    option.textContent = decodeHtmlEntities(validCombinations[clientSectorSlug]?.name || clientSectorSlug);
                }
            });

            filterCards(); // Filter cards initially
            filterWorkTypes(); // Set up work type filters initially
            filterClientSectors(); // Set up client sector filters initially
        }

        // Update work types based on the selected client sector
        function filterWorkTypes() {
            const selectedSector = clientSectorFilter.value;
            const workTypeOptions = workTypeFilter.querySelectorAll('option');
            const validWorkTypes = validCombinations[selectedSector]?.work_types || {};

            workTypeOptions.forEach(option => {
                const workTypeValue = option.value;

                if (workTypeValue === 'all') {
                    option.textContent = 'Show All';
                    option.disabled = false;
                } else {
                    const workTypeName = decodeHtmlEntities(validWorkTypes[workTypeValue] || option.dataset.name || workTypeValue);

                    // Enable or disable based on valid combinations
                    option.disabled = !(validWorkTypes[workTypeValue] || selectedSector === 'all');
                    option.textContent = `${workTypeName} (${cards.filter(card => {
                    const cardWorkTypes = card.getAttribute('data-work-type').split(' ');
                    const cardClientSector = card.getAttribute('data-client-sector');
                    return cardWorkTypes.includes(workTypeValue) && (selectedSector === 'all' || cardClientSector.includes(selectedSector));
                }).length})`;
                }
            });
        }

        // Update client sectors based on the selected work type
        function filterClientSectors() {
            const selectedWorkType = workTypeFilter.value;
            const clientSectorOptions = clientSectorFilter.querySelectorAll('option');

            clientSectorOptions.forEach(option => {
                const clientSectorValue = option.value;
                const validWorkTypesForSector = validCombinations[clientSectorValue]?.work_types || {};

                if (clientSectorValue === 'all') {
                    option.textContent = 'Show All';
                    option.disabled = false;
                } else {
                    const clientSectorName = decodeHtmlEntities(validCombinations[clientSectorValue]?.name || clientSectorValue);

                    // Enable or disable based on valid work types
                    option.disabled = !(validWorkTypesForSector[selectedWorkType] || selectedWorkType === 'all');
                    option.textContent = `${clientSectorName} (${cards.filter(card => {
                    const cardWorkTypes = card.getAttribute('data-work-type').split(' ');
                    const cardClientSector = card.getAttribute('data-client-sector');
                    return cardClientSector.includes(clientSectorValue) && (selectedWorkType === 'all' || cardWorkTypes.includes(selectedWorkType));
                }).length})`;
                }
            });
        }

        // Filter the cards based on selected filters
        function filterCards() {
            const selectedWorkType = workTypeFilter.value;
            const selectedClientSector = clientSectorFilter.value;

            cards.forEach(card => {
                const cardWorkTypes = card.getAttribute('data-work-type').split(' ');
                const cardClientSector = card.getAttribute('data-client-sector');

                const matchesWorkType = (selectedWorkType === 'all' || cardWorkTypes.includes(selectedWorkType));
                const matchesClientSector = (selectedClientSector === 'all' || cardClientSector.includes(selectedClientSector));

                card.classList.toggle('hidden', !(matchesWorkType && matchesClientSector));
            });

            applyCurrentSort();
        }

        // Apply the current sorting method
        function applyCurrentSort() {
            const selectedSort = document.querySelector('input[name="sort"]:checked').value;
            if (selectedSort === 'chronological') {
                sortChronologically();
            } else {
                sortAlphabetically();
            }
            renderCards();
        }

        // Sort alphabetically
        function sortAlphabetically() {
            cards.sort((a, b) => a.textContent.trim().localeCompare(b.textContent.trim()));
        }

        // Sort by date (newest first)
        function sortChronologically() {
            cards.sort((a, b) => new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date')));
        }

        // Render sorted cards
        function renderCards() {
            gallery.innerHTML = '';
            cards.forEach(card => gallery.appendChild(card));
        }

        // Event listeners
        workTypeFilter.addEventListener('change', function() {
            filterCards();
            filterClientSectors();
        });

        clientSectorFilter.addEventListener('change', function() {
            filterCards();
            filterWorkTypes();
        });

        resetButton.addEventListener('click', function() {
            workTypeFilter.value = 'all';
            clientSectorFilter.value = 'all';
            filterCards();
            filterWorkTypes();
            filterClientSectors();
        });

        sortOptions.forEach(radio => {
            radio.addEventListener('change', applyCurrentSort);
        });

        // Initialize on load
        initializeFilters();
    });
</script>