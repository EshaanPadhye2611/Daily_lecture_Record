<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</main>
<?php
if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    
    ?>
    <script>
   swal({
     title: "<?php echo $_SESSION['status'];?>",
     icon: "<?php echo $_SESSION['status_code'];?>",
      button: "OKAY!",
});
    </script>
    <?php
    unset($_SESSION['status']);
}
?>

</body>

</html>