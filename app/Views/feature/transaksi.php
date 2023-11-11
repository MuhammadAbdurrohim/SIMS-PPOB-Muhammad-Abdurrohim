<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-8 flex flex-col">
    <h1 class="text-2xl font-semibold mb-4">Semua Transaksi</h1>
    
    <!-- Loop through the history data -->
    <?php if ($historyData && isset($historyData['data']) && isset($historyData['data']['records']) && is_array($historyData['data']['records'])) : ?>
        <?php foreach ($historyData['data']['records'] as $historyItem) : ?>
            <?php if (is_array($historyItem) && isset($historyItem['transaction_type']) && isset($historyItem['total_amount']) && isset($historyItem['created_on'])) :
                $textColor = $historyItem['transaction_type'] === 'TOPUP' ? 'text-green-600' : 'text-red-600';
                $totalAmount = number_format($historyItem['total_amount'], 0, ',', '.');
                $createdOn = date('j F Y H:i', strtotime($historyItem['created_on'])) . ' WIB';
            ?>
                <div class="flex flex-col m-2 p-3 item-container relative border border-gray-300 rounded-md">
                    <p class="text-lg font-semibold <?= $textColor ?> pr-2"><?= $historyItem['transaction_type'] === 'TOPUP' ? '+' : '-' ?>Rp. <?= $totalAmount ?></p>
                    <p class="text-xs"><?= $createdOn ?></p>
                    <div class="absolute top-0 right-0 p-6">
                        <p class="text-xs text-gray-500"><?= $historyItem['description'] ?></p>
                    </div>
                </div>
            <?php else : ?>
                <pre><?= print_r($historyItem, true) ?></pre>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No history data available.</p>
    <?php endif; ?>

    <button class="text-red-500 px-4 py-2 mt-4 w-full hover:text-red-600" onclick="toggleData()">Show More</button>

    <!-- Data ini hanya tampil ketika tombol "Show More" diklik -->
    <div class="w-full mt-4 hidden" id="moreData">
        <h2 class="text-lg font-semibold mb-2">Semua Transaksi</h2>
        <!-- Filter data sesuai bulan saat ini dan bold tulisan bulan saat ini -->
        <table class="mt-4">
            <tr>
                <td class="pr-4">Maret</td>
                <td class="pr-4">Mei</td>
                <td class="pr-4">Juni</td>
                <td class="pr-4">Juli</td>
                <td class="pr-4"><b>Agustus</b></td>
                <td>September</td>
            </tr>
        </table>

        <!-- Tampilkan pesan jika tidak ada data -->
        <p class="text-gray-600 mt-4">Maaf, tidak ada histori transaksi saat ini.</p>
    </div>
</div>

<script>
    function toggleData() {
        const moreData = document.getElementById('moreData');
        moreData.classList.toggle('hidden');
    }
</script>


<?= $this->endSection() ?>
