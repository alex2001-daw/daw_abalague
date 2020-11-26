<!DOCTYPE html>
<html>
  <head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
    <?php
        session_start();
        require "llibreria.php";
        if (isset($_SESSION["newses"]) or isset($_SESSION["newpass"])){
            $user = $_SESSION["newses"];
            $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');
            
            mostraCistella($conn);

            

            if (isset($_POST["delcar"])){
                $idp=$_POST["celfcar"];
                delFromCar($conn, $idp);
            }
        }else {
            header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a7/session.php");
        }
    ?>
    </section>
  </body>




  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_TYooMQauvdEDq54NiTphI7jx");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>