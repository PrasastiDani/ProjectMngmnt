<div class="mb-4 mx-2">
    <?php
    use Carbon\Carbon;

    $currentTime = Carbon::now();
    echo $currentTime->format('d F Y');
    ?>
    <hr class="border-black my-2">
</div>
