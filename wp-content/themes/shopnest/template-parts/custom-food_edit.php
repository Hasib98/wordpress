<section class='form-section'>
    <div class="form-card card" id='form-div'>

        <h1 class='card-title'> Edit Food</h1>

        <form class=' form card' id='custom_post_form'>
            <div class=" form-group">
                <label for="Iname">Food Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="nameHelp"
                    placeholder="Enter your first name" name='title' value="S M ">
            </div>
            <div class="form-group">
                <label for="Iname">Description</label>
                <textarea type="text" class="form-control" id="description" aria-describedby="nameHelp"
                    placeholder="Write something about the food"
                    name='description'>The aroma of freshly baked bread wafting through the kitchen, the satisfying crunch of a crisp apple, the burst of flavor from a perfectly ripe mango</textarea>
            </div>
            <div class="form-group">
                <label for="Iname">Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="nameHelp" placeholder="Price"
                    name=' price' value=40>
            </div>
            <div class="form-group">
                <label for="Iname">Discount</label>
                <input type="number" class="form-control" id="discount" aria-describedby="nameHelp"
                    placeholder="Discount" name='Discount' value=5>
            </div>
            <div class="form-group">
                <label for="Iname">Quantity</label>
                <input type="number" class="form-control" id="quantity" aria-describedby="nameHelp"
                    placeholder="Quantity" name='quantity' value=10>
            </div>
            <div class="form-group">
                <label for="Iname">Image Upload</label>

                <input class="form-control" type="file" name="image" id="getImage" required
                    onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">
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