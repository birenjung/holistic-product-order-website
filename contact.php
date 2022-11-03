<?php include("partials-front/menu.php"); ?>

    <div class="container-fluid p-4 mt--2 mb-5">
        <div class="container d-flex flex-column align-items-center">
            <h2 class="mb-4">Contact Us</h2>
            
            <form style="width:350px;" method="POST" class="booking p-3">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="c_name" placeholder="E.g. Manrani Rai" required>                                
                </div>                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="phone" placeholder="" required> 
                                                
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea cols="30" rows="3" class="form-control" name="message" placeholder="" required></textarea>                                
                </div>                                    
                <button name="submit" class="btn btn-outline-primary">Submit</button>
            </form>
        </div>
    </div>

<?php include("partials-front/footer.php"); ?>