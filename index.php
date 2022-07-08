<?php
require('config/config.php');
require('config/db.php');

session_name('userDaxPlatform');
session_start();
?>

<?php
//create query
$query = "SELECT * FROM product";

//Get result
$result = mysqli_query($conn, $query);

//fetch data
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <!-- <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="line/icon-font/lineicons.css" />
    <title>home</title>
  </head>
  <body>
    <nav>
      <label class="logo">DAX-platform</label>
      <ul>
        <li><a clas="action" href="index.php">Home</a></li>
        <li><a href="#">DEALS</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="#">Seller</a></li>
        <li>
          <a href="#"><i class="lni lni-cart"></i>Cart</a>
        </li>
        <li><a href="#">Help</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
        <li>
          <p class="user-name"><?php echo $_SESSION['firstname']; ?></p>
        </li>
        <li><a href="logout.php">Log Out</a></li>
        <?php else: ?>
        <li><a href="signin.php">Sign In</a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <div class="main-content">
      <section class="sec-1">
        <form action="" class="search-form flex">
          <div class="input">
            <input type="search" name="search" id="search" />
            <i class="lni lni-search"></i>
          </div>
          <button type="submit" class="btn">search</button>
        </form>
      </section>
      <section class="sec-2 flex">
        <div class="category-container">
          <h3>Category</h3>
          <ul>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-apple"></i>
              </div>
              <a href="">SuperMarket</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-display"></i>
              </div>
              <a href="">Electronics</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-home"></i>
              </div>
              <a href="">Pharmacy</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-game"></i>
              </div>
              <a href="">Gaming</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Fashion</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Sporting goods</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Health Care</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Baby Products</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Phones and Tablets</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-shopify"></i>
              </div>
              <a href="">Beauty products</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-tshirt"></i>
              </div>
              <a href="">Confectionary</a>
            </li>
            <li class="flex">
              <div class="icon">
                <i class="lni lni-more-alt btn"></i>
              </div>
              <a href="">Other Categories</a>
            </li>
          </ul>
        </div>
        <div class="banner-container">
          <div class="img"></div>
          <!-- <img src="dist/images/banner.jpg" alt="" srcset="" /> -->
          <div class="banner-desc">15% off on all foods</div>
        </div>
      </section>
      <section class="sec-3">
        <div class="flex">
          <div class="">
            <img src="dist/images/FS.png" alt="" srcset="" />
            <h5>Flash sale</h5>
          </div>
          <div class="">
            <img src="dist/images/FS4.jpg" alt="" srcset="" />
            <h5>Supermarket Deals</h5>
          </div>
          <div class="">
            <img src="dist/images/FS3.jpg" alt="" srcset="" />
            <h5>Home Deals</h5>
          </div>
          <div class="">
            <img src="dist/images/a7.jpg" alt="" srcset="" />
            <h5>Computing Deals</h5>
          </div>
          <div class="">
            <img src="dist/images/FS5.png" alt="" srcset="" />
            <h5>Play and Win</h5>
          </div>
          <div class="">
            <img src="dist/images/img-2.jpg" alt="" srcset="" />
            <h5>Phone Deals</h5>
          </div>
          <div class="">
            <img src="dist/images/FS3.jpg" alt="" srcset="" />
            <h5>Official Store</h5>
          </div>
          <div class="">
            <img src="dist/images/FS6.jpg" alt="" srcset="" />
            <h5>Free Delivery</h5>
          </div>
        </div>
        <div class="nav-btns">
          <a class="prev-btn btn"><</a>
          <a class="next-btn btn">></a>
        </div>
      </section>
      <section class="sec-4 grd grd-cl-5">
        <?php foreach ($products as $product): ?>
        <div class="card">
          <div class="card-img">
            <img
              src="dist/images/<?php echo $product['picture'] ?>"
              alt=""
              srcset=""
            />
          </div>
          <div class="card-text">
            <h5><?php echo $product['productName'] ?></h5>
            <p>Ugs.<?php echo $product['unitPrice'] ?></p>
            <p>Seller</p>
            <a href="">More</a>
          </div>
        </div>
        <?php endforeach ?>
      </section>
    </div>
    <footer class="flex">
      <div class="wrapper">&copy;</div>
      <div class="footer-nav flex">
        <p>2022 Dax-platform.</p>
        <p>All rights Reserved.</p>
        <p>Developed by Aljem</p>
      </div>
    </footer>
  </body>
</html>
