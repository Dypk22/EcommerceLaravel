function orderNow(pid) {
	AddToCart(pid);
	window.location.href='/checkout';
}

function AddToCart(pid) {
	// jQuery('#product_alert').hide();
	product__qty = jQuery('#product__qty').val();
	// alert(pid+', '+product__qty)
	if (product__qty == 0) {
		product__qty = 1;
	}
	jQuery('#product_id').val(pid);
	jQuery('#product_qty').val(product__qty);
	jQuery('.side-cart-items').remove();
	jQuery.ajax({
		url: '/add_to_cart',
		data: jQuery('#frmAddToCart').serialize(),
		type: 'post',
		success: function (result) {
			var totalPrice = 0;
			var totalMRP = 0;
			if (result.msg == 'not_avaliable') {
				// alert(result.data);
				showErrortoast('product not available', 'fas fa-exclamation-circle');
			} else if (result.msg == 'qty_not_available') {
				// jQuery('#product_alert').show();
				// jQuery('#product_alert_msg').html('');
				// jQuery('#product_alert_msg').html('Product quantity must be less than or equal to '+result.availableQty);
				showErrortoast('Product quantity must be less than ' + (result.availableQty + 1), 'fas fa-exclamation-circle');
				jQuery('.totalPriceCounter').val(totalPrice);
				jQuery('#totalPrice').val(totalPrice);
				// alert(result.msg);
			} else {
				if (result.carttotalItem == 0) {
					jQuery('.cart_number').html('0');
					// jQuery('.aa-cartbox-summary').remove();
				} else {
					jQuery('#checkoutBtn').removeClass("d-none");
					jQuery('#checkoutBtn').show();
					jQuery('.cart_number').html(result.carttotalItem);
					var html = '<div class="side-cart-items">';
					jQuery.each(result.cartdata, function (arrKey, arrVal) {
						totalMRP = parseInt(totalMRP) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						html += '<div class="cart-item"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""></div><div class="cart-text"><h4 class="text-capitalize">' + arrVal.name + '</h4><div class="cart-radio"><ul class="kggrm-now"><li><label>' + arrVal.weight + '</label></li></ul></div><div class="qty-group"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"> <input type="number" step="1" name="quantity" onchange="upadateQty(' + arrVal.pid + ')" value="' + arrVal.qty + '" class="input-text Qty_' + arrVal.pid + ' qty text"> <input type="button" value="+" class="plus plus-btn"></div><div class="cart-item-price">₹' + arrVal.price + ' <span>' + arrVal.mrp + '</span></div></div> <button type="button" onclick="deleteCartProduct(' + arrVal.pid + ')"; class="cart-close-btn"><i class="uil uil-multiply"></i></button></div></div>';
					});
					html += '</div>';
					jQuery('.totalPrice').html('₹' + totalPrice);
					var totalSaving = totalMRP - totalPrice;
					jQuery('.totalSaving').html('₹' + totalSaving);
					jQuery('.totalMRP').html('₹' + totalMRP);
					jQuery('.cart-top-total').after(html);
					jQuery('#totalPrice').val(totalPrice);
					jQuery('.totalPriceCounter').val(totalPrice);
					if (result.msg == 'added') {
						showErrortoast('item added to cart', 'far fa-check-circle');
					}
					if (result.msg == 'updated') {
						showErrortoast('item updated in cart', 'fas fa-exclamation-circle');
					}
				}

			}
		}
	});
}

function AddToCartCarousel(product_id, slug, rand, rand_num) {
	// var rand_n=0;
	// alert(rand_num);
	if (rand_num === undefined) {
		// alert('undefined');
		productQty = jQuery('#Qty' + slug + product_id + rand).val();
	} else {
		// alert('defined');
		// rand_num=rand_n;
		// alert(product_id+' '+rand_num);
		productQty = jQuery('.Qty_' + rand_num + product_id).val();
	}
	// alert('.Qty_'+rand_num+product_id);
	// alert(product_id+' '+slug+' '+rand+' '+rand_num+' '+productQty);

	if (productQty == 0) {
		productQty = 1;
	}
	jQuery('#product_id').val(product_id);
	jQuery('#product_qty').val(productQty);
	jQuery('.deleteFromCartPage').remove();
	jQuery('.side-cart-items').remove();
	jQuery.ajax({
		url: '/add_to_cart',
		data: jQuery('#frmAddToCart').serialize(),
		type: 'post',
		success: function (result) {
			var totalPrice = 0;
			var totalMRP = 0;
			if (result.msg == 'not_avaliable') {
				showErrortoast('product not available', 'fas fa-exclamation-circle');
				// alert(result.data);
			} else if (result.msg == 'qty_not_available') {
				// alert('Product quantity must be less than or equal to '+result.availableQty);
				showErrortoast('Product quantity must be less than ' + (result.availableQty + 1), 'fas fa-exclamation-circle');
				jQuery('.cart_number').html(result.carttotalItem);
				var html = '<div class="side-cart-items">';
				var html2 = '<div class="right-cart-dt-body">';
				jQuery.each(result.cartdata, function (arrKey, arrVal) {
					totalMRP = parseInt(totalMRP) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
					totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
					var rand_num = Math.floor(Math.random() * 10);
					if (rand_num == 0) {
						rand_num = 2020 + rand_num;
					}
					html += '<div class="cart-item"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""></div><div class="cart-text"><h4 class="text-capitalize">' + arrVal.name + '</h4><div class="cart-radio"><ul class="kggrm-now"><li><label>' + arrVal.weight + '</label></li></ul></div><div class="qty-group"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"> <input type="number" step="1" name="quantity" onchange="upadateQty(' + rand_num + ', ' + arrVal.pid + ')" value="' + arrVal.qty + '" class="input-text Qty_' + rand_num + arrVal.pid + ' qty text"> <input type="button" value="+" class="plus plus-btn"></div><div class="cart-item-price">₹' + arrVal.price + ' <span>' + arrVal.mrp + '</span></div></div> <button type="button" onclick="deleteCartProduct(' + arrVal.pid + ')"; class="cart-close-btn"><i class="uil uil-multiply"></i></button></div></div>';
					html2 += '<div class="cart-item deleteFromCartPage border_radius"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""><div class="offer-badge">' + arrVal.discount + '% OFF</div></div><div class="cart-text"><h4 class="text-capitalize mb-1">' + arrVal.name + '</h4><div class="d-block my-2"> <span class="custom_badge">' + arrVal.weight + '</span></div><div class="cart-item-price">₹' + arrVal.price + ' <span>₹' + arrVal.mrp + '</span><span style="font-size: 12px; color: #3e3f5c; text-decoration: none;"> X ' + arrVal.qty + ' Qty</span></div> <button type="button" class="cart-close-btn" onclick="deleteFromCartPage(' + arrVal.pid + ')";><i class="uil uil-multiply"></i></button></div></div>';
				});
				html += '</div>';
				html2 += '</div>';
				jQuery('.totalPrice').html('₹' + totalPrice);
				var totalSaving = totalMRP - totalPrice;
				jQuery('.totalSaving').html('₹' + totalSaving);
				jQuery('.totalMRP').html('₹' + totalMRP);

				jQuery('.carttotalPrice').html('₹' + totalPrice);
				jQuery('.carttotalSaving').html('₹' + totalSaving);
				jQuery('#netSaving').val(totalSaving);
				jQuery('.carttotalMRP').html('₹' + totalMRP);

				jQuery('.cart-top-total').after(html);
				jQuery('.after_order').after(html2);
				jQuery('#counertotalPrice').val(totalPrice);
				jQuery('.totalPriceCounter').val(totalPrice);
				jQuery('#totalPrice').val(totalPrice);
			} else {
				// alert(result.carttotalItem);
				if (result.carttotalItem == 0) {
					jQuery('#checkoutBtn').hide();
					jQuery('.cart_number').html('0');
					// jQuery('.aa-cartbox-summary').remove();
				} else {

					jQuery('#checkoutBtn').removeClass("d-none");
					jQuery('.cart_number').html(result.carttotalItem);
					var html = '<div class="side-cart-items">';
					var html2 = '<div class="right-cart-dt-body">';
					jQuery.each(result.cartdata, function (arrKey, arrVal) {
						totalMRP = parseInt(totalMRP) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						var rand_num = Math.floor(Math.random() * 10);
						if (rand_num == 0) {
							rand_num = 2020 + rand_num;
						}
						html += '<div class="cart-item"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""></div><div class="cart-text"><h4 class="text-capitalize">' + arrVal.name + '</h4><div class="cart-radio"><ul class="kggrm-now"><li><label>' + arrVal.weight + '</label></li></ul></div><div class="qty-group"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"> <input type="number" step="1" name="quantity" onchange="upadateQty(' + rand_num + ', ' + arrVal.pid + ')" value="' + arrVal.qty + '" class="input-text Qty_' + rand_num + arrVal.pid + ' qty text"> <input type="button" value="+" class="plus plus-btn"></div><div class="cart-item-price">₹' + arrVal.price + ' <span>' + arrVal.mrp + '</span></div></div> <button type="button" onclick="deleteCartProduct(' + arrVal.pid + ')"; class="cart-close-btn"><i class="uil uil-multiply"></i></button></div></div>';
						html2 += '<div class="cart-item deleteFromCartPage border_radius"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""><div class="offer-badge">' + arrVal.discount + '% OFF</div></div><div class="cart-text"><h4 class="text-capitalize mb-1">' + arrVal.name + '</h4><div class="d-block my-2"> <span class="custom_badge">' + arrVal.weight + '</span></div><div class="cart-item-price">₹' + arrVal.price + ' <span>₹' + arrVal.mrp + '</span><span style="font-size: 12px; color: #3e3f5c; text-decoration: none;"> X ' + arrVal.qty + ' Qty</span></div> <button type="button" class="cart-close-btn" onclick="deleteFromCartPage(' + arrVal.pid + ')";><i class="uil uil-multiply"></i></button></div></div>';
					});
					html += '</div>';
					html2 += '</div>';
					jQuery('.totalPrice').html('₹' + totalPrice);
					var totalSaving = totalMRP - totalPrice;
					jQuery('.totalSaving').html('₹' + totalSaving);
					jQuery('.totalMRP').html('₹' + totalMRP);

					jQuery('.carttotalPrice').html('₹' + totalPrice);
					jQuery('.carttotalSaving').html('₹' + totalSaving);
					jQuery('#netSaving').val(totalSaving);
					jQuery('.carttotalMRP').html('₹' + totalMRP);

					jQuery('.cart-top-total').after(html);
					jQuery('#checkoutBtn').show();
					jQuery('.after_order').after(html2);
					jQuery('#counertotalPrice').val(totalPrice);
					jQuery('.totalPriceCounter').val(totalPrice);
					jQuery('#totalPrice').val(totalPrice);
					if (result.msg == 'added') {
						showErrortoast('item added to cart', 'far fa-check-circle');
					}
					if (result.msg == 'updated') {
						showErrortoast('item updated in cart', 'fas fa-exclamation-circle');
					}

				}

			}
		}
	});
}

function upadateQty(rand_num, pid) {
	// alert(pid+' '+rand_num);
	AddToCartCarousel(pid, '', '', rand_num);
}

function deleteCartProduct(pid) {
	productQty = 0;
	jQuery('#product_id').val(pid);
	jQuery('#product_qty').val(productQty);
	jQuery('.side-cart-items').remove();
	jQuery('.deleteFromCartPage').remove();
	jQuery.ajax({
		url: '/add_to_cart',
		data: jQuery('#frmAddToCart').serialize(),
		type: 'post',
		success: function (result) {
			var totalPrice = 0;
			var totalMRP = 0;
			var totalPrice2 = 0;
			var totalMRP2 = 0;
			if (result.msg == 'not_avaliable') {
				alert(result.data);
			} else {
				// alert(result.carttotalItem);
				if (result.carttotalItem == 0) {
					jQuery('#checkoutBtn').hide();
					jQuery('.cart_number').html('0');
					empCart = '<div class="py-md-5 py-0 px-3 side-cart-items"><div class="about-img"><img src="' + NORMAL_IMAGE + '/about.svg' + '" alt=""></div><center style="margin-top: 20px;font-weight: 500;"><h4>Start Shopping!</h4></center></div>';
					jQuery('.cart-top-total').after(empCart);
					jQuery('.totalPrice').html('₹' + totalPrice);
					jQuery('.totalSaving').html('₹ 0');
					jQuery('.totalMRP').html('₹' + totalMRP);
					jQuery('#totalPrice').val(totalPrice);
					jQuery('.totalPriceCounter').val(totalPrice);
					// jQuery('.aa-cartbox-summary').remove();
				} else {
					jQuery('.cart_number').html(result.carttotalItem);
					var html = '<div class="side-cart-items">';
					var html2 = '<div class="right-cart-dt-body">';
					jQuery.each(result.cartdata, function (arrKey, arrVal) {
						totalMRP = parseInt(totalMRP) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalMRP2 = parseInt(totalMRP2) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						totalPrice2 = parseInt(totalPrice2) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						html += '<div class="cart-item"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""></div><div class="cart-text"><h4 class="text-capitalize">' + arrVal.name + '</h4><div class="cart-radio"><ul class="kggrm-now"><li><label>' + arrVal.weight + '</label></li></ul></div><div class="qty-group"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"> <input type="number" step="1" name="quantity" onchange="upadateQty(' + arrVal.pid + ')" value="' + arrVal.qty + '" class="input-text Qty_' + arrVal.pid + ' qty text"> <input type="button" value="+" class="plus plus-btn"></div><div class="cart-item-price">₹' + arrVal.price + ' <span>' + arrVal.mrp + '</span></div></div> <button type="button" onclick="deleteCartProduct(' + arrVal.pid + ')"; class="cart-close-btn"><i class="uil uil-multiply"></i></button></div></div>';
						html2 += '<div class="cart-item deleteFromCartPage border_radius"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""><div class="offer-badge">' + arrVal.discount + '% OFF</div></div><div class="cart-text"><h4 class="text-capitalize mb-1">' + arrVal.name + '</h4><div class="d-block my-2"> <span class="custom_badge">' + arrVal.weight + '</span></div><div class="cart-item-price">₹' + arrVal.price + ' <span>₹' + arrVal.mrp + '</span><span style="font-size: 12px; color: #3e3f5c; text-decoration: none;"> X ' + arrVal.qty + ' Qty</span></div> <button type="button" class="cart-close-btn" onclick="deleteFromCartPage(' + arrVal.pid + ')";><i class="uil uil-multiply"></i></button></div></div>';
					});
					html += '</div>';
					html2 += '</div>';
					jQuery('.totalPrice').html('₹' + totalPrice);
					var totalSaving = totalMRP - totalPrice;
					jQuery('.totalSaving').html('₹' + totalSaving);
					jQuery('.totalMRP').html('₹' + totalMRP);

					jQuery('.carttotalPrice').html('₹' + totalPrice2);
					var totalSaving2 = totalMRP2 - totalPrice2;
					jQuery('.carttotalSaving').html('₹' + totalSaving2);
					jQuery('#netSaving').val(totalSaving2);
					jQuery('.carttotalMRP').html('₹' + totalMRP2);

					jQuery('.cart-top-total').after(html);
					jQuery('#checkoutBtn').show();
					jQuery('.after_order').after(html2);

					jQuery('#totalPrice').val(totalPrice2);
					jQuery('.totalPriceCounter').val(totalPrice2);
					showErrortoast('Product removed from cart', 'fas fa-exclamation-circle');

				}

			}
		}
	});
}

function deleteFromCartPage(pid) {
	productQty = 0;
	jQuery('#product_id').val(pid);
	jQuery('#product_qty').val(productQty);
	jQuery('.deleteFromCartPage').remove();
	jQuery('.side-cart-items').remove();
	jQuery.ajax({
		url: '/add_to_cart',
		data: jQuery('#frmAddToCart').serialize(),
		type: 'post',
		success: function (result) {
			var totalPrice1 = 0;
			var totalPrice2 = 0;
			var totalMRP1 = 0;
			var totalMRP2 = 0;
			if (result.msg == 'not_avaliable') {
				alert(result.data);
			} else {
				if (result.carttotalItem == 0) {
					jQuery('.cart_number').html('0');
					window.location.href = '/';
					// jQuery('.aa-cartbox-summary').remove();
				} else {
					jQuery('.cart_number').html(result.carttotalItem);
					var html1 = '<div class="side-cart-items">';
					jQuery.each(result.cartdata, function (arrKey, arrVal) {
						totalMRP1 = parseInt(totalMRP1) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalPrice1 = parseInt(totalPrice1) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						html1 += '<div class="cart-item"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""></div><div class="cart-text"><h4 class="text-capitalize">' + arrVal.name + '</h4><div class="cart-radio"><ul class="kggrm-now"><li><label>' + arrVal.weight + '</label></li></ul></div><div class="qty-group"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"> <input type="number" step="1" name="quantity" onchange="upadateQty(' + arrVal.pid + ')" value="' + arrVal.qty + '" class="input-text Qty_' + arrVal.pid + ' qty text"> <input type="button" value="+" class="plus plus-btn"></div><div class="cart-item-price">₹' + arrVal.price + ' <span>' + arrVal.mrp + '</span></div></div> <button type="button" onclick="deleteCartProduct(' + arrVal.pid + ')"; class="cart-close-btn"><i class="uil uil-multiply"></i></button></div></div>';
					});
					html1 += '</div>';
					var html2 = '<div class="right-cart-dt-body">';
					jQuery.each(result.cartdata, function (arrKey, arrVal) {
						totalMRP2 = parseInt(totalMRP2) + (parseInt(arrVal.qty) * parseInt(arrVal.mrp));
						totalPrice2 = parseInt(totalPrice2) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
						html2 += '<div class="cart-item deleteFromCartPage border_radius"><div class="cart-product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""><div class="offer-badge">' + arrVal.discount + '% OFF</div></div><div class="cart-text"><h4 class="text-capitalize mb-1">' + arrVal.name + '</h4><div class="d-block my-2"> <span class="custom_badge">' + arrVal.weight + '</span></div><div class="cart-item-price">₹' + arrVal.price + ' <span>₹' + arrVal.mrp + '</span><span style="font-size: 12px; color: #3e3f5c; text-decoration: none;"> X ' + arrVal.qty + ' Qty</span></div> <button type="button" class="cart-close-btn" onclick="deleteFromCartPage(' + arrVal.pid + ')";><i class="uil uil-multiply"></i></button></div></div>';
					});
					html2 += '</div>';
					jQuery('.totalPrice').html('₹' + totalPrice1);
					var totalSaving1 = totalMRP1 - totalPrice1;
					jQuery('.totalSaving').html('₹' + totalSaving1);
					jQuery('.totalMRP').html('₹' + totalMRP1);
					jQuery('.carttotalPrice').html('₹' + totalPrice2);
					var totalSaving2 = totalMRP2 - totalPrice2;
					jQuery('.carttotalSaving').html('₹' + totalSaving2);
					jQuery('#netSaving').val(totalSaving2);
					jQuery('.carttotalMRP').html('₹' + totalMRP2);
					jQuery('.after_order').after(html2);
					jQuery('.cart-top-total').after(html1);

					jQuery('#totalPrice').val(totalPrice2);
					jQuery('.totalPriceCounter').val(totalPrice2);
					showErrortoast('Product removed from cart', 'fas fa-exclamation-circle');

				}

			}
		}
	});
}

jQuery('#frmRegistration').submit(function (e) {
	e.preventDefault();
	jQuery('#btnRegistration').html('Please wait...');
	jQuery('#thank_you_msg').hide();
	jQuery('.custom_error').hide();
	jQuery.ajax({
		url: 'registration_process',
		data: jQuery('#frmRegistration').serialize(),
		type: 'post',
		success: function (result) {
			if (result.status == "error") {
				jQuery('#btnRegistration').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
				jQuery.each(result.error, function (key, val) {
					jQuery('#' + key + '_error').show();
					jQuery('#' + key + '_error').html(val[0]);
					// console.log(key);
				});
			}

			if (result.status == "success") {
				jQuery('#btnRegistration').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
				jQuery('#frmRegistration')[0].reset();
				jQuery('#thank_you_msg').show();
				jQuery('#thank_you_msg').html(result.msg);
			}
		}
	});
});

function signinUser(moveTo) {
	jQuery('#login_msg').hide();
	jQuery('#btnLogin').html('Please wait...');

	if (jQuery('#login_email').val() == '') {
		jQuery('#login_email').attr("placeholder", "Enter Your Email Here");
		jQuery('#login_email').focus();
		jQuery('#btnLogin').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');
	} else if (jQuery('#login_password').val() == '') {
		jQuery('#login_password').attr("placeholder", "Enter Your Password Here");
		jQuery('#login_password').focus();
		jQuery('#btnLogin').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');
	} else {
		jQuery.ajax({
			url: '/login_process',
			data: jQuery('#frmLogin').serialize(),
			type: 'post',
			success: function (result) {
				jQuery('#main_login_msg').html('');
				if (result.status == "error") {
					jQuery('#btnLogin').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');
					jQuery('#login_msg').show();
					jQuery('#main_login_msg').html(result.msg);
				}

				if (result.status == "success") {
					jQuery('#btnLogin').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');
					if (moveTo == 'home') {
						window.location.href = '/';
					}
					if (moveTo == 'reload') {
						window.location.href = window.location.href;
					}
				}
			}
		});
	}
}

function login_next() {
	jQuery('#login_next__1').html('Please wait');
	var login_number = jQuery('#login_number').val();
	if (login_number == '') {
		jQuery('#login_next__1').html('Next');
		jQuery('#login_number').val('');
		jQuery('#login_number').attr("placeholder", "Enter Your mobile Here");
		jQuery('#login_number').focus();
	} else if (login_number.length != 10) {
		jQuery('#login_next__1').html('Next');
		jQuery('#login_number').val('');
		jQuery('#login_number').attr("placeholder", "Invalid mobile number");
		jQuery('#login_number').focus();
	} else {
		jQuery.ajax({
			type: 'post',
			url: '/check-user-registered',
			data: 'mobile=' + login_number,
			success: function (result) {
				if (result == 1) {
					jQuery('#login_number_final').val('+91' + login_number);
					jQuery('#sec_1').hide();
					jQuery('#sec_2').show();
				} else {
					jQuery('#conNum').html('');
					jQuery('#conNum').html(login_number);
					jQuery('#sign_up_number').val(login_number);
					// jQuery('#sec_1').hide();
					// jQuery('#sec_3').show();
					send_mobile_otp(login_number);
					jQuery('#code1').focus();
				}
			}
		});
	}
}

function send_mobile_otp(login_number) {
	jQuery.ajax({
		type: 'post',
		url: '/send_otp',
		data: 'number=' + login_number,
		success: function (result) {
			// alert('done');
			if (result == 'done') {
				showErrortoast('please enter the OTP sent on ' + login_number, 'fas fa-exclamation-circle');
				jQuery('#sec_1').hide();
				jQuery('#sec_3').show();
			} else {
				showErrortoast('something went wrong! please retry again', 'fas fa-exclamation-circle');
				// jQuery('#sec_3').hide();
				// jQuery('#sec_1').show();
				jQuery('#login_next__1').html('Next');
			}
		}
	});
}

function login_modal_home_reset() {
	jQuery('#sec_1').show();
	jQuery('#sec_2').hide();
	jQuery('#sec_3').hide();
	jQuery('#sec_4').hide();
	jQuery('#sec_5').hide();
	jQuery('#forget_email').val('');
	jQuery('#forget_email').attr("readonly", false);

	jQuery('#code1').val('');
	jQuery('#code2').val('');
	jQuery('#code3').val('');
	jQuery('#code4').val('');
	jQuery('#code5').val('');
	jQuery('#login_number').val('');
	jQuery('#login_next__1').html('Next');
	
}

function movetoNext(current, nextFieldID) {
	if (current.value.length >= current.maxLength) {
		document.getElementById(nextFieldID).focus();
	}
}

function movetoPrev(current, nextFieldID) {
	if (current.value.length <= current.maxLength) {
		document.getElementById(nextFieldID).focus();
	}
}

function otp_next_sec_4() {
	jQuery('#login_next__3').html('Please wait');
	// jQuery('#loginError__2').html('');
	// jQuery('#loginError__2').hide();
	var otp1 = jQuery('#code1').val();
	var otp2 = jQuery('#code2').val();
	var otp3 = jQuery('#code3').val();
	var otp4 = jQuery('#code4').val();
	var otp5 = jQuery('#code5').val();

	if (otp1 != '' && otp2 != '' && otp3 != '' && otp4 != '' && otp5 != '') {
		jQuery.ajax({
			type: 'post',
			url: '/verify_OTP',
			data: 'otp1=' + otp1 + '&otp2=' + otp2 + '&otp3=' + otp3 + '&otp4=' + otp4 + '&otp5=' + otp5,
			success: function (result) {
				if (result == 'verified') {
					jQuery('#sec_3').hide();
					jQuery('#sec_4').show();
				} else {
					jQuery('#code1').val('');
					jQuery('#code1').focus();
					jQuery('#code2').val('');
					jQuery('#code3').val('');
					jQuery('#code4').val('');
					jQuery('#code5').val('');
					// alert('Incorrect OTP');
					// jQuery('#loginError__2').show();
					//       jQuery('#loginError__2').html('Incorrect OTP');
					showErrortoast('Incorrect OTP', 'fas fa-exclamation-circle');
					jQuery('#login_next__3').html('Next');
				}
			}
		});
	} else {
		jQuery('#code1').val('');
		jQuery('#code1').focus();
		jQuery('#code2').val('');
		jQuery('#code3').val('');
		jQuery('#code4').val('');
		jQuery('#code5').val('');
		// jQuery('#loginError__2').show();
		showErrortoast('Enter OTP', 'fas fa-exclamation-circle');
		//    jQuery('#loginError__2').html('Enter OTP');
		jQuery('#login_next__3').html('Next');
	}

}

function login_next_sec_2() {
	// jQuery('#loginError__1').html('');
	// jQuery('#loginError__1').hide();
	jQuery('#login_next__2').html('Please wait');
	var login_number = jQuery('#login_number').val();
	var login_password = jQuery('#login_password_final').val();
	if (login_password == '') {
		jQuery('#login_password_final').val('');
		jQuery('#login_password_final').attr("placeholder", "Enter Password");
		jQuery('#login_password_final').focus();
		jQuery('#login_next__2').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');

	} else {
		jQuery.ajax({
			type: 'post',
			url: '/user_login_process',
			data: 'mobile=' + login_number + '&Password=' + login_password,
			success: function (result) {
				if (result.status == 'success') {
					window.location.href = '/';
				}
				if (result.status == 'error') {
					jQuery('#login_next__2').html('Sign In Now <i class="fas fa-sign-in-alt"></i>');
					// jQuery('#login_password_final').val('');
					// jQuery('#login_password_final').attr("placeholder", "Incorrect Password");
					//  jQuery('#login_password_final').focus();
					// jQuery('#loginError__1').show();
					// jQuery('#loginError__1').html('Incorrect Password');
					showErrortoast('Incorrect Password', 'fas fa-exclamation-circle');
				}
			}
		});
	}
}

function forgetPassword() {
	jQuery('#sec_1').hide();
	jQuery('#sec_2').hide();
	jQuery('#sec_3').hide();
	jQuery('#sec_4').hide();
	jQuery('#sec_5').show();

}

function reset_password_email() {
	jQuery('#cres').remove();
	jQuery('#cres').html('');
	jQuery('#login_next__5').html('Please wait');
	var reset_email = jQuery('#forget_email').val();
	if (reset_email=='') {
		showErrortoast('Enter Your Email', 'fas fa-exclamation-circle');
		jQuery('#forget_email').focus();
		jQuery('#forget_email').attr("placeholder", 'Enter Your Mobile Or E-Mail Here');
		jQuery('#login_next__5').html('Reset Password <i class="fas fa-sign-in-alt"></i>');
	}else{
			var alert = '';
		jQuery('#forget_email').attr("readonly", true);
		jQuery.ajax({
			type:'post',
			url:'send_reset_password_email',
			data: 'login=' + reset_email,
			success: function (result) {
				if(result=='done'){
					alert += '<div class="alert custom_alert mt-3" style="display:block!important;" id="cres" role="alert">Check Your E-Mail For Reset Password Link</div>';
					jQuery('#cres').show();
					jQuery('#login_next__5').after(alert);
					jQuery('#login_next__5').html('Reset Password <i class="fas fa-sign-in-alt"></i>');
					jQuery('#forget_email').val("");
					jQuery('#forget_email').attr("readonly", false);
					// setTimeout(function(){ jQuery('#cres').fadeOut(); },5000);				
				}else{
					jQuery('#forget_email').attr("readonly", false);
					jQuery('#login_next__5').html('Reset Password <i class="fas fa-sign-in-alt"></i>');
					alert += '<div class="alert custom_alert mt-3" style="display:block!important;" id="cres" role="alert">Account Doesn\'t Exists!</div>';
					jQuery('#cres').show();
					jQuery('#login_next__5').after(alert);
				}
				setTimeout(function(){ jQuery('#cres').fadeOut(); },5000);				
			}
		});
	}
}

jQuery('#resetPassword').submit(function (e) {
	e.preventDefault();
	jQuery('#allert').hide();
	jQuery('#cpass').html('Please wait');
	jQuery('#allert').remove();
	jQuery.ajax({
		url: '/updateUserPassword',
		data: jQuery('#resetPassword').serialize(),
		type: 'post',
		success: function (result) {
			// alert(result);
			var alert = '';
			if (result=='done') {
				alert += '<div class="alert custom_alert mt-3" style="display:block!important;" id="allert" role="alert">Password updated successfully</div>';
				jQuery('#cpass').html('Redirecting...');
				setTimeout(function(){ 
					// jQuery('#allert').fadeOut(); 
					window.location.href='/login';
				},5000);
			}else{
				alert += '<div class="alert custom_alert mt-3" style="display:block!important;" id="allert" role="alert">Password not matched</div>';
				jQuery('#cpass').html('Reset Password <i class="fas fa-sign-in-alt"></i>');
			}
			jQuery('#allert').show();
			jQuery('#cpass').after(alert);
			jQuery('#confirmpassword').val('');
			// jQuery('#password').attr("disabled", true);
			// jQuery('#confirmpassword').attr("disabled", true);
			jQuery('#confirmpassword').blur();
			jQuery('#password').val('');
			// jQuery('#cpass').html('Reset Password <i class="fas fa-sign-in-alt"></i>');
			setTimeout(function(){ 
				jQuery('#allert').fadeOut(); 
				// window.location.href='/login';
			},5000);			
			// showErrortoast('Redirecting...', 'fas fa-exclamation-circle');
			// setTimeout(function(){ window.location.href='/login'; },7000);			
		}
	});	
});

function registration_next() {
	// jQuery('#loginError__3').html('');
	// jQuery('#loginError__3').hide();
	jQuery('#registration_next').html('Please wait');
	var sign_up_name = jQuery('#sign_up_name').val();
	var sign_up_email = jQuery('#sign_up_email').val();
	var sign_up_number = jQuery('#sign_up_number').val();
	var sign_up_password = jQuery('#sign_up_password').val();
	var refer_code = jQuery('#refer_code').val();

	if (sign_up_name == '') {
		jQuery('#registration_next').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
		jQuery('#sign_up_name').val('');
		jQuery('#sign_up_name').attr("placeholder", "Enter name");
		jQuery('#sign_up_name').focus();
	} else if (sign_up_email == '') {
		jQuery('#registration_next').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
		jQuery('#sign_up_email').val('');
		jQuery('#sign_up_email').attr("placeholder", "Enter Email");
		jQuery('#sign_up_email').focus();
	} else if (sign_up_password == '') {
		jQuery('#registration_next').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
		jQuery('#sign_up_password').val('');
		jQuery('#sign_up_password').attr("placeholder", "Enter Password");
		jQuery('#sign_up_password').focus();
	} else {
		jQuery.ajax({
			type: 'post',
			url: '/registration_next',
			data: 'name=' + sign_up_name + '&email=' + sign_up_email + '&password=' + sign_up_password + '&number=' + sign_up_number + '&refer_code=' + refer_code,
			success: function (result) {
				if (result == 'invalid email') {
					jQuery('#loginError__1').show();
					jQuery('#loginError__1').html('Invalid Email');
					jQuery('#registration_next').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
					// alert(result+' 1');
				} else if (result == 'email registered') {
					// alert(result);
					showErrortoast('Email Already Registered', 'fas fa-exclamation-circle');
					// jQuery('#loginError__3').show();
					// jQuery('#loginError__3').html('Email Already Registered');
					// jQuery('#sign_up_email').attr("placeholder", "Enter Email");
					// jQuery('#sign_up_email').focus();
					jQuery('#registration_next').html('Sign Up Now <i class="fas fa-sign-in-alt"></i>');
				} else {
					// alert(result);
					window.location.href = '/';

				}
			}
		});
	}
}

function applyCouponCode() {
	// jQuery('#coupon_error').show();
	jQuery('#offerdiv').hide();
	// jQuery('#coupon_error').hide();
	jQuery('#submitBtn').html('loading');
	// jQuery('#coupon_code_msg').html('');
	jQuery('#order_place_msg').html('');
	var coupon_code = jQuery('#coupon_code').val();
	if (coupon_code != '') {
		jQuery.ajax({
			type: 'post',
			url: '/apply_coupon_code',
			data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
			success: function (result) {
				// console.log(result.status);
				jQuery('#coupon_error').show();
				if (result.status == 'success') {
					jQuery('#removeBtn').show();
					jQuery('#submitBtn').hide();
					jQuery('#submitBtn').html('Apply');
					// jQuery('.show_coupon_box').removeClass('hide');
					// jQuery('#coupon_code_str').html(coupon_code);
					showErrortoast(result.msg, 'fas fa-exclamation-circle');
					// jQuery('#coupon_error_msg').html(result.msg);
					jQuery('.carttotalPrice').html('₹' + result.finalPrice);
					jQuery('.totalPrice').html('₹' + result.finalPrice);
					// jQuery('.apply_coupon_code_box').hide();
					if (result.discountType == 'instant') {
						var offerdiv = '<div class="cart-total-dil pt-3 px-4 offerdiv"><h4>Coupon Discount</h4><span>₹' + result.discount + '</span></div>';
						jQuery('.saving-total').after(offerdiv);
					}
					jQuery('#totalPrice').val(result.finalPrice);
					jQuery('.totalPriceCounter').val(result.finalPrice);
					jQuery('#counertotalPrice').val(result.finalPrice);
					jQuery('#discount').val(result.discount);
					jQuery('#coupon_value').val(result.value);
					// alert(result.coupon_code);
					jQuery('#couponcode').val(result.coupon_code);
					jQuery('#coupon_id').val(result.coupon_id);


				}
				// else{
				//      jQuery('#coupon_code_msg').html(result.msg);          
				//     }
				if (result.status == 'error') {
					jQuery('#removeBtn').hide();
					jQuery('#submitBtn').show();
					jQuery('#submitBtn').html('Apply');
					showErrortoast(result.msg, 'fas fa-exclamation-circle');
					// jQuery('#coupon_error_msg').html(result.msg);
				}

			}
		});
	} else {
		jQuery('#coupon_error').show();
		jQuery('#removeBtn').hide();
		jQuery('#submitBtn').show();
		jQuery('#submitBtn').html('Apply');
		showErrortoast('Please enter coupon code', 'fas fa-exclamation-circle');
		// jQuery('#coupon_error_msg').html('Please enter coupon code');
	}
	// jQuery('#coupon_error').delay(5).hide();
}

function paymentmethodWallet(value) {
	jQuery('#removePrevBalDiv').remove();
	if (value == 'order_daily') {
		var finalPrice = parseInt(jQuery('#totalPriceCounter').val());
		var TempDeliveryDays = jQuery('#delivery_days').val();
	} else {
		var finalPrice = parseInt(jQuery('#totalPrice').val());
	}
	var walletBalance = parseInt(jQuery('#finalwalletbalance').val());
	var error = '';
	// alert(finalPrice+' '+walletBalance);
	if (finalPrice > walletBalance) {
		// jQuery('#removePrevBalDivList').remove();
		error = 'yes';
		alert('insufficient balance in wallet');
		if (value == 'order_daily') {
			var ShowDiv = '<div class="radio-item_1" id="removePrevBalDiv"><input id="wallet1" value="wallet" name="paymentmethod" type="radio"><label  for="wallet1" onclick="paymentmethodWallet(\'order_daily\')" class="radio-label_1"><span data-tooltip="Balance Insufficient" data-inverted="" data-position="top center">Balance ₹' + walletBalance + '</span></label></div>';
		} else {
			var ShowDiv = '<div class="radio-item_1" id="removePrevBalDiv"><input id="wallet1" value="wallet" name="paymentmethod" type="radio"><label for="wallet1" onclick="paymentmethodWallet()" class="radio-label_1"><span data-tooltip="Balance Insufficient" data-inverted="" data-position="top center">Balance ₹' + walletBalance + '</span></label></div>';
		}
	} else {
		jQuery('#finalOrderBtn').html('Place Order');
		var ShowDiv = '<div class="radio-item_1" id="removePrevBalDiv"><input id="wallet1" value="wallet" name="paymentmethod" checked="" type="radio"><label for="wallet1" onclick="paymentmethodWallet()" class="radio-label_1">Balance ₹' + walletBalance + '</label></div>';
		error = 'no';
	}
	jQuery('#removePrevBalDivList').append(ShowDiv);
	paymentmethod(error);
}

function removeCouponCode() {
	jQuery('#coupon_error').show();
	jQuery('#removeBtn').hide();
	jQuery('#submitBtn').show();
	jQuery('.offerdiv').remove();
	jQuery('#coupon_code').val('');
	jQuery('#coupon_error_msg').html('coupon removed');

	jQuery.ajax({
		url: '/cartAmount',
		data: jQuery('#applyCoupon').serialize(),
		type: 'post',
		success: function (result) {
			// alert('₹'+result.totalPrice);
			jQuery('.carttotalPrice').html('₹' + result.totalPrice);
			jQuery('.totalPrice').html('₹' + result.totalPrice);
			jQuery('#discount').val(0);
			jQuery('#coupon_value').val(0);
			jQuery('#couponcode').val('');
			jQuery('#coupon_id').val(0);
			jQuery('#totalPrice').val(result.totalPrice);
			jQuery('.totalPriceCounter').val(result.totalPrice);
			showErrortoast('coupon removed', 'fas fa-exclamation-circle');
		}
	});
}

function address_type(value) {
	jQuery('#buyer_add_type').val(value);
	// alert(value);
}

function checkoutForm11(value) {
	var buyer_mobile = jQuery('#buyer_new_umber').val();
	if (buyer_mobile == "") {
		buyer_mobile = value;
		jQuery('#buyer_number').val(buyer_mobile);
		jQuery('#collapseTwo').collapse("show");
		jQuery('#collapseOneHead').attr("disabled", false);
		jQuery('#collapseTwoHead').attr("disabled", false);
		// jQuery('#buyer_mobile').attr("placeholder", "Enter Your mobile Here");
		// jQuery('#buyer_mobile').focus();
	} else {
		// alert(buyer_mobile);//href="#collapseTwo"
		jQuery('#buyer_number').val(buyer_mobile);
		jQuery('#collapseTwo').collapse("show");
		jQuery('#collapseOneHead').attr("disabled", false);
		jQuery('#collapseTwoHead').attr("disabled", false);

	}
}

// function checkoutForm1() {
//    var buyer_mobile=jQuery('#buyer_mobile').val();
//    if(buyer_mobile=="" ){
//     jQuery('#buyer_mobile').attr("placeholder", "Enter Your mobile Here");
//     jQuery('#buyer_mobile').focus();
//    }
//    else{
//    	// alert(buyer_mobile);//href="#collapseTwo"
//     jQuery('#buyer_number').val(buyer_mobile);
//     jQuery('#collapseTwo').collapse("show");
//     jQuery('#collapseTwoHead').attr("disabled", false);

//    }
// }

function checkoutForm2(value) {
	jQuery('#checkout_msg').hide();
	// jQuery('#couponcode').val('not used');
	// var address_type=jQuery('.address_type').val();
	var name = jQuery('#buyername').val();
	var add1 = jQuery('#buyeradd1').val();
	var add2 = jQuery('#buyeradd2').val();
	var pincode = jQuery('#buyerpincode').val();
	var city = jQuery('#buyercity').val();
	var state = jQuery('#buyerstate').val();
	var buyeremail = jQuery('#buyeremail').val();
	var counter1 = jQuery('#counter1').val();

	if (counter1 == 'passed') {
		jQuery('#collapseThreeHead').attr("disabled", false);
		jQuery('#collapseThree').collapse("show");
	} else {
		if (name == "") {
			jQuery('#buyername').attr("placeholder", "Enter Your Name Here");
			jQuery('#buyername').focus();
		} else if (buyeremail == "") {
			jQuery('#buyeremail').attr("placeholder", "Enter Your Email Here");
			jQuery('#buyeremail').focus();
		} else if (add1 == "") {
			jQuery('#buyeradd1').attr("placeholder", "Enter Your Address Here");
			jQuery('#buyeradd1').focus();
		} else if (add2 == "") {
			jQuery('#buyeradd2').attr("placeholder", "Enter Your Address Here");
			jQuery('#buyeradd2').focus();
		} else if (city == "") {
			jQuery('#buyercity').attr("placeholder", "Enter Your Locality Here");
			jQuery('#buyercity').focus();
		} else if (state == "") {
			jQuery('#buyerstate').attr("placeholder", "Enter Your State Here");
			jQuery('#buyerstate').focus();
		} else if (pincode == "") {
			jQuery('#buyerpincode').attr("placeholder", "Enter Your Pincode Here");
			jQuery('#buyerpincode').focus();
		} else if (pincode.length != 6) {
			jQuery('#checkout_msg').show();
			jQuery('#checkout_main_msg').html('');
			jQuery('#checkout_main_msg').html('Invalid Pincode');
			jQuery('#buyerpincode').focus();
		} else {
			jQuery('#buyer_name').val(name);
			jQuery('#buyer_add1').val(add1);
			jQuery('#buyer_add2').val(add2);
			jQuery('#buyer_city').val(city);
			jQuery('#buyer_state').val(state);
			jQuery('#buyer_email').val(buyeremail);
			jQuery('#buyer_zip').val(pincode);
			jQuery('#collapseThreeHead').attr("disabled", false);
			jQuery('#collapseThree').collapse("show");

		}
	}
}

function selectAddress(name, main_address, street, city, state, pincode) {
	jQuery('#buyer_name').val(name);
	jQuery('#buyer_add1').val(main_address);
	jQuery('#buyer_add2').val(street);
	jQuery('#buyer_city').val(city);
	jQuery('#buyer_state').val(state);
	jQuery('#buyer_zip').val(pincode);
	jQuery('#counter1').val('passed');
}

function delivery_schedule() {
	var delivery_date = $("input[name='delivery_date']:checked").val();
	var delivery_time = $("input[name='delivery_time']:checked").val();

	if (delivery_date != '' && delivery_time != '') {
		jQuery('#delivery_time').val(delivery_time);
		jQuery('#delivery_date').val(delivery_date);
		jQuery('#collapsefourHead').attr("disabled", false);
		jQuery('#collapsefour').collapse("show");
	} else {

	}

}

function delivery_days(days) {
	// jQuery('#totalPriceCounter').val('');
	// jQuery('#totalPrice').val('');
	// jQuery('#delivery_days').val('');
	jQuery('#delivery_days').val(days);
	var DeliveryDays = jQuery('#delivery_days').val();
	var TotalAmount = jQuery('#totalPriceCounter').val();
	var Amount = jQuery('#totalPrice').val();
	jQuery('#totalPriceCounter').val(DeliveryDays * Amount);
	jQuery('#finaldailyprice').remove();
	if (DeliveryDays == 1) {
		var afterfinaldailyprice = '<span class="carttotalPrice" id="finaldailyprice" data-position="bottom center" data-tooltip="Payable Amount ₹' + Amount + '">₹' + Amount + ' X 1 Day</span>';
	} else {
		var afterfinaldailyprice = '<span class="carttotalPrice" id="finaldailyprice" data-position="bottom center" data-tooltip="Payable Amount ₹' + Amount * DeliveryDays + '">₹' + Amount + ' X ' + DeliveryDays + ' Days</span>';
	}
	// jQuery('#totalPrice').val(DeliveryDays*TotalAmount);
	// if(delivery_date!='' && delivery_time!=''){
	// jQuery('#delivery_time').val(delivery_time);
	// jQuery('#delivery_date').val(delivery_date);
	jQuery('#afterfinaldailyprice').after(afterfinaldailyprice);
	jQuery('#collapsefourHead').attr("disabled", false);
	jQuery('#collapsefour').collapse("show");
	// }else{

	// }

}

function paymentmethod(error, value) {
	// alert(error);
	if (value == 'order_daily') {
		// alert('yes');
		if (error == 'no' || error == '') {
			// alert('here'); 
			jQuery('#delivery_daily').val('yes');
			var paymentmethod = $("input[name='paymentmethod']:checked").val();
			if (paymentmethod != '') {
				jQuery('#finalOrderBtn').html('Please wait');
				jQuery('#payment_method').val(paymentmethod);
				jQuery.ajax({
					url: '/checkoutForm2',
					data: jQuery('#checkoutForm2').serialize(),
					type: 'post',
					success: function (result) {
						// alert(result.payment_url);
						// if (result.payment_url=='CashOnDelivery') {
						// 	window.location.href='/order-confirmation';
						// }

						if (result.payment_url == 'PaymentGateway') {
							window.location.href = '/pay';
						}

						if (result.payment_url == 'wallet') {
							window.location.href = '/order-confirmation';
						}
					}
				});
			}
		} else {
			jQuery('#finalOrderBtn').html('Place Order');
			jQuery('#wallet1').attr('disabled', true);

			alert('wallet issue');
		}
	} else {
		if (error == 'no' || error == null) {
			// alert('here');
			var paymentmethod = $("input[name='paymentmethod']:checked").val();
			if (paymentmethod != '') {
				jQuery('#finalOrderBtn').html('Please wait');
				jQuery('#payment_method').val(paymentmethod);
				jQuery.ajax({
					url: '/checkoutForm2',
					data: jQuery('#checkoutForm2').serialize(),
					type: 'post',
					success: function (result) {
						// alert(result.payment_url);
						// if (result.payment_url=='CashOnDelivery') {
						// 	window.location.href='/order-confirmation';
						// }

						if (result.payment_url == 'PaymentGateway') {
							window.location.href = '/pay';
						} else {
							window.location.href = '/order-confirmation';
						}
						// jQuery('#collapseThree').collapse("show");
						// jQuery('#collapse3').attr('disabled',false);
						// jQuery('#collapseforThree').attr('disabled',false);
						// jQuery('#forcollapsethree').attr('href','#collapseThree');
					}
				});
			}
		} else {
			jQuery('#finalOrderBtn').html('Place Order');
			jQuery('#wallet1').attr('disabled', true);
			alert('wallet issue');
		}
	}
}

function continueCollapse() {
	jQuery('#collapseOne').collapse("show");
	jQuery('#collapseOneHead').attr("disabled", false);
}

function order_detail(order_id) {
	jQuery('#oid').html(order_id);
	jQuery.ajax({
		url: 'order-detail/' + order_id,
		// data:'id='+order_id,
		type: 'get',
		success: function (result) {
			alert('done');
		}
	});
}

function sort_by(value) {
	jQuery('#sort_by').val(value);
	jQuery.ajax({
		url:'?sort='+value,
		data: jQuery('#frmSort').serialize(),
		type: 'post',
		success: function (result) {
			// alert(result);
			jQuery('.showRow').remove();
			var html = '<div class="row showRow">';
			jQuery.each(result.products, function (arrKey, arrVal) {
				var rand_num = Math.floor(Math.random() * 10);
				var temp_slug = arrVal.slug.replaceAll('-', '')
				html += '<div class="col-lg-3 col-md-6"><div class="product-item mb-30"> <a href="' + PATH + '/products/' + arrVal.slug + '" class="product-img"> <img src="' + PRODUCT_IMAGE + '/' + arrVal.image1 + '" alt=""><div class="product-absolute-options"> <span class="offer-badge-1">' + arrVal.discount + '% off</span> <span class="like-icon" onclick="AddToWishlist(' + arrVal.pid + ')" title="wishlist"></span></div> </a><div class="product-text-dt"><p>Available<span>(In Stock)</span></p><h4>' + arrVal.name + '</h4><div class="product-price">₹' + arrVal.price + ' <span>₹' + arrVal.mrp + '</span></div><div class="qty-cart"><div class="quantity buttons_added"> <input type="button" value="-" class="minus minus-btn"><input type="number" step="1" name="quantity" value="1" id="Qty' + temp_slug + arrVal.product_id + rand_num + '" class="input-text qty text"> <input type="button" value="+" class="plus plus-btn"></div> <span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel(' + arrVal.product_id + ', \'' + temp_slug + '\', ' + rand_num + ')"></i></span></div></div></div></div>';
			});
			html += '<div class="col-md-12"><div class="more-product-btn"><button class="show-more-btn hover-btn" onclick="window.location.href = window.location.href;">Show More</button></div></div>';
			jQuery('.product-list-view').after(html);
		}
	});
	// jQuery('#frmSort').submit();
}

function item_sort(sort,prevSort,webPage,page) {
	if (sort!='') {
		if (page!='') {
			window.location.href='/'+webPage+'/'+sort+'?page='+page;			
		}else{
			window.location.href='/'+webPage+'/'+sort;
		}
	}
	else if (prevSort!='') {
		if (page!='') {
			window.location.href='/'+webPage+'/'+prevSort+'?page='+page;			
		}else{
			window.location.href='/'+webPage+'/'+prevSort;
		}
	}else{
		if (page!='') {
			window.location.href='/'+webPage+'/'+sort+'?page='+page;			
		}else{
			window.location.href='/'+webPage+'/'+sort;
		}
	}
}

function item_sort_category_page(sort,webPage,page,urlcategory,urlsubcategory,from) {
	if (from=='') {
		window.location.href='/'+webPage+'?sort='+sort+'&category='+urlcategory+'&subcategory='+urlsubcategory;			
	}else{
		window.location.href='/'+webPage+'?from=all&sort='+sort+'&category='+urlcategory+'&subcategory='+urlsubcategory;			
		// window.location.href='/'+webPage+'?sort='+prevSort+'&category='+urlcategory+'&urlsubcategory='+urlsubcategory+'&page='+page;			
	}
}

function applyFilter(curPage,page,urlcategory,urlsubcategory,urlcategoryslug,thispage,from) {
	//for category filter
	var items = [];
	$("input:checkbox[name=categoryfilter]:checked").each(function () {
		items.push($(this).val());
		jQuery('#category').val('category');
	});
	// alert(items.length);
	if (items.length == 0) {
		jQuery('#category').val('');
		var catFilter = '';
	} else {
		var catFilter = jQuery('#category').val();
	}

	// for subcategories
	var subitems = [];
	$("input:checkbox[name=subcategoryfilter]:checked").each(function () {
		subitems.push($(this).val());
		jQuery('#subcategory').val('subcategory');
	});
	if (subitems.length == 0) {
		jQuery('#subcategory').val('');
		var subcatFilter = '';
	} else {
		var subcatFilter = jQuery('#subcategory').val();
	}

	// alert('subcategoryfilter='+subcatFilter+' catFilter='+catFilter);
	if(from=='all'){
		if (items!='') {
			// alert('14');
			if(subitems==''){
				window.location.href='/categories/'+thispage+'?from=all&category='+items + '&subcategory=null';
			}else{
				window.location.href='/categories/'+thispage+'?from=all&category='+items + '&subcategory=' + subitems;
			}
		}
		else{
			// alert('16');
			if(subitems==''){
				window.location.href='/categories/'+thispage+'?from=all&category=null' + '&subcategory=null';
			}else{
				window.location.href='/categories/'+thispage+'?from=all&category=null' + '&subcategory=' + subitems;
			}
		}
	}
	else{	
		if (urlcategoryslug=='null') {urlcategoryslug=thispage;}
		if (subcatFilter != '' && catFilter != '') {
			// alert('13');
				window.location.href='/categories/'+urlcategoryslug+'?category='+items + '&subcategory=' + subitems;
		} 
		else {
			if (catFilter != '' && subcatFilter == '') {
			// alert('1');
				window.location.href='/categories/'+urlcategoryslug+'?category='+items + '&subcategory=null';
				// window.location.href='/categories/'+urlcategoryslug+'?category='+items;
				
			} else if (subcatFilter != '' && catFilter == '') {
			// alert('12');
				window.location.href='/categories/'+urlcategoryslug+'?category=null' + '&subcategory=' + subitems;
			} 
			else {
			}
		}
	}
}

function setAddressType(value) {
	// alert(value);
	jQuery('#addType').val(value);
}

function setaddType(value) {
	jQuery('#setaddType').val(value);
	jQuery('.ad1').css("background-color", "#c7c7c7");
	jQuery('.ad2').css("background-color", "#c7c7c7");
	jQuery('.ad3').css("background-color", "#c7c7c7");
	jQuery('#setaddType').val(value);
	if (value == 'home') {
		$(".ad1").css("background-color", "#f55d2c");
		// jQuery('.ad1').attr('checked', 'true');
	}
	if (value == 'office') {
		$(".ad2").css("background-color", "#f55d2c");
	}
	if (value == 'other') {
		$(".ad3").css("background-color", "#f55d2c");
	}
}

function btnAddress() {
	var setaddType = jQuery('#setaddType').val();
	var user_addresses_name = jQuery('#add_addresses_name').val();
	var main_address = jQuery('#add_addresses_main_address').val();
	var street = jQuery('#add_addresses_street').val();
	var city = jQuery('#add_addresses_city').val();
	var state = jQuery('#add_addresses_state').val();
	var pincode = jQuery('#add_addresses_pincode').val();
	if (user_addresses_name == '') {
		jQuery('#add_addresses_name').attr("placeholder", "Enter Name");
		jQuery('#add_addresses_name').focus();
	} else if (main_address == '') {
		jQuery('#add_addresses_main_address').attr("placeholder", "Enter Flat / House / Office No.");
		jQuery('#add_addresses_main_address').focus();
	} else if (street == '') {
		jQuery('#add_addresses_street').attr("placeholder", "Enter Street or Society");
		jQuery('#add_addresses_street').focus();
	} else if (city == '') {
		jQuery('#add_addresses_city').attr("placeholder", "Enter City");
		jQuery('#add_addresses_city').focus();
	} else if (state == '') {
		jQuery('#add_addresses_state').attr("placeholder", "Enter State");
		jQuery('#add_addresses_state').focus();
	} else if (pincode == '') {
		jQuery('#add_addresses_pincode').attr("placeholder", "Enter Pincode");
		jQuery('#add_addresses_pincode').focus();
	} else if (pincode.length != 6) {
		jQuery('#add_addresses_pincode').val('');
		jQuery('#add_addresses_pincode').attr("placeholder", "Enter 6 Digit Pincode");
		jQuery('#add_addresses_pincode').focus();
	} else {
		jQuery.ajax({
			url: '/user/address/add/done',
			data: 'setaddType=' + setaddType + '&user_addresses_name=' + user_addresses_name + '&main_address=' + main_address + '&street=' + street + '&city=' + city + '&state=' + state + '&pincode=' + pincode,
			type: 'post',
			success: function (result) {
				if (result == 'submitted') {
					window.location.href = '/user/address';
				}
			}
		});
	}

}

function AddToWishlist(pid) {
	// alert(pid);
	jQuery.ajax({
		url: '/AddToWishlist',
		data: 'pid=' + pid,
		type: 'post',
		success: function (result) {
			if (result == 'login') {
				window.location.href = '/login';
			} else if (result == 1) {
				// jQuery('#wishlistCounter').html(result);
				showErrortoast('product already in wishlist', 'fas fa-exclamation-circle');
			} else {
				jQuery('#wishlistCounter').html(result);
				showErrortoast('product added to wishlist', 'fas fa-check-circle');
			}
		}
	});
}


function funSearch() {
	var search_str = jQuery('#search_str').val();
	if (search_str != '' && search_str.length > 3) {
		window.location.href = '/search/' + search_str;
	}
}

// function getSearchStrInput() {
// 	var getSearchStr=jQuery('#getSearchStr').val();
// 	if (getSearchStr!='') {
// 		window.location.href='/search/'+getSearchStr;		
// 	}else{
// 		jQuery('#getSearchStr').attr("placeholder", "I'm looking for?");
// 		jQuery('#getSearchStr').focus();
// 	}
// }


jQuery('#mobileSearch').submit(function (e) {
	e.preventDefault();
	var mobileSearchInput = jQuery('#mobileSearchInput').val();
	window.location.href = '/search/' + mobileSearchInput;
});

jQuery('#mainSearchForm').submit(function (e) {
	e.preventDefault();
	var mainSearchFormInput = jQuery('#mainSearchFormInput').val();
	window.location.href = '/search/' + mainSearchFormInput;
});

jQuery('#newsletterForm').submit(function (e) {
	e.preventDefault();
	var newletterEmail = jQuery('#newletterEmail').val();
	jQuery.ajax({
		url: '/subscribeNewsletter',
		data: 'newsletterEmail=' + newletterEmail,
		type: 'post',
		success: function (result) {
			if (result == 'subscibed') {
				showErrortoast('email already subscribed', 'fas fa-exclamation-circle');
			} else if (result == 'done') {
				showErrortoast('thanks for subscribing', 'fas fa-exclamation-circle');
				jQuery('#newsletterForm')[0].reset();
			} else {
				showErrortoast('please enter valid E-Mail', 'fas fa-exclamation-circle');
			}
		}
	});
});

function blog_like(uid, blog_id, user_name) {
	if (uid == 0 && user_name == 'null') {
		alert('Please Login to Like Blog');
		// custom_msg_popup('Login Error','Please Login to Like Blog','warning');
		// error_popup('Please Login to Like our Blog!');
	} else {
		jQuery.ajax({
			url: '/blogLike',
			type: 'post',
			data: 'uid=' + uid + '&blog_id=' + blog_id + '&user_name=' + user_name,
			success: function (result) {
				// alert(result);
				if (result != 'liked') {
					jQuery('#blog_like').html(result);
					jQuery('#blog_like'+blog_id).html(result);
				}
			}
		});
	}
}

jQuery('#frmCommentBlog').submit(function (e) {
	e.preventDefault();
	// alert('done');
	jQuery('#CommentBtn').html('Please wait...');
	// jQuery('#thank_you_msg').hide();
	// jQuery('.custom_error').hide();
	jQuery.ajax({
		url: '/blogComment',
		data: jQuery('#frmCommentBlog').serialize(),
		type: 'post',
		success: function (result) {
			// alert(result);  
			jQuery('#frmCommentBlog')[0].reset();
			jQuery('#CommentBtn').html('Post Comment');
			if (result == 'not login') {
				alert('Please Login to comment in blog');
			}
		}
	});

});

function removeAddMoneyCouponCode() {
	// jQuery('#addcoupon_result').show();
	jQuery('#coupon_code').val('');
	jQuery('#addMoneyCoupon').val('');
	jQuery('#submitCouponBtn').show();
	var money = jQuery('#add_money').val();
	jQuery('#addMoneyAmt').val(money);
	jQuery('#finalAddAmt').val(money);
	jQuery('#removeCouponBtn').hide();
	showErrortoast('coupon removed', 'fas fa-exclamation-circle');
	// jQuery('#addcoupon_result').html('Coupon Removed');
}

function applyAddMoneyCouponCode() {
	jQuery('#addcoupon_result').hide();
	var coupon_code = jQuery('#coupon_code').val();
	if (coupon_code != '') {
		jQuery('#addMoneyCoupon').val(coupon_code);
		//    jQuery('#submitCouponBtn').hide();
		//    jQuery('#removeCouponBtn').show();

		//    var amt = jQuery('#addMoneyAmt').val();
		// var cpn = jQuery('#addMoneyCoupon').val();
		// var famt = jQuery('#finalAddAmt').val();
		// if(amt!=0 && famt!=0){

		jQuery.ajax({
			url: '/set_coupon_add_money',
			data: jQuery('#frmAddMoney').serialize(),
			type: 'post',
			success: function (result) {
				// alert(result.status);
				// alert(result.msg);
				if (result.status == 'success') {
					jQuery('#addMoneyCoupon').val(coupon_code);
					jQuery('#submitCouponBtn').hide();
					jQuery('#removeCouponBtn').show();
					jQuery('#addcoupon_result').show();
					jQuery('#addcoupon_result').html(result.msg);

				} else {
					jQuery('#submitCouponBtn').show();
					jQuery('#removeCouponBtn').hide();
					jQuery('#addcoupon_result').show();
					jQuery('#addcoupon_result').html(result.msg);
				}

				// window.location.href='/AddMoney/'+result.addAmount;
			}
		});

		// }else{
		// 	jQuery('#add_money').attr("placeholder", "Enter Amount Here");
		// 	jQuery('#add_money').focus();	
		// }
	} else {
		jQuery('#coupon_code').attr("placeholder", "Enter Coupon Here");
		jQuery('#coupon_code').focus();
	}
}

function amt(value) {
	jQuery('#addMoneyAmt').val(value);
	jQuery('#finalAddAmt').val(value);
}

function add_money() {
	jQuery('#addcoupon_result').hide();
	jQuery('#addcoupon_result').html('');
	var amt = jQuery('#addMoneyAmt').val();
	var cpn = jQuery('#addMoneyCoupon').val();
	var famt = jQuery('#finalAddAmt').val();
	if (amt != 0 && famt != 0) {

		// alert('/AddMoney/'+famt);
		window.location.href = '/AddMoney/' + famt;
	} else {
		jQuery('#add_money').attr("placeholder", "Enter Amount Here");
		jQuery('#add_money').focus();
	}
}

function showErrortoast(msg, icon) {
	// jQuery('.custom_toast').remove();
	// var error_msg='<div class="alert custom_toast hide"><span class="msg">This is a warning alert This is a warning alert!</span><span class="fas fa-exclamation-circle"></span></div>';
	// jQuery('.main-content').append(error_msg);
	// $('.custom_toast').fadeIn("slow");
	// $('.custom_toast').addClass("showAlert");
	// setTimeout(function(){
	//   $('.custom_toast').fadeOut("slow");;
	// },5000);
	jQuery('.custom_toast').remove();
	var error_msg = '<div class="alert custom_toast hide"><span class="msg text-capitalize">' + msg + '</span><span class="' + icon + '"></span></div>';
	jQuery('.main-content').append(error_msg);
	$('.custom_toast').fadeIn("slow");
	$('.custom_toast').addClass("showAlert");
	setTimeout(function () {
		$('.custom_toast').fadeOut("slow");;
	}, 3000);
}

$("input[type=number]").on("focus", function () {
	$(this).on("keydown", function (event) {
		if (event.keyCode === 38 || event.keyCode === 40) {
			event.preventDefault();
		}
	});
});

function NotifyMe(pid) {
	jQuery.ajax({
		url: '/notifyme_submit',
		type: 'post',
		data: 'pid=' + pid,
		success: function (result) {
			showErrortoast('Thank You... Request submitted', 'fas fa-exclamation-circle');
		}
	});
}

function reset_get_city() {
	jQuery('#btn_pinCOde').html('Continue');
	jQuery('#pinCOde').val('');
	jQuery('#get_ciyt_sec_1').show();
	jQuery('#get_city_sec_2').hide();
	jQuery('#get_city_sec_3').hide();
	jQuery('#get_ciyt_sec_4').show();
	// jQuery('.mainBox').removeClass("noPad");
	// jQuery('.custom_icon').removeClass('uil uil-check-circle');
	// jQuery('.custom_icon').removeClass('far fa-times-circle mr-2');
}

function getPincode() {
	jQuery('#get_city_sec_2').hide();
	jQuery('.notMsg').html('');
	jQuery('#btn_pinCOde').html('Please wait');
	var pincode = jQuery('#pinCOde').val();
	if(pincode!=''){
		jQuery.ajax({
			url: '/getPincode',
			type: 'post',
			data: 'pincode='+pincode,
			success: function (result) {
				jQuery('#btn_pinCOde').html('Continue');
				if (result.msg=='invalid') {
					showErrortoast('Invalid Pincode', 'fas fa-exclamation-circle');
				}
				else if (result.msg=='success') {
					jQuery('#get_ciyt_sec_1').hide();
					jQuery('#get_ciyt_sec_4').hide();
					jQuery('#get_city_sec_2').show();
					jQuery('#currentCity').html('');
					jQuery('#currentCity').html(result.city);
					jQuery('#EnterManually').removeClass("active selected");
					jQuery('.notMsg').html('Your current store is updated <br> to '+result.city);
					jQuery('.'+result.city).addClass("active selected");
					// jQuery('.custom_icon').addClass('uil uil-check-circle');
					// jQuery('#get_city_msg').html('We deliver on this area');
					// jQuery('.get_city_res').addClass("py-3");
				}
				else {
					jQuery('#get_ciyt_sec_1').hide();
					jQuery('#get_ciyt_sec_4').hide();
					jQuery('#get_city_sec_3').show();
					// jQuery('.custom_icon').addClass('far fa-times-circle mr-2');
					jQuery('.notMsg').html('Sorry! currently we can\'t deliver <br> to '+result.city);
					// jQuery('#currentCity').html('');
				}
			}
		});
	}else{
		jQuery('#btn_pinCOde').html('Continue');
		jQuery('#pinCOde').focus();
	}
}

function updatePincode() {
	jQuery('#get_city_sec_2').hide();
	jQuery('.notMsg').html('');
	jQuery('#btn_update_pinCOde').html('Please wait');
	var pincode = jQuery('#pinCOde').val();
	if(pincode!=''){
		jQuery.ajax({
			url: '/updatePincode',
			type: 'post',
			data: 'pincode='+pincode,
			success: function (result) {
				jQuery('#btn_update_pinCOde').html('Update');
				if (result.msg=='invalid') {
					showErrortoast('Invalid Pincode', 'fas fa-exclamation-circle');
				}
				else if (result.msg=='success') {
					jQuery('#get_ciyt_sec_1').hide();
					jQuery('#get_ciyt_sec_4').hide();
					jQuery('#get_city_sec_2').show();
					jQuery('#currentCity').html('');
					jQuery('#currentCity').html(result.city);
					jQuery('#EnterManually').removeClass("active selected");
					jQuery('.notMsg').html('Your current store is updated <br> to '+result.city);
					jQuery('.'+result.city).addClass("active selected");
					// jQuery('.custom_icon').addClass('uil uil-check-circle');
					// jQuery('#get_city_msg').html('We deliver on this area');
					// jQuery('.get_city_res').addClass("py-3");
				}
				else {
					jQuery('#get_ciyt_sec_1').hide();
					jQuery('#get_ciyt_sec_4').hide();
					jQuery('#get_city_sec_3').show();
					// jQuery('.custom_icon').addClass('far fa-times-circle mr-2');
					jQuery('.notMsg').html('Sorry! currently we can\'t deliver <br> to '+result.city);
				}
			}
		});
	}else{
		jQuery('#btn_update_pinCOde').html('Update');
		jQuery('#pinCOde').focus();
	}
}

function setPincode(value) {
	if(value!=''){
		jQuery.ajax({
			url: '/updatePincode',
			type: 'post',
			data: 'pincode='+value,
			success: function (result) {
				showErrortoast('store updated to '+result.city, 'fas fa-exclamation-circle');
				jQuery('.'+result.city).addClass("active selected");
			}
		});
	}
}

// function hideGetCityModal() {
// 	$('#get_city').fadeOut('slow');
// 	$('body').removeClass('modal-open');
// 	$('.modal-backdrop').remove();
// }

jQuery('.loader-wrapper').show();
jQuery('.main-content').hide();
$(window).on("load",function(){
	// setTimeout(function(){
  $(".loader-wrapper").fadeOut("slow");
  $(".main-content").fadeIn('slow');
  jQuery('.main-content').show();
	// },1500);
});