function post_cate_short($attr) {

    $postItem = '';

    $post_array = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $attr['limit'], 'order' => 'ASC', 'category_name' => $attr['categories-slug']));
    
    $postItem .= '<div class="'.$attr['class'].'">';
    $count = 1;
    while($post_array->have_posts()): $post_array->the_post();

    $categories = get_the_category(get_the_ID());

    $postItem .= '<div class="post-item">';
    
        $postItem .= '<div class="post-img"><a href="'.get_the_permalink().'">'.get_the_post_thumbnail(get_the_ID(),'thumbnail').'</a></div>';
    
        $postItem .= '<div class="post-detail">';
            $postItem .= '<div class="post_number">'.$count.'</div>';
            $postItem .= '<div class="post_content">';
                $postItem .= '<h5>';
                            foreach($categories as $cat){
                $postItem .=  '<a href="'.get_category_link($cat->term_id).'">'. $cat->name .'</a>, ';
                            }
                $postItem .= '</h5>';
                $postItem .= '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
                $postItem .= '<div class="author-date">'.get_the_author_meta('nickname').', '.get_the_date('F j, Y').'</div>';
            $postItem .= '</div>';
        $postItem .= '</div>';

    $postItem .= '</div>';

    $count++; endwhile;

    $postItem .= '</div>';

    return $postItem;

}

add_shortcode('post_short', 'post_cate_short');
