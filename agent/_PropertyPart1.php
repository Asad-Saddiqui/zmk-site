<div class="rounded-top p-4 bg-white border">
    <div class="row col-md-12 col-sm-12 col-lg-12">


        <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start" style="color: black;font-weight: 900;font-size:20px;">

            Location and Purpose
        </div>
        <div class="col-lg-9 col-sm-12 col-md-8 mt-2 text-center text-sm-start">
            <i class="fa fa-user me-2"></i> <a href="#" style="color:black;">
                Select Purpose</a> <br>



            <input type="radio" class="btn-check1" value="Sale" hidden onclick="for_sell()" checked name="purpose" id="option5" autocomplete="off">
            <label class="btnsecondary1 mx-2 my-2 text-dark" for="option5" onclick=""><i class="fa fa-home me-2"></i>&nbsp;Sell</label>
            <input type="radio" class="btn-check1 " hidden onclick="for_rent()" value="Rent" name="purpose" id="option4" autocomplete="off">
            <label class="btnsecondary1 mx-2 my-2 text-dark" for="option4" onclick=""> <i class="fa fa-home me-2"></i>&nbsp;Rent</label>
            <br>
            <br>
            <i class="fa fa-building me-2"></i> <a href="#" style="color:black;">
                Select Property Type
            </a>
            <br>
            <br>
            <input type="radio" class="btn-check" name="propertyType" value="Home" id="home_1" autocomplete="off" checked>
            <label class="btnsecondary text-dark mx-3" for="home_1" onclick="myFunction()">&nbsp;Home</label>
            <input type="radio" class="btn-check" value="Plot" name="propertyType" id="plot_1" autocomplete="off">
            <label class="btnsecondary text-dark mx-3" for="plot_1" onclick="myFunction2()">&nbsp;Plots</label>
            <input type="radio" class="btn-check " value="Commercial" name="propertyType" id="Commercial_1" autocomplete="off">
            <label class="btnsecondary text-dark mx-3" for="Commercial_1" onclick="myFunction3()">&nbsp;Commercial</label>



            <hr style="color: black;">
            <div id="home" style="display:block">


                <input type="radio" class="btn-check3" hidden value="House" name="propertySubtype" id="option6" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option6" onclick=""> &nbsp;House</label>
                <input type="radio" class="btn-check3" hidden value="Flat" name="propertySubtype" id="option7" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3 mx-1 my-2" for="option7" onclick=""> &nbsp;Flat</label>
                <input type="radio" class="btn-check3" hidden value="Upper Portion" name="propertySubtype" id="option8" autocomplete="off">
                <label class="btnsecondary3 border1  text-dark mx-3 mx-1 my-2" for="option8" onclick=""> &nbsp;Upper Portion</label>
                <input type="radio" class="btn-check3" hidden value="Lower Portion" name="propertySubtype" id="option9" autocomplete="off">
                <label class="btnsecondary3 border1  text-dark mx-3 mx-1 my-2" for="option9" onclick=""> &nbsp;Lower Portion</label>
                <input type="radio" class="btn-check3" hidden value="Farm House" name="propertySubtype" id="option10" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option10" onclick="">
                    &nbsp;Farm House</label>
                <input type="radio" class="btn-check3" hidden value="Room" name="propertySubtype" id="option11" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option11" onclick="">
                    &nbsp;Room</label>
                <input type="radio" class="btn-check3" hidden value="Penthouse" name="propertySubtype" id="option12" autocomplete="off">
                <label class="btnsecondary3 border1  text-dark mx-3 mx-1 my-2" for="option12" onclick="">
                    &nbsp;Penthouse</label>



            </div>
            <div id="plot" style="display:none">

                <input type="radio" class="btn-check3" hidden value="Residitional Plot" name="propertySubtype" id="option13" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option13" onclick="">
                    &nbsp;Residitional
                    Plot</label>
                <input type="radio" class="btn-check3" hidden value="Agricultare Land" name="propertySubtype" id="option14" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option14" onclick="">
                    &nbsp;Agricultare
                    Land</label>
                <input type="radio" class="btn-check3" hidden value="Commercial Plot" name="propertySubtype" id="option15" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option15" onclick="">
                    &nbsp;Commercial Plot</label>
                <input type="radio" class="btn-check3" hidden value="Plot File" name="propertySubtype" id="option16" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option16" onclick="">
                    &nbsp;Plot File</label>
                <input type="radio" class="btn-check3" hidden value=" Plot Form" name="propertySubtype" id="option17" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option17" onclick="">
                    &nbsp;Plot Form</label>


                <!-- <button value="Sell" class="btn my-1" style="border:1px solid black;"><i class="fa fa-home me-2" ></i> &nbsp;Penthouse</button> -->
            </div>
            <div id="comercial" style="display:none">

                <input type="radio" class="btn-check3" hidden value="Office" name="propertySubtype" id="option18" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option18" onclick="">
                    &nbsp;Office
                </label>
                <input type="radio" class="btn-check3" hidden value="Shop" name="propertySubtype" id="option19" autocomplete="off">
                <label class="btnsecondary3 border1  text-dark mx-3 mx-1 my-2" for="option19" onclick="">
                    &nbsp;Shop
                </label>
                <input type="radio" class="btn-check3" hidden value="Wherehouse" name="propertySubtype" id="option20" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option20" onclick="">
                    &nbsp; Wherehouse</label>
                <input type="radio" class="btn-check3" hidden value="Factory" name="propertySubtype" id="option21" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option21" onclick="">
                    &nbsp;Factory</label>
                <input type="radio" class="btn-check3" hidden value="Building" name="propertySubtype" id="option22" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option22" onclick="">
                    &nbsp;Building</label>
                <input type="radio" class="btn-check3" hidden value="...Other" name="propertySubtype" id="option23" autocomplete="off">
                <label class="btnsecondary3 border1 text-dark mx-3  mx-1 my-2" for="option23" onclick="">
                    &nbsp;...Other</label>
                <!-- <button value="Sell" class="btn my-1" style="border:1px solid black;"><i class="fa fa-home me-2" ></i> &nbsp;Penthouse</button> -->
            </div>
            <div class="form-group">
                <label for="validationServer011" class="form-label text-dark">City</label>
                <input type="text" class="form-control bg-white text-dark <?php  ?>" name="city" placeholder="Enter City" id="validationServer011" value="">
                <div class="<?php  ?>">
                    <?php  ?>
                </div>

            </div>
            <div class="form-group">
                <label for="validationServer012" class="form-label text-dark">Location</label>
                <input type="text" class="form-control bg-white text-dark <?php  ?> " placeholder=" Please Enter embeded map url " name=" location" id="validationServer012" value="">
                <div class="<?php  ?>">
                    <?php ?>
                </div>

            </div>

        </div>



    </div>
</div>
<script>
    function customButtonClick() {
        // Now submit the form using AJAX
        var formData = $("#myForm").serialize();

        $.ajax({
            type: "POST",
            url: "_addproperty.php", // Specify the PHP script to handle the insertion
            data: formData,
            success: function(response) {
                $("#result").html(response);
            }
        });
    }
</script>