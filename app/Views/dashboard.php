<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

    <!-- Daftar Layanan -->
    <style>
        .item-container {
            text-align: center;
            max-width: 120px; /* Sesuaikan dengan ukuran yang diinginkan */
            margin: 0 auto;
        }

        .item-container img {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 80px; /* Sesuaikan dengan ukuran yang diinginkan */
            height: 80px; /* Sesuaikan dengan ukuran yang diinginkan */
            object-fit: cover;
        }
    </style>

    <section class="p-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-center -m-2">
                <?php if ($servicesData && isset($servicesData['data']) && is_array($servicesData['data'])) : ?>
                    <?php foreach ($servicesData['data'] as $service) : ?>
                        <?php if (is_array($service) && isset($service['service_icon']) && isset($service['service_name'])) : ?>
                            <div class="flex items-center flex-col m-2 item-container">
                                <a href="bayarin?service_code=<?= $service['service_code'] ?>&service_name=<?= urlencode($service['service_name']) ?>&service_icon=<?= urlencode($service['service_icon']) ?>">
                                    <img src="<?= $service['service_icon'] ?>" alt="<?= $service['service_name'] ?>">
                                </a>
                                <h3 class="text-lg mt-2 mx-auto"><?= $service['service_name'] ?></h3>
                            </div>
                        <?php else : ?>
                            <pre><?= print_r($service, true) ?></pre>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No services data available.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Slider Banner -->
    <section class="p-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Temukan Promo Menarik</h2>
            <div class="relative overflow-hidden">
                <div id="bannerSlider" class="flex overflow-x-auto scrollbar-hidden">
                    <?php if ($bannerData && isset($bannerData['data']) && is_array($bannerData['data'])) : ?>
                        <?php foreach ($bannerData['data'] as $banner) : ?>
                            <?php if (is_array($banner) && isset($banner['banner_image']) && isset($banner['banner_name'])) : ?>
                                <div class="w-1/2 md:w-1/4 flex-shrink-0 p-2">
                                    <div class="p-4 bg-white shadow-lg rounded-lg text-center">
                                        <img src="<?= $banner['banner_image'] ?>" alt="<?= $banner['banner_name'] ?>" class="w-full rounded-lg">
                                    </div>
                                </div>
                            <?php else : ?>
                                <pre><?= print_r($banner, true) ?></pre>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No banner data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>