<?php
class Advanced_Product_Filter_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'advanced_product_filter_widget', 
            __('Advanced Product Filter', 'text_domain'), 
            array( 'description' => __( 'A Widget to filter products by custom attributes', 'text_domain' ), ) 
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        // Widget Content
        ?>
        <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
            <h4>Filter by Attributes</h4>
            
            <p>
                <label for="filter_color">Color</label>
                <select name="filter_color" id="filter_color">
                    <option value="">Select Color</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </p>
            
            <p>
                <label for="filter_size">Size</label>
                <select name="filter_size" id="filter_size">
                    <option value="">Select Size</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </p>
            
            <p>
                <label for="filter_min_price">Min Price</label>
                <input type="number" name="filter_min_price" id="filter_min_price" step="0.01" min="0" />
            </p>
            
            <p>
                <label for="filter_max_price">Max Price</label>
                <input type="number" name="filter_max_price" id="filter_max_price" step="0.01" min="0" />
            </p>
            
            <button type="submit">Filter</button>
        </form>
        <?php
        
        echo $args['after_widget'];
    }

    

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
}
?>
