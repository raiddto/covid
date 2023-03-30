<?php
require_once('./private/header.php');
?>

<div class="content-wrapper">
    <!-- content goes here.. -->
</div>

<?php
require_once('./private/footer.php');
?>

<script>
    $(function() {
        $("#dashboard").click(function() {
            $(".content-wrapper").load("./pages/dashboard.html");
        });
        $("#crudform").click(function() {
            $(".content-wrapper").load("./pages/crud.html");
        });
    });
</script>