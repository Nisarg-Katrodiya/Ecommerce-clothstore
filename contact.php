<?php 
include('includes/header.php');
include('includes/dbcon.php');

if(isset($_POST['submit']))
{
	$name = $_POST[ 'name' ];
	$email = $_POST[ 'email' ];
	$mobile = $_POST[ 'mobile' ];
	$comment = $_POST[ 'message' ];
	$added_on = date( 'Y-m-d h:i:s' );
	$sql = "insert into contact_us(name,email,mobile,comment,added_on) values('$name','$email','$mobile','$comment','$added_on')";
	$run = $con->query( $sql );
?>
	<script>
	window.alert("Thank you");
	</script>	
<?php	
}	
?>
<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
           
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn remove__btn1">
                        <a href=""><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
						<?php
						$total="";
								if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
												$sql1="select * from product where product.status=1 and id='$key' ";
												$run1=$con->query($sql1);
												$data1=$run1->fetch_assoc();	
												$pname=$data1['pname'];
												$price=$data1['price'];
												$image=$data1['image'];
												$qty=$val['qty'];
												$total=$total+($price*$qty);
											?>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
								
                                <a href="#">
                                    <img src="admin/images/product/<?php echo $image;?>" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product.php"><?php echo $pname; ?></a></h2>
                                <span class="quantity">QTY: <?php echo $qty; ?></span>
                                <span class="shp__price"><?php echo $price*$qty." ₹"; ?></span>
                            </div>
                            <div class="remove__btn">
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key;?>','remove')" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        	<?php 
							} } ?>
						
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price"><?php echo $total." ₹"; ?></li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.php">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
		<!-- Start Brandcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0.40) url(admin/images/slider/291762.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Contact Us</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                        <div class="map-contacts--2">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                        <h2 class="title__line--6">CONTACT US</h2>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-location-pin icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">our address</h2>
                                <p>502, River Palace, Surat. </p>
                            </div>
                        </div>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-envelope icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">openning hour</h2>
                                <p>24/7 </p>
                            </div>
                        </div>

                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-phone icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">Phone Number</h2>
                                <p>+91 97377 *****</p>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="contact-form-wrap mt--60">
                        <div class="col-xs-12">
                            <div class="contact-title">
                                <h2 class="title__line--6">SEND A MAIL</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form id="contact-form" action="#" method="POST">
                                <div class="single-contact-form">
                                    <div class="contact-box name">
										
                                        <input type="text" id="name" name="name" placeholder="Your Name*" required>

                                        <input type="email" id="email" name="email" placeholder="Email*" required>

										<input type="tel" id="mobile" name="mobile" placeholder="Mobile*" required>

                                    </div>
                                </div>
                                
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="message" id="message" placeholder="Your Message" required></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" name="submit" onclick="" class="fv-btn">Send MESSAGE</button>
                                </div>
                            </form>
                            <div class="form-output">
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
		<!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmGmeot5jcjdaJTvfCmQPfzeoG_pABeWo "></script>
    <script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 12,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(21.1702, 72.8311), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                 styles: 
        [ {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#141516"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
        ]
            };

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('googleMap');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(21.1702, 72.8311),
                map: map,
                title: 'Ramble!',
                icon: 'images/icons/map-2.png',
                animation:google.maps.Animation.BOUNCE

            });
        }
    </script>
<?php include('includes/footer.php')?>        