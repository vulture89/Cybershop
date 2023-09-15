var boards = [
  "dashBoard", "manageUsers", "manageProducts",
  "manageUsers_Profiles", "manageUsers_blockUnblock", 
  "manageUsers_sellPermissions", "manageUsers_messages",
  "manageUsers_friends", "manageProducts_productDelivery"
];

window.onload = function() {
  var showElem = sessionStorage.getItem('showElem');

  if (showElem === 'true') {
    var elemId = sessionStorage.getItem('elemId');
    open_board(elemId);

    sessionStorage.removeItem('showElem');
    sessionStorage.removeItem('elemId');
  } else {
    open_board('dashBoard');
  }
}

window.addEventListener('scroll', () => {
  var navBar = document.getElementById('navBar');
  if (window.scrollY > 50) {
    navBar.classList.add('boxshadow_navbar');
  } else {
    navBar.classList.remove('boxshadow_navbar');
  }
})

function open_board(elem) {
  var element = document.getElementById(elem);
  if (element.classList.contains("d-none")) {
    element.classList.add("d-block");
    element.classList.add("animate__fadeIn");
    element.classList.remove("d-none");
  }

  var other_elem = boards.filter((board) => board !== elem);

  other_elem.forEach((current_elem) => {
    let x = document.getElementById(current_elem);
    x.classList.add("d-none");
    x.classList.remove("d-block");
  });
}

function go_back(elem) {
  sessionStorage.setItem('showElem', 'true');
  sessionStorage.setItem('elemId', elem);
  window.location.reload();
}

function logOutAdmin() {
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
  r.open('GET', 'PHP/logOutAdmin.php', true);
  r.send();
}

function change_blockedStatus(user) {
  var block_txt_ = document.getElementById('block_text_'+user);
  var block_bt_ = document.getElementById('block_bt_'+user);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'blocked') {
            block_txt_.innerHTML = 'BLOCKED';
            block_txt_.style.color = 'var(--bs-danger)';
            block_bt_.innerHTML = 'Unblock';
          } else {
            block_txt_.innerHTML = 'UNBLOCKED';
            block_txt_.style.color = 'var(--bs-teal)';
            block_bt_.innerHTML = 'Block';
          }
      }
  }
  r.open('GET', 'PHP/change_blockStatus.php?email='+user, true);
  r.send();
}

function toggle_sellPermissions(user) {
  var sell_txt_ = document.getElementById('sell_txt_'+user);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'no_permission') {
            sell_txt_.innerHTML = 'NO';
            sell_txt_.style.color = 'var(--bs-danger)';
          } else if (t == 'yes_permission') {
            sell_txt_.innerHTML = 'YES';
            sell_txt_.style.color = 'var(--bs-teal)';
          }
      }
  }
  r.open('GET', 'PHP/change_sellPermissions.php?email='+user, true);
  r.send();
}

function sellReq(email, offer) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'done') {
            go_back('manageUsers_sellPermissions');
          }
      }
  }
  r.open('GET', 'PHP/toggle_sellReq.php?email='+email+'&offer='+offer, true);
  r.send();
}

function change_deliveryStaus(order_id) {
  var status_txt_ = document.getElementById('status_txt_'+order_id);
  var status_bt_ = document.getElementById('status_bt_'+order_id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'shipping') {
            status_txt_.innerHTML = "SHIPPING";
            status_txt_.style.color = "var(--bs-warning)";
          } else if (t == 'delivered') {
            status_txt_.innerHTML = "DELIVERED";
            status_txt_.style.color= "var(--bs-teal)";
            status_bt_.disabled = true;
          }
      }
  }
  r.open('GET', 'PHP/change_deliveryStatus.php?order_id='+order_id, true);
  r.send();
}

function addNewCategory() {
  var newCategory_input = document.getElementById('newCategory_input').value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'done') {
            document.getElementById('newCategoryName').innerHTML = newCategory_input;
            $('#newCategoryAdded').toast('show');
            $('#addNewCategory').modal('hide');
          }
      }
  }
  r.open('GET', 'PHP/addNewCategory.php?category_name='+newCategory_input, true);
  r.send();
}

function addNewBrand() {
  var selected_category_input = document.getElementById('selected_category_input').value;
  var newBrand_input = document.getElementById('newBrand_input').value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'done') {
            document.getElementById('newBrandName').innerHTML = newBrand_input;
            $('#newBrandAdded').toast('show');
            $('#addNewBrand').modal('hide');
          }
      }
  }
  r.open('GET', 'PHP/addNewBrand.php?category='+selected_category_input+'&newBrand='+newBrand_input, true);
  r.send();
}

function addNewModel() {
  var selected_brand_input = document.getElementById('selected_brand_input').value;
  var newModel_input = document.getElementById('newModel_input').value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'done') {
            document.getElementById('newModelName').innerHTML = newModel_input;
            $('#newModelAdded').toast('show');
            $('#addNewModal').modal('hide');
          }
      }
  }
  r.open('GET', 'PHP/addNewModel.php?brand='+selected_brand_input+'&newModel='+newModel_input, true);
  r.send();
}

function toggleChatBox(userEmail) {
  var chatBOX = document.getElementById('chatBOX');

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          chatBOX.innerHTML = t;
      }
  }
  r.open('GET', 'PHP/getAdminChat.php?userEmail='+userEmail, true);
  r.send();
}

function sendMessage(userEmail) {
  var msg_input = document.getElementById('msg_input').value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function() {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == 'done') {
            toggleChatBox(userEmail);
          }
      }
  }
  r.open('GET', 'PHP/admin_sendMessage.php?msg='+msg_input+'&userEmail='+userEmail, true);
  r.send();
}