<?php
get_header();  // Load WordPress

if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']);
    // Fetch food item details using $food_id and display the edit form
    echo $post_id;
    // Get Post Title
    $product_name = get_the_title($post_id);
    $description = get_post_field('post_content', $post_id);
    $price = get_post_meta($post_id, '_product_price', true);
    $discount_price = get_post_meta($post_id, '_product_discount_price', true);
    $quantity = get_post_meta($post_id, '_product_quantity', true);
    $posted_by = get_post_meta($post_id, '_product_posted_by', true);

    $product_image = get_the_post_thumbnail_url($post_id, 'full');
    $author_id = get_the_author_meta('ID');

    // get_template_part('template-parts/food', 'edit');
}

?>


<section class='form-section'>
    <div class="form-card card" id='form-div'>

        <h1 class='card-title'> Edit Food</h1>

        <form class=' form card' id='edit_custom_post_form'>
            <div class=" form-group">
                <label for="Iname">Food Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="nameHelp"
                    placeholder="Enter your first name" name='title' value=" <?php echo $product_name; ?> ">
            </div>
            <div class="form-group">
                <label for="Iname">Description</label>
                <textarea type="text" class="form-control" id="description" aria-describedby="nameHelp"
                    placeholder="Write something about the food"
                    name='description'> <?php echo $description ?> </textarea>
            </div>
            <div class="form-group">
                <label for="Iname">Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="nameHelp" placeholder="Price"
                    name=' price' value=<?php echo $price; ?>>
            </div>
            <div class="form-group">
                <label for="Iname">Discount</label>
                <input type="number" class="form-control" id="discount" aria-describedby="nameHelp"
                    placeholder="Discount" name='Discount' value=<?php echo $discount_price; ?>>
            </div>
            <div class="form-group">
                <label for="Iname">Quantity</label>
                <input type="number" class="form-control" id="quantity" aria-describedby="nameHelp"
                    placeholder="Quantity" name='quantity' value=<?php echo $quantity ?>>
            </div>
            <div class="form-group">
                <label for="Iname">Image Upload</label>

                <input class="form-control" type="file" name="image" id="getImage" required
                    onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">
                <!-- <input class="form-control" type="file" name="image" id="getImage" required> -->
                <img src="<?php echo $product_image ?>" id="output" class="rounded float-left img-thumbnail w-25 ">

            </div>
            <input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id ?>">

            <button type="submit" class=" btn btn-info">UPDATE FOOD ITEM</button>
        </form>

    </div>
</section>

<?php
get_footer();  // Load WordPress footer
?>