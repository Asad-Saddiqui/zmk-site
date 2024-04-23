   <div class=" rounded-top p-4 bg-secondary border">
       <?php
        if ($installment === false) {
        ?>
           <div id="forrent">
               <div class="row row col-md-12 col-sm-12 col-lg-12">
                   <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start" style="color: white;">

                       Price and Area
                   </div>
                   <div class="col-lg-9 col-sm-12 col-md-8 text-center row text-sm-start">
                       <div class="form-group col-lg-8">
                           <label for="validationServer011" class="form-label">Area Size</label>
                           <input type="text" class="form-control <?php  ?>" name="rent_area_size" id="validationServer011" value="">
                           <div class="<?php  ?>">
                               <?php ?>
                           </div>

                       </div>

                       <div class=" form-group col-lg-4 ">
                           <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">area size in</label>
                           <select class="form-select <?php  ?> " name="rent_area_size_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                               <option value="">Choose....</option>
                               <option value="Marla">Marla</option>
                               <option value="Sq.Ft.">Sq.Ft.</option>
                               <option value="Sq.M.">Sq.M.</option>
                               <option value="Sq.Yd.">Sq.Yd.</option>
                               <option value="Kanal">Kanal</option>

                           </select>
                           <div id="validationServer06Feedback" class="<?php   ?>  w-100 " style="text-align:left;">
                               <?php   ?>
                           </div>
                       </div>

                       <div class="form-group col-lg-8">
                           <label for="validationServer011" class="form-label">Monthly Rent</label>
                           <input type="text" class="form-control <?php   ?>" name="monthly_rent" id="validationServer011" value="">
                           <div class="<?php   ?>">
                               <?php   ?>
                           </div>

                       </div>

                       <div class=" form-group col-lg-4 ">
                           <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                           <select class="form-select <?php  ?> " name="monthly_rent_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                               <option value="">Choose....</option>
                               <option value="Pkr">Pkr</option>


                           </select>
                           <div id="validationServer06Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                               <?php  ?>
                           </div>
                       </div>



                   </div>
               </div>
           </div>
       <?php
        } else if ($installment === true) {
        ?>
           <div id="forsell">
               <div class="row bg-secondary">
                   <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start" style="color: white;
                                                    font-weight: 900;
                                                    font-size:20px;">

                       Price and Area
                   </div>
                   <div class="col-lg-9 col-sm-12 col-md-8 text-center text-sm-start">

                       <div class="form-group row">
                           <div class="form-group col-lg-8">
                               <label for="validationServer013" class="form-label">Area Size</label>
                               <input type="text" class="form-control <?php  ?>" name="area_size" id="validationServer013" value="">
                               <div class="<?php  ?>">
                                   <?php  ?>
                               </div>
                           </div>

                           <div class="col-lg-4 ">
                               <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">area size in</label>
                               <select class="form-select <?php  ?> " name="size_in__" id="validationServer06" aria-describedby="validationServer06Feedback">
                                   <option value="">Choose....</option>
                                   <option value="Marla">Marla</option>
                                   <option value="Sq.Ft.">Sq.Ft.</option>
                                   <option value="Sq.M.">Sq.M.</option>
                                   <option value="Sq.Yd.">Sq.Yd.</option>
                                   <option value="Kanal">Kanal</option>

                               </select>
                               <div id="validationServer06Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                   <?php  ?>
                               </div>
                           </div>

                       </div>
                       <div class="form-group row">
                           <div class="form-group col-lg-8">
                               <label for="validationServer013" class="form-label">Total Price</label>
                               <input type="text" class="form-control <?php  ?>" name="t_price_" id="validationServer013" value="">
                               <div class="<?php  ?>">
                                   <?php  ?>
                               </div>
                           </div>


                           <div class="col-lg-4 ">
                               <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                               <select class="form-select <?php  ?> " name="Price_t" id="validationServer07" aria-describedby="validationServer07Feedback">
                                   <option value="">Choose....</option>
                                   <option value="Pkr">Pkr</option>


                               </select>
                               <div id="validationServer07Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                   <?php  ?>
                               </div>
                           </div>
                       </div>
                       <label class="col-lg-6 col-form-label" style="color: white;
                                                        font-weight: 900;
                                                        font-size:20px;">Installment
                           available</label>
                       <div class="form-group row">
                           <div class="col-lg-9 ">
                               Enable if listing is available on installments
                               <?php
                                // echo $ins; 
                                ?>
                           </div>
                           <div class="col-lg-3 ">
                               <div class="form-check form-switch">
                                   <input class="form-check-input" type="checkbox" value="Installment available" name="installments" onclick="installment()" id="flexSwitchCheckDefault" style="    background-color: #989d98;
                                                                height: 21px;
                                                                width: 44px;">
                               </div>

                           </div>
                       </div>
                       <div id="installment1">




                           <div class="form-group row">
                               <div class="form-group col-lg-8">
                                   <label for="validationServer013" class="form-label">Advance Amount</label>
                                   <input type="text" class="form-control <?php  ?>" name="advance_amount" id="validationServer013" value="">
                                   <div class="<?php  ?>">
                                       <?php  ?>
                                   </div>
                               </div>


                               <div class="col-lg-4 ">
                                   <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                   <select class="form-select <?php  ?> " name="advance_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                       <option value="">Choose....</option>
                                       <option value="Pkr">Pkr</option>


                                   </select>
                                   <div id="validationServer07Feedback" class="<?php ?>  w-100 " style="text-align:left;">
                                       <?php  ?>
                                   </div>
                               </div>
                           </div>

                           <div class="form-group col-lg-8">
                               <label for="validationServer013" class="form-label">No. of installment</label>
                               <input type="text" class="form-control <?php  ?>" name="n_installment" id="validationServer013" value="">
                               <div class="<?php  ?>">
                                   <?php  ?>
                               </div>
                           </div>


                           <div class="form-group row">
                               <div class="form-group col-lg-8">
                                   <label for="validationServer013" class="form-label">Monthly Amount</label>
                                   <input type="text" class="form-control <?php  ?>" name="monthly_amount" id="validationServer013" value="">
                                   <div class="<?php  ?>">
                                       <?php  ?>
                                   </div>
                               </div>


                               <div class="col-lg-4 ">
                                   <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                   <select class="form-select <?php  ?> " name="monthly_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                       <option value="">Choose....</option>
                                       <option value="Pkr">Pkr</option>


                                   </select>
                                   <div id="validationServer07Feedback" class="<?php  ?>  w-100 " style="text-align:left;">
                                       <?php  ?>
                                   </div>
                               </div>




                           </div>
                       </div>

                   </div>

               </div>
           </div>

       <?php
        }
        ?>





   </div>