<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-8 flex">
    <!-- Left Side -->
    <div class="container mx-auto">
        <?php
            $serviceCode = $_GET['service_code'];
            $serviceName = urldecode($_GET['service_name']);
            $serviceIcon = urldecode($_GET['service_icon']);
        ?>
        <p class="text-base">Pembayaran</p>
        <p class="text-2xl font-bold">
            <img src="<?= $serviceIcon ?>" alt="<?= $serviceName ?>" class="inline-block mr-2">
            <?= $serviceName ?>
        </p><br>

        <div class="relative mt-2">
            <input id="nominal" type="text" placeholder="Masukkan nominal pembayaran" autocomplete="payment" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-red-600 sm:text-sm" oninput="updatePaymentButtonState()">    
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-wallet text-gray-400"></i>
            </span>
        </div>
        <button id="bayarButton" class="bg-gray-400 text-white px-4 py-2 mt-4 md:w-80vw w-full hover:bg-red-600" onclick="bayar()">Bayar</button>
    </div>

    <!-- Modal and JavaScript -->
    <script>
        async function bayar() {
            const nominalInput = document.getElementById('nominal');
            const nominal = nominalInput.value;

            if (!nominal.trim()) {
                return;
            }

            const bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = true;

            const success = await doPayment(nominal);

            if (success) {
                toggleModal('modal', nominal, true);
                bayarButton.disabled = false;
                bayarButton.innerHTML = `Bayar Rp${nominal}`;
            } else {
                toggleModal('modal', nominal, false);
            }

            // Enable the button and update the text
            bayarButton.disabled = false;
            bayarButton.innerHTML = `Bayar Rp${nominal}`;
        }

        async function doPayment(nominal) {
            try {
                const response = await fetch('https://take-home-test-api.nutech-integrasi.app/transaction', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzZXJAbnV0ZWNoLWludGVncmFzaS5jb20iLCJtZW1iZXJDb2RlIjoiTExLUjZKTDEiLCJpYXQiOjE2OTk2MzI0MTAsImV4cCI6MTY5OTY3NTYxMH0.wiSQ4ajGUT1321Y-Pj1GRo5zkeHgYb-GnJpx14tAi3g', // Replace with your actual JWT token
                    },
                    body: JSON.stringify({
                        service_code: '<?= $serviceCode ?>', // Replace with your actual service code
                        top_up_amount: parseInt(nominal), // Convert to integer
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    return true;
                } else {
                    console.error('Payment failed:', result.message);
                    return false;
                }
            } catch (error) {
                console.error('An error occurred during payment:', error);
                return false;
            }
        }

        function updatePaymentButtonState() {
            const nominalInput = document.getElementById('nominal');
            const bayarButton = document.getElementById('bayarButton');

            bayarButton.disabled = !nominalInput.value.trim();
        }

        function toggleModal(id, nominal, success) {
            const modal = document.getElementById(id);
            const modalText = modal.querySelector(".modal-text");

            if (success) {
                modalText.innerHTML = `
                <p class="text-2xl mb-4">Pembayaran Sebesar</p>
                <p class="text-3xl font-bold mb-4">Rp${nominal}</p>
                <p class="text-green-600 text-lg font-semibold" style="margin-top: -1rem">Berhasil</p>
                `;
            } else {
                modalText.innerHTML = `
                <p class="text-2xl mb-4">Pembayaran Sebesar</p>
                <p class="text-3xl font-bold mb-4">Rp${nominal}</p>
                <p class="text-red-600 text-lg font-semibold" style="margin-top: -1rem">Gagal</p>
                `;
            }

            const buttonContainer = document.createElement("div");
            buttonContainer.className = "flex flex-col items-center";

            const batalButton = createButton("Tutup", "text-gray-700", () => toggleModal("modal"));

            buttonContainer.appendChild(batalButton);

            modalText.appendChild(buttonContainer);
            modal.classList.toggle("hidden");
        }

        function createButton(text, styleClass, clickHandler) {
            const button = document.createElement("button");
            button.className = `px-4 py-2 ${styleClass} mb-2 font-bold hover:bg-opacity-80 transition duration-300`;
            button.textContent = text;
            button.addEventListener("click", clickHandler);
            return button;
        }
    </script>


    <!-- Modal -->
    <div class="fixed inset-0 w-full h-full z-50 flex items-center justify-center hidden" id="modal">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6 text-center">
                <div class="modal-icons flex justify-center">
                    <img src="<?php echo base_url('img/Logo.png'); ?>" alt="" style="width: 50px; height: 50px;">
                </div>
                <div class="modal-text mt-4"></div>
            </div>
        </div>
        <div class="fixed inset-0 bg-black opacity-70 z-40" onclick="toggleModal('modal')"></div>
    </div>
</div>

<?= $this->endSection() ?>
