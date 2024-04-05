<?= $this->extend('layout') ?>

<?= $this->section('body') ?>

<div class="text-center p-5">
    <img src="<?php echo base_url('assets/image/logo.png') ?>" alt="logo" style="max-width: 200px">
    <h2 class="text-center">Jendela Dunia</h2>
</div>

<div class="p-2" style="color: var(--color-3)">
    <div class="col-12 p-2">
        <h5><i class="fa-solid fa-book-open"></i> Profile:</h5>
        <hr>
        <p>
            Jendela dunia is an online library that provides many book from many categories and genres. This website aims for better experience to borrow books. Jendela Dunia's icon consists of letter J and D. These two letters are transformed to make shape like fast-forward icon. I hope people who using this website have improvement in their interest to read book. J and D letters have a blue sky color and sun color. It implys a bright sky. People who have improvement in their interest to read book will have a bright future.
        </p>
    </div>
    <div class="col-12 p-2">
        <h5><i class="fa-solid fa-scale-balanced"></i> Rule:</h5>
        <hr>
        <ul>
            <li>Please borrow books responsibly. Any damage to book will result fining.</li>
            <li>Don't lend the book to others. Take responsibility for your book</li>
            <li>You can only borrow <b>three</b> books at the same time.</li>
            <li>You cannot borrow any book when you have fine more than <b>Rp 5,000</b>.</li>
            <li>You can keep your borrowed books for <b>seven</b> days. You must return it first to extend the duration.</li>
            <li>Fining will apply if you return the books more than seven days. The calculation is <b>passed day times Rp 1,000</b>.</li>
        </ul>
    </div>
    <div class="col-12 p-2">
        <h5><i class="fa-solid fa-computer"></i> Developer:</h5>
        <hr>
        <div class="text-center">
            <img src="<?php echo base_url('assets/image/dev_pic.jpg') ?>" alt="dev" style="max-width: 200px">
            <h2 class="text-center">Oscar Deladas</h2>
        </div>
        <p></p>
    </div>
</div>


<?= $this->endSection() ?>