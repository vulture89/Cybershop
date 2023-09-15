function registerUser() {
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var email = document.getElementById('email').value;
    var pswd = document.getElementById('pswd').value;
    var mobile = document.getElementById('mobile').value;
    var gender = document.getElementById('gender').value;
    console.log(fname, lname, email, pswd, mobile, gender);

    var errorBox = document.getElementById('errorMsg');

    var f = new FormData();
    f.append('fname', fname);
    f.append('lname', lname);
    f.append('email', email);
    f.append('pswd', pswd);
    f.append('mobile', mobile);
    f.append('gender', gender);

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t != 'Success') {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-block');
                errorBox.innerHTML = t;
            } else {
                $('#accCreatedMsg').toast('show');
                setTimeout(() => {window.location = 'login.php'}, 5000);
            }
        }
    }
    r.open('POST', 'PHP/signUpProcess.php', true);
    r.send(f);
}

function logIn() {
    var email = document.getElementById('email').value;
    var pswd = document.getElementById('pswd').value;
    var rMe = document.getElementById('rMe').checked;
    var rMeValue = rMe == false ? 0 : 1;
    console.log(email, pswd, rMeValue);

    var errorBox = document.getElementById('errorMsg');

    var f = new FormData();
    f.append('email', email);
    f.append('pswd', pswd);
    f.append('rMe', rMeValue);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'Admin Success') {
                window.location = 'adminPanel.php';
            } else if (t == 'User Success') {
                window.location = 'home.php';
            } else if (t == 'User is blocked') {
                $('#userBlockedModal').modal('show');
            } else {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-block');
                errorBox.innerHTML = t;
            }
        }
    }
    r.open('POST', 'PHP/logInProcess.php', true);
    r.send(f);
}

function unblockReq() {
    var email = document.getElementById('email').value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'Added') {
                $('#userBlockedModal').modal('hide');
                $('#reqToAdmin').toast('show');
            }
        }
    }
    r.open('GET', 'PHP/unblockReq.php?email='+email, true);
    r.send();
}

function forgotPswd() {
    var email = document.getElementById('email').value;
    var errorBox = document.getElementById('errorMsg'); 
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'user') {
                setTimeout(() => {
                    $('#resetPswd').modal('show');
                    $('#vcodeSending').toast('hide');
                }, 2000);
                $('#vcodeSending').toast('show');
            } else {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-block');
                errorBox.innerHTML = t;
            }
        }
    }
    r.open('GET', 'PHP/forgotPswd.php?email='+email, true);
    r.send();
}

function changePswd() {
    var userEmail = document.getElementById('email').value;
    var userVCode = document.getElementById('userVCode').value;
    var newPswd = document.getElementById('newPswd').value;
    var reTypePswd = document.getElementById('reTypePswd').value;
    var errorBox = document.getElementById('errorMsgVbox'); 

    var f = new FormData();
    f.append('userVCode', userVCode); f.append('newPswd', newPswd);
    f.append('reType', reTypePswd); f.append('email', userEmail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'success') {
                $('#resetPswd').modal('hide');
                $('#pswdChanged').toast('show');
            } else {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-block');
                errorBox.innerHTML = t;
            }
        }
    }
    r.open('POST', 'PHP/changePassword.php', true);
    r.send(f);
}



// Header Page
function logOutUser() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                document.getElementById('loader').classList.add('loaderDo');
                setTimeout(() => {window.location.reload();}, 1500);
            }
        }
    }
    r.open('GET', 'PHP/logOutUser.php', true);
    r.send();
}

function deleteThisNotification(id) {
    var noti_elem = document.getElementById('noti'+id); 

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                noti_elem.classList.add('moveTotrash');
                $('#notification_Modal').modal('hide');
                setTimeout(() => {window.location.reload();}, 200);
            }
        }
    }
    r.open('GET', 'PHP/deleteThisNotifications.php?id='+id, true);
    r.send();
}

// User Profile

function changeUserImg() {
    var imageUploader = document.getElementById("userImgUploader");
    var image = document.getElementById('userImg');
    imageUploader.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        image.src = url;
    };
}

function load_district(district) {
    var province = document.getElementById('province').value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById('district').innerHTML = t;
        }
    }
    r.open('GET', 'PHP/loadDistrict.php?province='+province+'&district='+district, true);
    r.send();
}

function saveProfile() {
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var mobile = document.getElementById('mobile1').value;
    var mobile2 = document.getElementById('mobile2').value;
    var postalCode = document.getElementById('postalCode').value;
    var province = document.getElementById('province').value;
    var district = document.getElementById('district').value;
    var line1 = document.getElementById('line1').value;
    var line2 = document.getElementById('line2').value;

    var image = document.getElementById('userImgUploader');

    var errorBox = document.getElementById('errorMsg'); 

    var f = new FormData();
    const rawdata = {fname:fname, lname:lname, mobile:mobile, mobile2:mobile2, postalCode:postalCode, line1:line1, line2:line2};

    for (const key in rawdata) {
        if (rawdata[key] != '') {
            f.append(key, rawdata[key]);
        }
    }
    f.append('province', province);
    f.append('district', district);

    if (image.files.length == 0) {}
    else {
        f.append('image', image.files[0]);
    }    
    
    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'success') {
                document.getElementById('loader').classList.add('loaderDo');
                setTimeout(() => {window.location.reload();}, 1500);
            } else {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-block');
                errorBox.innerHTML = t;
            }
        }
    }
    r.open('POST', 'PHP/saveProfile.php', true);
    r.send(f);

}

function copyTagCode(code) {
    copyToClipboard(code);
    $('#codeCopied').toast('show');
}


// Add Product Page

function addPChangeImg() {
    var image = document.getElementById("addImageUploader");
    var noImg = document.querySelectorAll('.noImg');
    var imgContainer = document.querySelectorAll('.imgContainer');

    image.onchange = function () {
        var file_count = image.files.length;
        if (file_count <= 3) {
            for (var x = 0; x < file_count; x++) {
                document.getElementById('loader').classList.add('loaderDo');

                noImg[x].classList.remove('d-flex');
                noImg[x].classList.add('d-none');
                imgContainer[x].classList.remove('d-none');

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }
        } else {
            alert("Please select 3 or less than 3 images.");
        }
    };
}

function loadBrand() {
    var category = document.getElementById('category').value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById('brand').innerHTML = t;
        }
    }
    r.open('GET', 'PHP/loadBrand.php?cat='+category, true);
    r.send();
}

function loadModel() {
    var brand = document.getElementById('brand').value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById('model').innerHTML = t;
        }
    }
    r.open('GET', 'PHP/loadModel.php?brand='+brand, true);
    r.send();
}

function changeQty(operation, amount) {
    var qty = document.getElementById('qty');
    if (operation == '-') {
        if (qty.value != 1) {
            qty.value -= 1;
        }
    } else if (operation == '+') {
        if (qty.value != amount) {
            let newQty = parseInt(qty.value) + 1;
            qty.value = newQty.toString();
        }
    }
} 

function checkCategory_selected() {
    var category = document.getElementById('category').value;
    if (category == '0') {
        alert('Choose a Category First');
    } else {
        $('#addNewBrand').modal('show');
        var catName = $("#category option:selected").text();
        document.getElementById('catName').innerHTML = catName;
    }
}

function addNewBrand() {
    var category = document.getElementById('category').value;
    var newBrand = document.getElementById('newBrandName').value;
    
    console.log(category, newBrand);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                alert('New Brand Added');
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/addNewBrand.php?category='+category+'&newBrand='+newBrand, true);
    r.send();
}

function checkBrand_selected() {
    var brand = document.getElementById('brand').value;
    if (brand == '0') {
        alert('Choose a Brand First');
    } else {
        $('#addNewModel').modal('show');
        var brandName = $("#brand option:selected").text();
        document.getElementById('brandName').innerHTML = brandName;
    }
}

function addNewModel() {
    var brand = document.getElementById('brand').value;
    var newModel = document.getElementById('newModelName').value;
    
    console.log(brand, newModel);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                alert('New Model Added');
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/addNewModel.php?brand='+brand+'&newModel='+newModel, true);
    r.send();
}

function addNewColour() {
    var newColor = document.getElementById('newColourName').value;
    
    console.log(newColourName);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                alert('New Colour Added');
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/addNewColor.php?color='+newColor, true);
    r.send();
}

function saveProduct() {
    var title = document.getElementById('title').value;
    var price = document.getElementById('price').value;
    var condition = document.getElementById('condition').value;
    var category = document.getElementById('category').value;
    var brand = document.getElementById('brand').value;
    var model = document.getElementById('model').value;
    var qty = document.getElementById('qty').value;
    var color = document.getElementById('color').value;
    var cost = document.getElementById('cost').value;
    var small_desc = document.getElementById('small_desc').value;
    var desc = document.getElementById('desc').value;

    var image = document.getElementById('addImageUploader');
    var file_count = image.files.length;

    var errorBox = document.getElementById('errorMsg'); 

    var f = new FormData();
    f.append('title', title); f.append('qty', qty);
    f.append('price', price); f.append('color', color);
    f.append('condition', condition); f.append('cost', cost);
    f.append('category', category); f.append('small_desc', small_desc);
    f.append('brand', brand); f.append('desc', desc);
    f.append('model', model); 

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'Success') {
                window.scrollTo(0, 0);
                $('#productSuccessful').toast('show');
            } else {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-inline-block');
                errorBox.innerHTML = t;
                window.scrollTo(0, 0);
            }
        }
    }
    r.open('POST', 'PHP/saveProduct.php', true);
    r.send(f);

}

function clearPage() {
    window.location.reload();
    window.scrollTo(0, 0);
}



// My Products Page

function sendSellRequest() {
    var reason = document.getElementById('reason').value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                $('#reqPermissionToSell').modal('hide');
                $('#sellReq').toast('show');
                setTimeout(() => {window.location = 'home.php'}, 2500);
            } else {
                alert(t);
            }
        }
    }
    r.open('GET', 'PHP/sendSellRequest.php?reason='+reason, true);
    r.send();
}

function toggleFilters() {
    var filters = document.getElementById('filters');
    if (filters.classList.contains('d-none')) {
        filters.classList.remove('d-none');
    } else {
        filters.classList.add('d-none');
    }
}

function openDeleteModal(title, id) {
    var productName = document.getElementById('productName');
    productName.innerHTML = title;
    var productId = document.getElementById('productId');
    productId.innerHTML = id;
    $('#deleteConfirm').modal('show');
}

function deleteProduct() {
    var id = document.getElementById('productId').innerHTML;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                document.getElementById('loader').classList.add('loaderDo');
                setTimeout(() => {window.location.reload();}, 1500);
            }
        }
    }
    r.open('GET', 'PHP/deleteProduct.php?id='+id, true);
    r.send();
}

function sortMyProducts() {
    var search = $('#search').val().toLowerCase();;
    
    var date = '0';
    if ($('#date-latest').is(":checked")) {date = '1';} else 
    if ($('#date-oldest').is(":checked")) {date = '2';}
    
    var qty = '0';
    if ($('#qty-high').is(":checked")) {qty = '1';} else 
    if ($('#qty-low').is(":checked")) {qty = '2';}
    
    var status = '0';
    if ($('#status-active').is(":checked")) {status = '1';} else 
    if ($('#status-deactive').is(":checked")) {status = '2';}

    var condition = '0';
    if ($('#condition-1').is(":checked")) {condition = '1'} else
    if ($('#condition-2').is(":checked")) {condition = '2'} else
    if ($('#condition-3').is(":checked")) {condition = '3'} else
    if ($('#condition-4').is(":checked")) {condition = '4'}
    
    var f = new FormData();
    f.append('search', search); f.append('date', date);
    f.append('qty', qty); f.append('condition', condition);
    f.append('status', status);

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById('itemContainer').innerHTML = t;
        }
    }
    r.open('POST', 'PHP/sortMyProducts.php', true);
    r.send(f);
}

function changeStatus(id) {
    var status_text = document.getElementById('status_toast');
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'Deactivated') {
                status_text.innerHTML = 'Product status set to deactive.';
                $('#statusChanged').toast('show');
            } else if (t == 'Activated') {
                status_text.innerHTML = 'Product status set to active.';
                $('#statusChanged').toast('show');
            }
        }
    }
    r.open('GET', 'PHP/changeMPStatus.php?id='+id, true);
    r.send();
}

function idToUpdate(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } 
        }
    }
    r.open("GET", "PHP/setProductSession.php?id=" + id, true);
    r.send();
}




// Update Products Page

function update_ChangeImg() {
    var image = document.getElementById("update_ImageUploader");
    var noImg = document.querySelectorAll('.noImg');
    var imgContainer = document.querySelectorAll('.imgContainer');

    image.onchange = function () {
        var file_count = image.files.length;
        if (file_count > 0) {
            if (file_count <= 3) {
                for (let i = 0; i < imgContainer.length; ++i) {
                    imgContainer[i].classList.add('d-none');
                    noImg[i].classList.remove('d-none');
                    noImg[i].classList.add('d-flex');
                }
                for (var x = 0; x < file_count; x++) {
                    document.getElementById('loader').classList.add('loaderDo');
    
                    noImg[x].classList.remove('d-flex');
                    noImg[x].classList.add('d-none');
                    imgContainer[x].classList.remove('d-none');
    
                    var file = this.files[x];
                    var url = window.URL.createObjectURL(file);
                    document.getElementById("i" + x).src = url;
                }
            } else {
                alert('Please select 3 or less than 3 images.');
            }
        } else {
            alert("Atleast one image is required to update product.");
        }
    };
}

function updateProduct() {
    var id = document.getElementById('product_id').innerHTML;
    var title = document.getElementById('title').value;
    var qty = document.getElementById('qty').value;
    var cost = document.getElementById('cost').value;
    var small_desc = document.getElementById('small_desc').value;
    var desc = document.getElementById('desc').value;

    var f = new FormData();

    f.append('id', id);

    const rawdata = {title:title, qty:qty, cost:cost, small_desc:small_desc, desc:desc};

    for (const key in rawdata) {
        if (rawdata[key] != '') {
            f.append(key, rawdata[key]);
        }
    }

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                window.scrollTo(0, 0);
                $('#productUpdated').toast('show');
                setTimeout(() => {window.location = 'myProducts.php'}, 1500);
            }
        }
    }
    r.open('POST', 'PHP/updateProductData.php', true);
    r.send(f);
}




// Home Page

function hideItems(id) {
    $('#itemsRow'+id).slideToggle();
}

function homeSearch() {
    var txt_input = document.getElementById("homeSearch_input").value;
    var select = document.getElementById("homeSearch_selector").value;
  
    var f = new FormData();
    f.append("text", txt_input);
    f.append("select", select);
  
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t != 'no results') {
            document.getElementById('clearForSearch').innerHTML = t;
        } else {
            console.log("No input for search");
        }
      }
    };
    r.open("POST", "PHP/homeSearch.php", true);
    r.send(f);
}




// Search All Products Page

function hideFilters() {
    if ($('#filterContainer').is(':visible')) {
        $('#filterContainer').slideUp();   
    } else {
        $('#filterContainer').slideDown();   
    }
}

function advanced_search() {
    // Elements
    var search = document.getElementById('search').value; 
    var category = document.getElementById('category').value; 
    var brand = document.getElementById('brand').value; 
    var model = document.getElementById('model').value; 
    var condition = document.getElementById('condition').value; 
    var color = document.getElementById('color').value; 
    var priceFrom = document.getElementById('priceFrom').value; 
    var priceTo = document.getElementById('priceTo').value; 
    var sort_by = document.getElementById('sort_by').value; 

    var f = new FormData();
    f.append('search', search); f.append('category', category);
    f.append('brand', brand); f.append('model', model);
    f.append('condition', condition);  f.append('color', color); 
    f.append('priceFrom', priceFrom); f.append('priceTo', priceTo); 
    f.append('sort_by', sort_by); 

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t != "no filters") {
                document.getElementById('clearForSearch').innerHTML = t;
            }
        }
    }
    r.open('POST', 'PHP/searchAllProducts.php', true);
    r.send(f);
}



// Single Product View

function setThisImage(path) {
    var mainImg = document.getElementById('main_img');
    mainImg.src = path;
}




// Watchlist Page

function add_wishList(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                window.location.reload();
            }
        }
    }
    r.open('POST', 'PHP/add_wishList.php?id='+id, true);
    r.send();
}

function remove_wishList(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                window.location.reload();
            }
        }
    }
    r.open('POST', 'PHP/remove_wishList.php?id='+id, true);
    r.send();
}

function removeALL_wishList() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'success') {
                window.location.reload();
            }
        }
    }
    r.open('POST', 'PHP/removeALL_wishList.php', true);
    r.send();
}




// Cart Page
const copyToClipboard = (text) => {
    const input = document.createElement('input');
    input.style.position = 'fixed';
    input.style.opacity = 0;
    input.value = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
};


function cartQty_adj(adj, id, max) {
    const product_max = max;
    var qty_Elem = document.getElementById('qty_elem_'+id);
    
    let qty_val = parseInt(qty_Elem.value);

    if (adj == '+') {
        if (qty_val != product_max) {
            let new_qty = qty_val+1;
            qty_Elem.value = new_qty;
        } 
    } else if (adj == '-') {
        if (qty_val != 1) {
            qty_Elem.value -= 1;
        }
    }
}

function cartQty_set(id) {
    var qty_Elem = document.getElementById('qty_elem_'+id);
    let qty_val = parseInt(qty_Elem.value);
    
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/setCart_QTY.php?id='+id+'&qty='+qty_val, true);
    r.send();
}

function applyPromo() {
    var user_promoCode = document.getElementById('user_promoCode').value;

    if (user_promoCode != '') {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == 'No code found') {
                    $('#no_code_toast').toast('show');
                } else {
                    t = t.split(':');
                    let percent = t[1];

                    document.getElementById('loader').classList.add('loaderDo');
                    setTimeout(() => {
                        // promo_code being the dicount actual value
                        // code being the promo code
                        window.location = 'cart.php?promo_code='+percent.trimStart()+'&code='+user_promoCode;
                    }, 1500);
                }
            }
        }
        r.open('GET', 'PHP/PROMO.php?code='+user_promoCode, true);
        r.send();
    }
}

function add_cartItem(id, qty) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                window.location = 'cart.php';
            }
        }
    }
    r.open('GET', 'PHP/cart_addItem.php?id='+id+'&qty='+qty, true);
    r.send();
}

function remove_cartItem(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/cart_removeItem.php?id='+id, true);
    r.send();
}

function getUserDetails(callback) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            callback(t);
        }
    }
    r.open('GET', 'PHP/getUserDetails.php', true);
    r.send();
}

function checkOut_multipleItems(productsObj, discount_val, discount_code) {
    console.clear();
    console.log(`Received---\nProducts -> ${productsObj}\nDiscount -> ${discount_val}\nDiscount Val -> ${discount_code}`);

    getUserDetails(function(t) {
        var user_data = JSON.parse(t);

        // Console loggin given values to function
        console.log('Products Info log');
        productsObj.forEach(product_info => {
            console.log(`ID : ${product_info['id']} -> QTY : ${product_info['qty']} `);
        });
        console.log(`Discount : ${discount_val}`);
    
        var json_products = JSON.stringify(productsObj);
        
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
    
                if (t == 'Address Not Found') {
                    alert('Please Update Your Profile First !');
                    window.location = 'profile.php';
                } else {
                    var details_ = JSON.parse(t);
                    console.log(details_);
    
                    var hash;
                    //////////////////////////////////////////////////////////////////////////
                    // Calculations 
                    var titles = '';
                    var codes = '';
                    var promo;
                    let normal_amount = 0;
                    let shipping_amount = 0;
                    var total_Cost = 0;  // for all the products (additions)
                    const SERVICE_CHARGE = 5;
    
                    let i = 0;
                    for (; i < details_.length; i++) {
    
                        // Single Item being selected from array 
                        let single_item = details_[i];
                        let title = single_item.name;
                        let code = single_item.code;
                        let price = single_item.price;
                        let qty = single_item.qty;
                        let shipp = parseInt(single_item.cost);
                        let amount = price * qty; // Price for single item
                        
                        titles += title + ', ';
                        codes += code + ', ';
                        normal_amount += amount;
                        shipping_amount += shipp;
                    }

                    // Removing , and spaces in codes to be hashed 
                    codes = codes.replace(/,/g, '').replace(/ /g, '');
    
                    total_Cost = normal_amount + shipping_amount + SERVICE_CHARGE; 
                    
                    console.log(`\nProducts : ${titles}\n`);
                    console.log(`Codes : ${codes}\n`);
                    console.log(`Normal Price (${i} items) : ${normal_amount}\n`);
                    console.log(`Shipping Price (${i} items) : ${shipping_amount}\n`);
                    
                    if (discount_val != null) {
                        promo = Math.round((total_Cost * discount_val) / 100);
                        console.log(`Discount : -${promo}\n`);
                        total_Cost -= promo;
                    }
    
                    console.log(`TOTAL COST (${i} items) : ${total_Cost}\n`);
                    ////////////////////////////////////////////////////////////////////////////

                    console.log(`\nCodes: ${codes}\nTotal_Cost: ${total_Cost}`);

                    // Generating Hash
                    var values_to_be_hashed = new FormData();
                    values_to_be_hashed.append('codes', codes);
                    values_to_be_hashed.append('total_Cost', total_Cost);

                    var newReq = new XMLHttpRequest();
                    newReq.onreadystatechange = function () {
                        if (newReq.readyState == 4) {
                            
                            var hashResponse = newReq.responseText;
                            hash = hashResponse.toString();
        
                            payhere.onCompleted = function onCompleted(orderId) {
                                console.log("Payment completed. OrderID/s: " + orderId);

                                // Remove Cart Items
                                for (let j = 0; j < details_.length; j++) {
                                    const singleItem = details_[j];
                                    let id = singleItem.id;
                                    remove_cartItem(id);
                                }
                                
                                // Save Invoice
                                save_multipleInvoice(details_, discount_val, discount_code);
                                
                                // Thank our customer 
                                sendPROMO();
                            };
            
                            payhere.onDismissed = function onDismissed() {
                                console.log("Payment dismissed");
                            };
            
                            payhere.onError = function onError(error) {
                                console.log("Error:"  + error);
                            };
            
                            var payment = {
                                "sandbox": true,
                                "merchant_id": "1221855", 
                                "return_url": 'http://localhost/projects/cybershop/cart.php',  
                                "cancel_url": 'http://localhost/projects/cybershop/cart.php', 
                                "notify_url": "http://sample.com/notify",
                                "order_id": codes,
                                "items": titles,
                                "amount": total_Cost,
                                "currency": "USD",
                                "first_name": user_data['fname'],
                                "last_name": user_data['lname'],
                                "email": user_data['email'],
                                "phone": user_data['mobile'],
                                "address": user_data['address'],
                                "city": user_data['district'],
                                "hash": hash,
                                "country": "Sri Lanka",
                                "delivery_address": user_data['address'],
                                "delivery_city": user_data['district'],
                                "delivery_country": "Sri Lanka"
                            };
            
                            payhere.startPayment(payment);
                        }
                    }
                    newReq.open('POST', 'PHP/generateHash_multipleProducts.php', true);
                    newReq.send(values_to_be_hashed);
                    /////////////////////////////////////////////////
                }
            }
        }
        r.open('GET', 'PHP/BUY_multipleItems_Process.php?productsObj='+json_products, true);
        r.send();

    });
}




// Single Product Buy Now Process 
function payNow_singleItem(product_id) {
    var product_qty_SingleItemView = document.getElementById('qty');
    var product_qty_Cart = document.getElementById('qty_elem_'+product_id);

    var product_qty;
    if (product_qty_SingleItemView != null) {
        product_qty = product_qty_SingleItemView.value;
    } else if (product_qty_Cart != null) {
        product_qty = product_qty_Cart.value;
    }
    
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if (t == 'Address Not Found') {
                alert('Please Update Your Profile First !');
                window.location = 'profile.php';
            } else {
                var details_ = JSON.parse(t);

                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID: " + orderId);

                    // Save Invoice
                    save_singleInvoice(
                        details_['order_id'], 
                        product_id, 
                        details_['userEmail'], 
                        details_['amount'], 
                        product_qty
                    );

                    // Thank our customer 😘
                    sendPROMO();
                };

                payhere.onDismissed = function onDismissed() {
                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error:"  + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221855", 
                    "return_url": 'http://localhost/projects/cybershop/singleProductView.php?product_id=' + product_id,  
                    "cancel_url": 'http://localhost/projects/cybershop/singleProductView.php?product_id=' + product_id, 
                    "notify_url": "http://sample.com/notify",
                    "order_id": details_['order_id'],
                    "items": details_['product'],
                    "amount": details_['amount'],
                    "currency": "USD",
                    "first_name": details_['fname'],
                    "last_name": details_['lname'],
                    "email": details_['userEmail'],
                    "phone": details_['mobile'],
                    "address": details_['address'],
                    "city": details_['district'],
                    "country": "Sri Lanka",
                    "delivery_address": details_['address'],
                    "delivery_city": details_['district'],
                    "delivery_country": "Sri Lanka",
                    "hash": details_['hash']
                };

                payhere.startPayment(payment);
            }
        }
    }
    r.open('GET', 'PHP/BUY_singleItem_Process.php?p_id='+product_id+'&p_qty='+product_qty, true);
    r.send();
}

function sendPROMO() {
    // Create loader
    let loader = document.createElement("div");
    loader.id = "loader";
    let innerDiv = document.createElement("div");
    innerDiv.className = "lds-default";
    for (let i = 0; i < 18; i++) {
        let innerInnerDiv = document.createElement("div");
        innerDiv.appendChild(innerInnerDiv);
    }
    loader.appendChild(innerDiv);
    document.getElementById('loader').classList.add('loaderDo');
    document.body.appendChild(loader);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                console.log('Email sent 🥰');
            }
        }
    }
    r.open('GET', 'PHP/sendPromo.php', true);
    r.send();
}


// Invoice Page
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function save_singleInvoice(order_id, product_id, userEmail, amount, qty) {
    const f = new FormData();
    const params = [order_id, product_id, userEmail, amount, qty];
    const paramNames = ['order_id', 'product_id', 'userEmail', 'amount', 'qty'];

    for (let i = 0; i < params.length; i++) {
        f.append(paramNames[i], params[i]);
    }

    for (const [key, value] of f) {console.log('»', key, value)}

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = 'invoice.php?orderID_0='+order_id;
        }
    }
    r.open('POST', 'PHP/saveSingle_INVOICE.php', true);
    r.send(f);
}

function save_multipleInvoice(products, discount_val, discount_code) {
    var productsObj = JSON.stringify(products);

    var order_ids = []; 
    for (var i = 0; i < products.length; i++) {
        var product = products[i];
        var code = product.code;
        order_ids.push(code);
    }

    var formatted_order_ids = "";
    for (var i = 0; i < order_ids.length; i++) {
        var order_id = order_ids[i];
        formatted_order_ids += "orderID_" + i + "=" + order_id + "&";
    }
    formatted_order_ids = formatted_order_ids.slice(0, -1);

    var path = '';
    if (discount_val != null) {
        path = 'invoice.php?'+formatted_order_ids+'&discount='+discount_val;
    } else {
        path = 'invoice.php?'+formatted_order_ids;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                window.location = path;
            }
        }
    }
    r.open('GET', 'PHP/saveMultiple_INVOICE.php?productArray='+productsObj+'&discount='+discount_code, true);
    r.send();
}




// Purchased History Page
function remove_Invoice(userEmail, product, date) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/removeInvoice.php?email='+userEmail+'&product='+product+'&date='+date, true);
    r.send();
}

function open_feedbackModal(product_id) {
    var id_set_elem = document.getElementById('feedBack_productId');
    id_set_elem.innerHTML = product_id;

    $('#feedBackModal').modal('show');
}

function submitFeedback() {
    var productId = document.getElementById('feedBack_productId').innerHTML;
    var review = document.getElementById('review').value;
    
    var r = new XMLHttpRequest();
    r.open('GET', 'PHP/addFeedback.php?p_id='+productId+'&review='+review, true);
    r.send();

    $('#feedBackModal').modal('hide');
}


// Messages Page
function addNewFriend() {
    var code = document.getElementById('friend_code').value;

    var errorBox = document.getElementById('errorMsg');
    
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            errorBox.classList.add('d-none');
            if (t == 'No user found') {
                errorBox.classList.remove('d-none');
                errorBox.classList.add('d-inline');
                errorBox.innerHTML = t;
            } else {
                $('#newFriendModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                window.location.reload();
            }
        }
    }
    r.open('GET', 'PHP/addFriend.php?tagCode='+encodeURIComponent(code), true);
    r.send();
}

function toggleChatBox(friendEmail) {
    var chatBOX = document.getElementById('chatBOX');

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            chatBOX.innerHTML = t;
        }
    }
    r.open('GET', 'PHP/getFriendChat.php?friendEmail='+friendEmail, true);
    r.send();
}

function sendMessage(friendEmail) {
    var msg_input = document.getElementById('msg_input').value;
    
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 'done') {
                toggleChatBox(friendEmail);
            }
        }
    }
    r.open('GET', 'PHP/user_sendMessage.php?msg='+msg_input+'&friendEmail='+friendEmail, true);
    r.send();
}