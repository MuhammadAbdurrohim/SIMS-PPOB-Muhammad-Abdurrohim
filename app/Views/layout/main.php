<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMS-PPBOB</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
    <header>
    <!-- Navbar Container -->
    <div class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo and Icon (Kiri) -->
            <div class="flex items-center space-x-2">
                <img src="<?php echo base_url('img/Logo.png'); ?>" alt="" class="h-8 w-8">
                <a href="dashboard" class="text-3xl font-bold">SIM PPOB</a>
            </div>

            <!-- Tautan (Kanan) -->
            <div class="space-x-4">
                <a href="isitopup">Top Up</a>
                <a href="transaksi">Transaction</a>
                <a href="akun">Akun</a>
            </div>
        </div>
    </div>
    <hr>

    <!-- Profile Container -->
    <div class="p-4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Profile Info (Kiri) -->
            <div class="flex items-center space-x-4">
                <?php if ($profileData && isset($profileData['data']) && is_array($profileData['data'])) : ?>
                    <div>
                        <?php if (isset($profileData['data']['profile_image'])) : ?>
                            <img src="<?php echo $profileData['data']['profile_image']; ?>" alt="Profile" class="w-12 h-12 rounded-full">
                        <?php else : ?>
                            <p>Profile image not available.</p>
                        <?php endif; ?>
                        
                        <p class="text-xl base">Selamat datang,</p>
                        
                        <?php if (isset($profileData['data']['first_name']) && isset($profileData['data']['last_name'])) : ?>
                            <p class="text-4xl font-bold">
                                <?php echo $profileData['data']['first_name'] . ' ' . $profileData['data']['last_name']; ?>
                            </p>
                        <?php else : ?>
                            <p>Nama tidak tersedia.</p>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <p>Profile data not available.</p>
                <?php endif; ?>
            </div>

            <!-- Saldo dan Toggle (Kanan) -->
            <div class="p-7 bg-red-500 shadow-lg rounded-xl flex items-center space-x-4 w-2/5 ml-auto">
                <?php if ($balanceData && isset($balanceData['data'])) : ?>
                    <div class="text-white">
                        <p class="text-xl">Saldo Anda</p>
                        <div class="flex items-center space-x-2">
                            <?php if (isset($balanceData['data']['balance'])) : ?>
                                <p id="balance" class="text-3xl font-bold hidden">
                                    <?php echo 'RP ' . number_format($balanceData['data']['balance'], 0, ',', '.'); ?>
                                </p>
                            <?php else : ?>
                                <p id="balance" class="text-3xl font-bold hidden">
                                    Saldo tidak tersedia
                                </p>
                            <?php endif; ?>

                            <p id="hiddenBalance" class="text-3xl font-bold">RP &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226;</p>
                        </div>
                        <a href="#" id="toggleBalance" class="text-white text-sm flex items-center space-x-2">
                            Lihat Saldo <i class="fas fa-eye ml-2"></i>
                        </a>
                    </div>
                <?php else : ?>
                    <p>Balance data not available.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
    </header>
    <br>
    

    <main>
        <!-- Isi Konten Tampilan -->
        <?= $this->renderSection('content') ?>
    </main>

    <footer>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // JavaScript to toggle visibility of balance
        document.getElementById('toggleBalance').addEventListener('click', function() {
            var balanceElement = document.getElementById('balance');
            var hiddenBalanceElement = document.getElementById('hiddenBalance');
            balanceElement.classList.toggle('hidden');
            hiddenBalanceElement.classList.toggle('hidden');
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Slider -->
    <style>
        /* Add this CSS to your page or an external stylesheet */
        /* Hide the horizontal scrollbar */
        #bannerSlider::-webkit-scrollbar {
            display: none;
        }

        /* Optional: If you want to hide the scrollbar in Firefox */
        #bannerSlider {
            scrollbar-width: none;
        }
    </style>

    <!-- Add this code to the bottom of your script section -->
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true,           // Enable the loop for continuous sliding
                margin: 10,           // Adjust margin as needed
                nav: false,
                autoplay: true,       // Enable autoplay
                autoplayTimeout: 3000, // Set autoplay timeout in milliseconds (3 seconds in this example)
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>

    </footer>
</body>
</html>