<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register New Product | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/addProduct.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="font-family: Poppins, sans-serif;">

    <?php
    include "header.php";

    if (!isset($_SESSION['user'])) {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <div id="loader" >
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <div class="container" style="margin-top: 20px;">
        <ol class="breadcrumb bd" style="padding: 10px 15px;">
            <li class="breadcrumb-item"><a href="home.php"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="myProducts.php"><span>My Products</span></a></li>
            <li class="breadcrumb-item active"><span>Add Product</span></li>
        </ol>
        <div style="background: #ffffff;">
            <div class="row">
                <div class="col" style="padding: 30px 30px 0px 30px;">
                    <h1 class="text-center">Register New Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12  d-flex justify-content-center" style="padding: 15px;">
                    <p style="color: red; padding: 10px 25px; background-color: #ffeeee; text-align: center;" id="errorMsg" class="d-none">None</p>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col-12 col-lg-6 order-2 order-lg-1" style="padding: 20px;">

                    <input type="file" class="d-none" id="addImageUploader" multiple>
                    <label for="addImageUploader" class="col-12" onclick="addPChangeImg()">
                
                        <!-- Main Img -->
                        <div class="d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" style="height: 400px;border-style: dotted;" title="Add Image">
                            <div class="d-flex justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-images" style="font-size: 121px;">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                                </svg>
                            </div>
                            <div class="imgContainer d-none">
                                <img src="assets/img/s-l640%20(1).jpg" id="i0">
                            </div>
                        </div>
    
                        <!-- Sub Imgs -->
                        <div class="d-flex flex-row" style="margin-top: 20px;height: 90px;">
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Add Image">
                                <div class="d-flex justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                                <div class="imgContainer d-none">
                                    <img src="assets/img/s-l500%20(6).jpg" id="i1">
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Add Image">
                                <div class="d-flex justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                                <div class="imgContainer d-none">
                                    <img src="assets/img/s-l500%20(7).jpg" id="i2">
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Add Image">
                                <div class="d-flex justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                                <div class="d-none imgContainer">
                                    <img src="assets/img/s-l500%20(6).jpg" id="i3">
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 60px;" title="Add More Images">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                                </svg>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="col-12 col-lg-6 order-1 order-lg-2" style="padding: 20px;">
                    <div class="row">
                        <div class="col-12">
                            <input id="title" type="text" class="inputText text-center w" style="font-size: 20px;font-weight: bold;" placeholder="Add a title">
                        </div>
                        <div class="col-12" style="margin-top: 10px;">
                            <input id="price" type="number" class="inputText text-center w" style="font-size: 20px;font-weight: bold;" placeholder="$ Set Price">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select id="condition" class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                <option value="0" selected="">Choose Condition</option>
                                <?php
                                
                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;
                                for ($x = 0; $x < $condition_num; $x++) {
                                    $condition_data = $condition_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $condition_data['id']; ?>">
                                            <?php echo $condition_data['status']; ?>
                                        </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select id="category" class="selectOpt" style="width: 100%;padding: 10px 15px;" onchange="loadBrand()">
                                <option value="0" selected="">Choose Cateogry</option>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category` ");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $category_data['id']; ?>">
                                            <?php echo $category_data['type']; ?>
                                        </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <select id="brand" onchange="loadModel()" class="selectOpt" style="width: 100%;padding: 10px 15px;margin-bottom: 10px;">
                                <option value="0" selected="">Select Brand</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select id="model" class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                <option value="0" selected="">Select Model</option>
                            </select>
                        </div>
                        <div class="col">
                            <!-- Add New Brands & Models -->
                            <div class="row">
                                <div class="col-6">
                                    <button 
                                        onclick="checkCategory_selected()"
                                        class="btn addTypesBt" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted">
                                            <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                                        </svg>&nbsp;Add Brand
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button 
                                        onclick="checkBrand_selected()"
                                        class="btn addTypesBt" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted">
                                            <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                                        </svg>&nbsp;Add Model
                                    </button>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-6">
                                    <h6>Quantity</h6>
                                    <div class="input-group">
                                        <button onclick="changeQty('-', 50)" class="btn btn-dark" type="button">-</button>
                                        <input id="qty" class="form-control text-center" type="text" value="1">
                                        <button onclick="changeQty('+', 50)" class="btn btn-dark" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h6>Choose Colour</h6>
                                    <select id="color" class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                        <option value="0" selected="">Select Color</option>
                                        <?php
                                        $color_rs = Database::search("SELECT * FROM `color` ");
                                        $color_num = $color_rs->num_rows;
                                        for ($x = 0; $x < $color_num; $x++) {
                                            $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data['id']; ?>">
                                                    <?php echo $color_data['name']; ?>
                                                </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-6">
                                    <!-- blank -->
                                </div>
                                <div class="col-6">
                                    <button 
                                        data-bs-toggle='modal' data-bs-target='#addNewColour'
                                        class="btn addTypesBt" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted">
                                            <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                                        </svg>&nbsp;Add Colour
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 25px;">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h6>Delivery Cost&nbsp;</h6>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input id="cost" class="form-control" type="text">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 20px;">
                <div class="col" style="padding: 20px;">
                    <h3>Describe Your Product Briefly</h3>
                    <textarea rows="2" id="small_desc" class="form-control"></textarea>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col" style="padding: 20px;">
                    <h3>Add Product Description</h3>
                    <textarea rows="5" id="desc" class="form-control"></textarea>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col d-flex flex-column justify-content-around align-items-center flex-lg-row" style="padding: 0px 20px 20px 20px;">
                <button class="btn btBottom reset" type="button" data-bs-toggle="modal" data-bs-target="#confirmationtoReset">Clear All&nbsp;<i class="fa fa-undo"></i>&nbsp;</button>
                <button class="btn btBottom save" onclick="saveProduct()" type="button">Save my Product&nbsp;<i class="fas fa-save"></i></button>
            </div>
            </div>
        </div>
    </div>

    <!-- Successful -->
    <div class="toast fade hide" role="alert" id="productSuccessful">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            <p>Your Product was successfuly saved</p>
        </div>
    </div>

    <!-- Form Reset Confirmation -->
    <div class="modal fade" role="dialog" tabindex="-1" id="confirmationtoReset">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 38px;">
                    <p style="font-size: 23px;">Are You Sure you want to clear all the data ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button 
                        onclick='clearPage()'
                        class="btn btn-primary" type="button">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Brand Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="addNewBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 29px;">
                    <div>
                        <h6>Add New Brand for&nbsp;</h6>
                        <h2>'<span id='catName'></span>'</h2>
                    </div>
                    <hr>
                    <div style="padding: 15px 0px;">
                        <p>Enter the New Brand Name of your product</p>
                        <input id="newBrandName" type="text" class="addNewTextField" style="width: 100%;padding: 10px 15px;" placeholder="New Name">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button 
                            data-bs-dismiss="modal"
                            class="btn btn-light" type="button">Dismiss</button>
                        <button 
                            onclick="addNewBrand()"
                            class="btn btn-primary" type="button" style="margin-left: 11px;">
                            Add New Brand
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Model Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="addNewModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 29px;">
                    <div>
                        <h6>Add New Model for&nbsp;</h6>
                        <h2>'<span id='brandName'></span>'</h2>
                    </div>
                    <hr>
                    <div style="padding: 15px 0px;">
                        <p>Enter a New Model Name for your product</p>
                        <input id="newModelName" type="text" class="addNewTextField" style="width: 100%;padding: 10px 15px;" placeholder="New Name">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button 
                            data-bs-dismiss="modal"
                            class="btn btn-light" type="button">Dismiss</button>
                        <button 
                            onclick="addNewModel()"
                            class="btn btn-primary" type="button" style="margin-left: 11px;">
                            Add New Model
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add New Colour Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="addNewColour">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 29px;">
                    <div>
                        <h6>Add New</h6>
                        <h2>Colour</h2>
                    </div>
                    <hr>
                    <div style="padding: 15px 0px;">
                        <p>Enter a New Colour Name</p>
                        <input id="newColourName" type="text" class="addNewTextField" style="width: 100%;padding: 10px 15px;" placeholder="New Name">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button 
                            data-bs-dismiss="modal"
                            class="btn btn-light" type="button">Dismiss</button>
                        <button 
                            onclick="addNewColour()"
                            class="btn btn-primary" type="button" style="margin-left: 11px;">
                            Add New Colour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    include "footer.php";
    ?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>