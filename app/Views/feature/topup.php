<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-8 flex">
    <!-- Left Side -->
    <div class="w-2/3 pl-2">
        <p class="text-base">Silahkan masukkan</p>
        <p class="text-2xl font-bold">Nominal Top Up</p>
        <div class="relative mt-2">
            <input id="nominal" type="text" placeholder="Masukkan nominal Top Up" autocomplete="topup" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-red-600 sm:text-sm" oninput="updateTopUpButtonState()">    
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-wallet text-gray-400"></i>
            </span>
        </div>
        <button id="topUpButton" class="bg-gray-400 text-white px-4 py-2 mt-4 w-full hover:bg-red-600" onclick="isiNominal()" disabled>Top Up</button>
    </div>

    <!-- Right Side -->
      <div class="w-1/3 pl-5">
        <div class="w-1/1 flex items-center">
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '10000')">Rp. 10.000</button>
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '100000')">Rp. 100.000</button>
        </div>
        <div class="w-1/1 flex items-center">
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '20000')">Rp. 20.000</button>
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '250000')">Rp. 250.000</button>
        </div>
        <div class="w-1/1 flex items-center">
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '50000')">Rp. 50.000</button>
            <button class="border border-gray-300 text-gray-700 p-2 m-1 hover:bg-gray-300 hover-text-gray-800 my-2 w-full" onclick="toggleModal('modal', '500000')">Rp. 500.000</button>
        </div>
    </div>

    <!-- Modal and JavaScript -->
    <script>
        function toggleModal(id, nominal, success) {
            const modal = document.getElementById(id);
            const modalText = modal.querySelector(".modal-text");

            if (success) {
                modalText.innerHTML = `
                <p class="text-2xl mb-4">Top Up Sebesar</p>
                <p class="text-3xl font-bold mb-4">Rp${nominal}</p>
                <p class="text-green-600 text-lg font-semibold" style="margin-top: -1rem">Berhasil</p>
                `;
            } else {
                modalText.innerHTML = `
                <p class="text-2xl mb-4">Top Up Sebesar</p>
                <p class="text-3xl font-bold mb-4">Rp${nominal}</p>
                <p class="text-red-600 text-lg font-semibold" style="margin-top: -1rem">Gagal</p>
                `;
            }

            isiNominal();

            const buttonContainer = document.createElement("div");
            buttonContainer.className = "flex flex-col items-center";

            const batalButton = createButton("Tutup", "text-gray-700", () => toggleModal("modal"));

            buttonContainer.appendChild(batalButton);

            modalText.appendChild(buttonContainer);
            modal.classList.toggle("hidden");
        }


        function handleNominalInput() {
            const nominalInput = document.getElementById('nominal');
            const topUpButton = document.getElementById('topUpButton');
            
            // Enable the button if a nominal value is present
            topUpButton.disabled = !nominalInput.value.trim();
        }

        async function getJwtToken() {
            try {
                const tokenResponse = await fetch('/getJwtToken'); // Replace with the actual endpoint to get the token
                const tokenResult = await tokenResponse.json();

                if (tokenResponse.ok) {
                    return tokenResult.token;
                } else {
                    console.error('Failed to get JWT token:', tokenResult.message);
                    return null;
                }
            } catch (error) {
                console.error('An error occurred while getting JWT token:', error);
                return null;
            }
        }

        async function bayar(nominal) {
            try {
                const jwtToken = await getJwtToken();

                if (!jwtToken) {
                    console.error('JWT token is not available.');
                    return false;
                }

                const response = await fetch('https://take-home-test-api.nutech-integrasi.app/topup', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${jwtToken}`,
                    },
                    body: JSON.stringify({
                        top_up_amount: parseInt(nominal), // Convert to integer
                    }),
                });

                const result = await response.json();

                // Check if the top-up was successful
                if (response.ok) {
                    return true;
                } else {
                    // Handle the error (e.g., display error message)
                    console.error('Top-up failed:', result.message);
                    return false;
                }
            } catch (error) {
                console.error('An error occurred during top-up:', error);
                return false;
            }
        }

        // Function to update the "Top Up" button state based on input
        function updateTopUpButtonState() {
            const nominalInput = document.getElementById('nominal');
            const topUpButton = document.getElementById('topUpButton');

            if (nominalInput.value.trim() === '') {
                topUpButton.disabled = true;
                topUpButton.classList.remove('bg-red-500');
                topUpButton.classList.add('bg-gray-400');
            } else {
                topUpButton.disabled = false;
                topUpButton.classList.remove('bg-gray-400');
                topUpButton.classList.add('bg-red-500');
            }
        }

        async function isiNominal() {
            const nominalInput = document.getElementById('nominal');
            const nominal = nominalInput.value;

            if (!nominal.trim()) {
                return;
            }

            const topUpButton = document.getElementById('topUpButton');
            topUpButton.disabled = true;

            const success = await bayar(nominal);

            if (success) {
                toggleModal('modal', nominal, true);
            } else {
                toggleModal('modal', nominal, false);
            }

            // Enable the button and update the text
            topUpButton.disabled = false;
            topUpButton.innerHTML = `Top Up Rp${nominal}`;
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
