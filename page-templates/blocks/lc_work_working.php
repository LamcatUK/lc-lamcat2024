<section class="work">
    <div class="container-xl">
        <div class="filters">
            <div class="row">
                <div class="col-md-4">
                    <label for="work-type-filter">Work Type:</label>
                    <select id="work-type-filter" class="form-select">
                        <option value="all">All</option>
                        <?php
                        // Fetch the terms from the 'work-type' taxonomy
                        $work_types = get_terms(array(
                            'taxonomy' => 'work-type',
                            'hide_empty' => true,
                        ));

                        // Loop through each work type term and create an option element
                        if (! empty($work_types) && ! is_wp_error($work_types)) {
                            foreach ($work_types as $work_type) {
                                echo '<option value="' . esc_attr($work_type->slug) . '">' . esc_html($work_type->name) . ' (' . $work_type->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="client-sector-filter">Client Sector:</label>
                    <select id="client-sector-filter" class="form-select">
                        <option value="all">All</option>
                        <?php
                        // Fetch the terms from the 'client-type' taxonomy
                        $client_sectors = get_terms(array(
                            'taxonomy' => 'client-type',
                            'hide_empty' => true,
                        ));

                        // Loop through each client sector term and create an option element
                        if (! empty($client_sectors) && ! is_wp_error($client_sectors)) {
                            foreach ($client_sectors as $client_sector) {
                                echo '<option value="' . esc_attr($client_sector->slug) . '">' . esc_html($client_sector->name) . ' (' . $client_sector->count . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 align-items-center justify-content-end gap-4 d-flex filter-order">
                    <label>
                        <input type="radio" name="sort" value="chronological" checked> Chronological
                    </label>
                    <label>
                        <input type="radio" name="sort" value="alphabetical"> Alphabetical
                    </label>
                </div>
            </div>
        </div>
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

            ?>
                <a href="<?= get_the_permalink() ?>" class="work__card" data-work-type="<?= esc_attr($work_type_class) ?>" data-client-sector="<?= esc_attr($client_type_class) ?>" data-title="<?= esc_attr(get_the_title()) ?>">
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
<script>
    // JavaScript: script.js
    document.addEventListener('DOMContentLoaded', function() {
        const workTypeFilter = document.getElementById('work-type-filter');
        const clientSectorFilter = document.getElementById('client-sector-filter');
        const cards = Array.from(document.querySelectorAll('.work__card')); // Convert NodeList to Array for sorting
        const sortOptions = document.querySelectorAll('input[name="sort"]'); // Sorting options (radio buttons)
        const gallery = document.querySelector('.gallery'); // The container holding the cards

        function filterCards() {
            const selectedWorkType = workTypeFilter.value;
            const selectedClientSector = clientSectorFilter.value;

            cards.forEach(card => {
                const cardWorkTypes = card.getAttribute('data-work-type');
                const cardClientSector = card.getAttribute('data-client-sector');

                // Filter logic
                const matchesWorkType = (selectedWorkType === 'all' || cardWorkTypes.includes(selectedWorkType));
                const matchesClientSector = (selectedClientSector === 'all' || cardClientSector.includes(selectedClientSector));

                if (matchesWorkType && matchesClientSector) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

            // After filtering, sort the visible cards
            sortCards();
        }

        function sortCards() {
            const selectedSort = document.querySelector('input[name="sort"]:checked').value; // Get the selected sort option
            const visibleCards = cards.filter(card => !card.classList.contains('hidden')); // Get visible cards

            if (selectedSort === 'alphabetical') {
                visibleCards.sort((a, b) => a.getAttribute('data-title').localeCompare(b.getAttribute('data-title')));
            } else {
                // Assuming the cards are in chronological order in the original HTML by default,
                // no sorting is necessary for chronological order as we can preserve the default DOM order.
                visibleCards.sort((a, b) => a.dataset.index - b.dataset.index); // Sort by original index (optional if HTML order matters)
            }

            // Re-append sorted visible cards to the gallery
            visibleCards.forEach(card => gallery.appendChild(card));
        }

        // Attach the filter function to both filter dropdowns
        workTypeFilter.addEventListener('change', filterCards);
        clientSectorFilter.addEventListener('change', filterCards);

        // Attach the sorting function to the radio buttons
        sortOptions.forEach(option => {
            option.addEventListener('change', sortCards);
        });

        // Initially assign index data attributes for chronological sorting
        cards.forEach((card, index) => {
            card.setAttribute('data-index', index);
        });

        // Initial filtering on page load
        filterCards();
    });
</script>