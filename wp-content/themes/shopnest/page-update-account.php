<?php get_header() ?>
<section class='form-section'>
    <div class="form-card card">

        <h1> <?php echo get_the_title(); ?></h1>

        <form class='form card' id='updateForm'>
            <div class="form-group">
                <label for="Iname">First Name</label>
                <input type="text" class="form-control" id="first_name" aria-describedby="nameHelp"
                    placeholder="Enter your first name" name=' name'>
            </div>
            <div class="form-group">
                <label for="Iname">Last Name</label>
                <input type="text" class="form-control" id="last_name" aria-describedby="nameHelp"
                    placeholder="Enter your last name" name=' name'>
            </div>
            <div class="form-group">
                <label for="InputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="Iname">Avatar Upload</label>

                <input class="form-control" type="file" name="image" id="getImage" required
                    onchange="previewImage(event)">
                <!-- <input class="form-control" type="file" name="image" id="getImage" required> -->
                <img src="" id="output" class="rounded float-left img-thumbnail w-25 ">

            </div>

            <button type="submit" class=" btn btn-info">UPDATE ACCOUNT</button>
        </form>



        <script>

        </script>

    </div>
</section>
<?php get_footer() ?>