function changeView() {

    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {

                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";

                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;

            }
        }
    };

    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}



function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");

    var formData = new FormData();
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }

        }

    };

    r.open("POST", "signInProcess.php", true);
    r.send(formData);
}

var bm;

function frogotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("Verification email sent. Please check your inbox. ");
                var m = document.getElementById("frogotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {

                alert(text);

            }

        }
    };
    r.open("GET", "frogotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function resetPassword() {

    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var formData = new FormData();
    formData.append("e", e.value);
    formData.append("np", np.value);
    formData.append("rnp", rnp.value);
    formData.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {

                alert("Password reset Success");
                bm.hide();


            } else {

                alert(text);

            }

        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(formData);

}


function showPassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }

}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }

}

function goToAddProduct() {
    window.location = "addproduct.php";
}

function changeImg() {
    var image = document.getElementById("imguploder");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function changeImg2() {
    var image = document.getElementById("imguploder2");
    var view = document.getElementById("prev2");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function changeImg3() {
    var image = document.getElementById("imguploder3");
    var view = document.getElementById("prev3");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function addProduct() {

    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;

    if (document.getElementById("bn").checked) {
        condition = "1";
    } else if (document.getElementById("us").checked) {
        condition = "2";
    }

    var colour;

    if (document.getElementById("clr1").checked) {
        colour = "1"
    } else if (document.getElementById("clr2").checked) {
        colour = "2"
    } else if (document.getElementById("clr3").checked) {
        colour = "3"
    } else if (document.getElementById("clr4").checked) {
        colour = "4"
    } else if (document.getElementById("clr5").checked) {
        colour = "5"
    } else if (document.getElementById("clr6").checked) {
        colour = "6"
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delevert_within_colombo = document.getElementById("dwc");
    var delevert_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploder");
    // var image2 = document.getElementById("imguploder2");
    // var image3 = document.getElementById("imguploder3");

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", colour);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delevert_within_colombo.value);
    form.append("doc", delevert_outof_colombo.value);
    form.append("dese", description.value);
    form.append("img", image.files[0]);
    // form.append("img2", image2.files[0]);
    // form.append("img3", image3.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
            if (text == "Product added successfully") {

                if (text == "Image added successfully") {

                    window.location = "addproduct.php";
                }
            }
        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(form);

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {

                window.location = "home.php";
            }
        }

    };

    r.open("GET", "signout.php", true)
    r.send();

}

function changeProductView() {

    var update = document.getElementById("updateproductbox");
    var add = document.getElementById("addproductbox");

    update.classList.toggle("d-none");
    add.classList.toggle("d-none");

}

function updateprofile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var postalcode = document.getElementById("postalcode");
    var img = document.getElementById("profileimg");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", line1.value);
    form.append("a2", line2.value);
    form.append("c", city.value);
    form.append("pro", province.value);
    form.append("di", district.value);
    form.append("pc", postalcode.value);
    form.append("i", img.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t = " || Address Successfuly updated") {

                window.location = "userprofile.php";
            }
            if (t = " || New Address Added") {

                window.location = "userprofile.php";
            }
            if (t = " || Image Saved Successfully.") {

                window.location = "userprofile.php";
            }
            if (t = "User details Updated") {

                window.location = "userprofile.php";
            }
        }
    };

    r.open("POST", "UpdateProfileProcess.php", true);
    r.send(form);
}


function changeStatus(id) {
    var productid = id;
    var statuscheck = document.getElementById("check");
    var statuslabel = document.getElementById("checklabel" + productid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deactivated") {
                statuslabel.innerHTML = "Make Your Product Active";
            } else if (t == "Activated") {
                statuslabel.innerHTML = "Make Your Product Deactive";

            }
        }
    };

    r.open("GET", "statusChangeProcess.php?p=" + productid, true);
    r.send();
}

var k;

function deleteModel(id) {

    var dm = document.getElementById("deleteModel" + id);
    k = new bootstrap.Modal(dm);
    k.show();

}


function deleteproduct(id) {

    var productid = id;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;

            if (t == "success") {

                k.hide();
            }

        }
    };

    request.open("GET", "deleteproductprocess.php?id=" + productid, true);
    request.send();
}

function addFilters(x) {

    var page = x;

    var search = document.getElementById("s");


    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }


    var qty;
    if (document.getElementById("h").checked) {
        qty = 1;
    } else if (document.getElementById("l").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }


    var f = new FormData();
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);
    f.append("p", page);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "empty") {
                window.location = "sellerproductview.php";
            } else {

                document.getElementById("pro_view").className = "d-none";
                document.getElementById("product_view_div").innerHTML = t;
            }
        }

    };
    r.open("POST", "filterProcess.php", true);
    r.send(f);

}

function clearfilter() {
    window.location = "sellerproductview.php";
}

function searchproduct() {

    var id = document.getElementById("search").value;
    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");


    var requset = new XMLHttpRequest();
    requset.onreadystatechange = function() {
        if (requset.readyState == 4) {
            var t = requset.responseText;
            var object = JSON.parse(t);
            alert(object["tittle"]);
            title.value = object["title"];




        }
    }
    requset.open("GET", "searchToUpdateProcess.php?id=" + id, true);
    requset.send();


}


// function searchtoupdate() {

//     var id = document.getElementById("searchToUpdate").value;

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function() {
//         if (request.readyState == 4) {
//             var text = request.responseText;
//             var object = JSON.parse(text);
//             title.value = object["title"];
//         }
//     };

//     request.open("GET", "searchToUpdateProces.php?id=" + id, true);
//     request.send();

// }

function sendid(id) {
    // alert(id);
    var id = id;

    var requset = new XMLHttpRequest();
    requset.onreadystatechange = function() {
        if (requset.readyState == 4) {
            var t = requset.responseText;
            // alert(t);
            if (t == "success") {
                window.location = "UpdateProduct.php";
            }
        }
    };
    requset.open("GET", "sendProductProcess.php?id=" + id, true);
    requset.send();
}

// /////////////////updateproduct///////////////////////

function changeProduct(id) {
    var id = id;

    var title = document.getElementById("ti");

    var qty = document.getElementById("qty");
    var dlv_within_clmb = document.getElementById("dwc");
    var dlv_outof_clmb = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploder");

    var form = new FormData();
    form.append("id", id);
    form.append("t", title.value);

    form.append("qty", qty.value);

    form.append("dwc", dlv_within_clmb.value);
    form.append("doc", dlv_outof_clmb.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
            window.location = "UpdateProduct.php";
        }
    };
    r.open("POST", "updateproductprocess.php", true);
    r.send(form);



}


//////////////////////////load main img//////////////////////////////

function loadmainimg(id) {

    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var maining = document.getElementById("mainimg");
    maining.style.backgroundImage = "url(" + img + ")";

}

function qty_ink(qty) {
    var pqty = qty;
    var input = document.getElementById("qtyinput");

    if (input.value < pqty) {
        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();

    } else {
        alert("Maximum quantity count has been achieved.")
    }


}

function qty_dec() {

    var input = document.getElementById("qtyinput");

    if (input.value >= 1) {
        var newvalue = parseInt(input.value) - 1;

        input.value = newvalue.toString();

    } else {
        alert("Minimum quantity count has been achieved.")
    }
}
// ///////////////////////home,search/////////////////////////////////////////////

function basicsearch(x) {

    var page = x;

    var searchText = document.getElementById("basic_search_txt").value;
    var searchselect = document.getElementById("basic_search_select").value;
    var searching = document.getElementById("searchdetails");
    var slide = document.getElementById("slideid");

    var f = new FormData();

    f.append("t", searchText);
    f.append("s", searchselect);
    f.append("p", page);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            slide.innerHTML = " ";
            searching.innerHTML = t;

        }
    };

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);


}

function addToWatchList(id) {

    var pid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + pid, true);
    r.send();

}

// ............watchlist..............

function deletefromwatchlist(id) {

    var pid = id;
    // alert(pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "watchlist.php";

            } else {
                alert(t);

            }


        }
    };
    r.open("GET", "removeWathlistItemProcess.php?id=" + pid, true);
    r.send();

}


function addToCart(id) {
    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "cart.php";
            } else {
                alert(t);

            }
        }
    };
    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();
}

function addToCart2(id) {
    var qtytxt = document.getElementById("qtyinput").value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "cart.php";
            } else {
                alert(t);

            }
        }
    };
    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();
}

//////////////////////////////////////////////////


function deletefromcart(id) {

    var cid = id;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            }
            alert(t);
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();

}

// paynow


function paynow(id) {
    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please sign In first.");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your Profile First.");
                window.location = "userprofile.php";
            } else {

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217862", // Replace your Merchant ID
                    "return_url": "http://localhost/eShop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/eShop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);

                };
            }
        }
    };
    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    var orderid = orderId;
    var pid = id;
    var email = mail;
    var total = amount;
    var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("pqty", pqty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("payment Success.");
                window.location = "invoice.php?id=" + orderId;
            }
        }
    }

    r.open("POST", "saveinvoice.php", true);
    r.send(f);
}



function printDiv() {

    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

var af;

function addfeedback(id) {

    var feedmodel = document.getElementById("feedmodal" + id);
    var af = new bootstrap.Modal(feedmodel);
    af.show();

}

function savefeedback(id) {
    var pid = id;
    var feedback = document.getElementById("feedtxt" + id).value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedback);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Success");
                af.hide();
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

var v;

function adminverification() {

    var e = document.getElementById("e").value;

    var f = new FormData();
    f.append("email", e);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification email sent. Please check your inbox. ");
                var verificationmodel = document.getElementById("verificationmodel");
                v = new bootstrap.Modal(verificationmodel);
                v.show();
            } else {
                alert(t)
            }
        }
    };

    r.open("POST", "adminverificationprocess.php", true);
    r.send(f);

}

function verify() {
    var verificationcode = document.getElementById("v").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                v.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "verifyprocess.php?v=" + verificationcode, true);
    r.send();

}

function blockuser(email) {

    var mail = email;

    var blockbtn = document.getElementById("blockbtn" + mail);

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "success2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }
        }
    };

    r.open("POST", "userBlockProcess.php", true);
    r.send(f);

}

function searchUser() {
    var text = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php";
            }
        }
    };

    r.open("GET", "searchuser.php?s=" + text, true);
    r.send();

}

function advancedSearch(x) {
    // alert(x);
    // var x = 1;
    var s = document.getElementById("s1").value;
    var ca = document.getElementById("ca1").value;
    var br = document.getElementById("br1").value;
    var mo = document.getElementById("mo1").value;
    var co = document.getElementById("co1").value;
    var col = document.getElementById("col1").value;
    var prif = document.getElementById("prif1").value;
    var prit = document.getElementById("prit2").value;
    var sort = document.getElementById("sort").value;

    // alert(s);
    // alert(ca);
    // alert(br);
    // alert(mo);
    // alert(co);
    // alert(col);
    // alert(prif);
    // alert(prit);

    var form = new FormData();
    form.append("page", x);
    form.append("s", s);
    form.append("c", ca);
    form.append("b", br);
    form.append("m", mo);
    form.append("co", co);
    form.append("col", col);
    form.append("prif", prif);
    form.append("prit", prit);
    form.append("sort", sort);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // 
            document.getElementById("filter").innerHTML = text;
        }
    };
    r.open("POST", "advancedSearchpro.php", true);
    r.send(form);

}


// refresher
var mail;

function refresher(email) {
    mail = email
    setInterval(refreshmsgare, 500);
    setInterval(refreshrecentarea, 500);
}

// sendmessage

function sendmessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("msgtxt").value = "";

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}


// refres msg view area

function refreshmsgare() {

    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            chatrow.innerHTML = t;

        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;

        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}
/////////////////dailyselling/////////////////////

function dailyselling() {

    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "sellingHistory.php?f=" + from + "&t=" + to;


}
var am;

function addnewmodal() {
    var addnewmodel = document.getElementById("addnewmodel");
    am = new bootstrap.Modal(addnewmodel);
    am.show();

}

// savecategory

function savecategory() {

    var txt = document.getElementById("categorytxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                am.hide();
                alert("Category saved successfully");
                window.location = "manageproducts.php";

            } else {
                alert(t);
            }
        }
    }


    r.open("GET", "addNewCategoryProcess.php?t=" + txt, true);
    r.send();
}

////......................manageusers.....////
function clearallsearch() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "manageusers.php";

            } else {
                alert("error");
            }



        }
    };

    r.open("GET", "manageusersessiondestroy.php", true);
    r.send();

}

var am;

function singleviewmodel(id) {
    var singleproductview = document.getElementById("singleproductview" + id);
    am = new bootstrap.Modal(singleproductview);
    am.show();
}

function blockproduct(id) {
    var pid = id;

    var blockbtn = document.getElementById("blockbtn" + pid);

    var f = new FormData();
    f.append("p", pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";

            } else if (t == "success2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";

            }
        }
    };

    r.open("POST", "productblockProcess.php", true);
    r.send(f);


}

var vmsg;

function viewmsgmodal() {
    var msggmodal = document.getElementById("msgmodal");
    var vmsg = new bootstrap.Modal(msggmodal);
    vmsg.show();

}


// admin refresher
var mail;

function adminrefresher(email) {
    mail = email
    setInterval(adminrefreshmsgare, 500);
    setInterval(adminrefreshrecentarea, 500);
}

// admin sendmessage

function adminsendmessage(mail) {
    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("msgtxt").value = "";

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminsendmessageprocess.php", true);
    r.send(f);

}


// admin refres msg view area

function adminrefreshmsgare() {

    var chatrow = document.getElementById("chatrow2" + mail);

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            chatrow.innerHTML = t;
            // alert(t);
        }
    }

    r.open("POST", "adminrefreshmsgareaprocess.php", true);
    r.send(f);

}

// admin refreshrecentarea

function adminrefreshrecentarea() {

    var rcv = document.getElementById("rcv2" + mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
            // alert(t);

        }
    }

    r.open("POST", "adminrefreshrecentareaprocess.php", true);
    r.send();

}

function qtychange(id) {

    var cid = id;
    var cqty = document.getElementById("cartqtytxt" + id).value;

    var f = new FormData();
    f.append("cid", cid);
    f.append("cqty", cqty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "cart.php";
            }

        }
    };
    r.open("POST", "cartqtyupdate.php", true);
    r.send(f);

}

function paynowcheckout(id) {
    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please sign In first.");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your Profile First.");
                window.location = "userprofile.php";
            } else {

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217862", // Replace your Merchant ID
                    "return_url": "http://localhost/eShop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/eShop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);

                };
            }
        }
    };
    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoicecheckout(orderId, id, mail, amount, qty) {

    var orderid = orderId;
    var pid = id;
    var email = mail;
    var total = amount;
    var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("pqty", pqty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("payment Success.");
                window.location = "invoice.php?id=" + orderId;
            }
        }
    }

    r.open("POST", "saveinvoice.php", true);
    r.send(f);
}