<section class="reservation_section">
    <div class="container">
        <div class="contents">
            <h1 style="color:black;">Online Reservation</h1>
            <!-- <form class="reservation_form" id="reservationForm">
                <div class="input_fields_container">
                    <input class="reservation_inputs" type="text" id="name" placeholder="Your name" required>
                    <input class="reservation_inputs" type="tel" id="phone" placeholder="Phone number" required>
                    <input class="reservation_inputs" type="email" id="email" placeholder="Email Address" required>

                    <select class="reservation_inputs" id="persons" name="persons">
                        <option value="1">1 person</option>
                        <option value="2">2 persons</option>
                        <option value="3">3 persons</option>
                        <option value="4">4 persons</option>
                    </select>

                    <input class="reservation_inputs" type="date" id="date" required>
                    <input class="reservation_inputs" type="time" id="time" required>
                </div>
                <button class="form_submit_button" type="submit">Submit your Reservation</button>
            </form> -->

            <?php echo do_shortcode('[contact-form-7 id="4c8138c" title="reservation"]'); ?>



        </div>
    </div>
</section>