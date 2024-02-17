

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>login page</title>
    <link rel="stylesheet" href="additems.css">



</head>

<body>

    <form action="save_items.php" method="post"    enctype="multipart/form-data">
  

        <div id="reg">
        <a href="inventry.php"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a> 
            <br>
            <ul class="ul1">
                <label class="la1"> Add Items :</label>
                <br>
                <br>
                <br>

                <label class="la2"></label>
                <br><br>

                <label class="la3">Item Name :</label><br>
                <input type="text" class="c1" name="Iname" placeholder="......." required>
                <br><br> <br> <br>

                <label class="la3">Catagoery :</label><br>
                <select name ="item" required>
                    <option value="HEART">HEART</option>
                    <option value="CENTRAL NERVOUS SYSTEM">CENTRAL NERVOUS SYSTEM</option>
                    <option value="EAR, NOSE, THROAT">EAR, NOSE, THROAT</option>
                    <option value="DIABETES"> DIABETES</option>
                    <option value="EYE">EYE</option>
                    <option value="GASTRO INTESTINAL SYSTEM"> GASTRO INTESTINAL SYSTEM</option>
                    <option value="MALIGNANT DISEASE & IMMUNOSUPPRESSIONS">MALIGNANT DISEASE & IMMUNOSUPPRESSIONS</option>
                    <option value="FIRST AID">FIRST AID</option>
                    <option value="HEALTH DEVICES">HEALTH DEVICES</option>
                    <option value=" SUPPORTS & BRACES"> SUPPORTS & BRACES</option>
                    <option value="EYES & EARS">EYES & EARS</option>
                    <option value="COUGH, COLD & ALLERGY">COUGH, COLD & ALLERGY</option>
                    <option value="DIET & NUTRITION">DIET & NUTRITION</option>
                    <option value="BEAUTY SUPPLEMENTS">BEAUTY SUPPLEMENTS</option>
                    <option value="ADULT & DIABETIC CARE">ADULT & DIABETIC CARE</option>
                    <option value="NOURISHMENT">NOURISHMENT</option>
                    <option value="SKIN CARE">SKIN CARE</option>
                    <option value="GSE">GSE</option>
                </select>
                <br><br><br><br>

                <label class="la3">Quantity :</label><br>
                <input type="number" class="c1" name="qty" required>

                <br><br> <br> <br>

                <label class="la3">Brand Name  :</label><br>
                <input type="text" class="c1" name="brand_name" required>
                <br><br> <br> <br>

                <label class="la3">price:</label><br>
                <input type="number" class="c1" name="price" required>

                <br><br> <br> <br>

                <label class="la3">Image:</label><br>
                <input type="file" class="c1" name="img" required  accept=".jpg ,.jpeg ,.png , image/*">
                <br><br> <br> <br>

               
                <input type="submit" id="btn1"  style="font-size: 25px;"name="submit">



            </ul>







        </div>
    </form>


</body>

</html>