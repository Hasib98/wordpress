<section class='form-section'>
    <div class="form-card card" id='form-div'>

        <h1 class='card-title'> Add New Food</h1>

        <form class=' form card' id='custom_post_form'>
            <div class=" form-group">
                <label for="Iname">Food Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="nameHelp"
                    placeholder="Add a food title" name='title'>
            </div>
            <div class="form-group">
                <label for="Iname">Description</label>
                <textarea type="text" class="form-control" id="description" aria-describedby="nameHelp"
                    placeholder="Write something about the food" name='description'></textarea>
            </div>
            <div class="form-group">
                <label for="Iname">Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="nameHelp" placeholder="Price"
                    name=' price'>
            </div>
            <div class="form-group">
                <label for="Iname">Discount</label>
                <input type="number" class="form-control" id="discount" aria-describedby="nameHelp"
                    placeholder="Discount" name='Discount'>
            </div>
            <div class="form-group">
                <label for="Iname">Quantity</label>
                <input type="number" class="form-control" id="quantity" aria-describedby="nameHelp"
                    placeholder="Quantity" name='quantity'>
            </div>
            <div class="form-group">
                <label for="Iname">Image Upload</label>

                <input class="form-control" type="file" name="image" id="getImage" required
                    onchange="previewImage(event)">
                <!-- <input class="form-control" type="file" name="image" id="getImage" required> -->
                <img src="" id="output" class="rounded float-left img-thumbnail w-25 ">

            </div>

            <button type="submit" class=" btn btn-info">CREATE FOOD ITEM</button>
        </form>






        <!-- <p>Already have an account? <span><a href="<?php echo get_template_directory_uri() . '/login   ' ?>">Login
                    here
                </a></span></p> -->
    </div>
</section>