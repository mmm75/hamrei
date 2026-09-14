<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">

    <label for="s" class="screen-reader-text">Search for:</label>

    <input
        type="search"
        id="s"
        name="s"
        value="<?php echo get_search_query(); ?>">

    <input
        type="submit"
        id="searchsubmit"
        value="Search">

</form>