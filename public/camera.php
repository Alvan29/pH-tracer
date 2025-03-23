<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deteksi Warna pH</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center bg-gray-100 min-h-screen py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Deteksi Warna pH</h1>
    <div class="relative inline-block">
        <video id="video" autoplay class="w-full max-w-md rounded-lg shadow-lg"></video>
        <div id="target-box" class="absolute w-12 h-12 border-2 border-red-500 left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>
    <canvas id="canvas" width="640" height="480" class="hidden"></canvas>
    <button onclick="detectColor()" class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">Deteksi Warna</button>
    <div id="color-box" class="mt-4 text-lg font-bold text-gray-700">Nilai pH: <span id="ph-value" class="text-blue-600">-</span></div>
    <button onclick="getPhInfo()" class="mt-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Get Info</button>
    
    <h2 class="text-2xl font-bold text-gray-800 mt-6">Tabel Informasi pH</h2>
    <table class="table-auto border-collapse border border-gray-400 w-3/4 text-center bg-white shadow-lg mt-4">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Penyebab</th>
                <th class="border border-gray-300 px-4 py-2">Penyakit</th>
                <th class="border border-gray-300 px-4 py-2">Penyaranan</th>
            </tr>
        </thead>
        <tbody id="infoTabel" class="hidden"></tbody>
    </table>

    <script>
        const video = document.getElementById("video");
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d", { willReadFrequently: true });
        const phValue = document.getElementById("ph-value");
        const infoTabel = document.getElementById("infoTabel");

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => { video.srcObject = stream; })
            .catch(error => console.error("Error accessing camera:", error));

        function detectColor() {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const x = canvas.width / 2;
            const y = canvas.height / 2;
            const pixel = ctx.getImageData(x, y, 1, 1).data;
            const detectedPh = Math.floor((pixel[0] + pixel[1] + pixel[2]) / 100); // Estimasi pH sederhana
            phValue.innerText = detectedPh;
            phValue.dataset.ph = detectedPh;
        }

        function getPhInfo() {
            let currentPh = phValue.dataset.ph;
            if (!currentPh) {
                console.error("Nilai pH tidak tersedia!");
                return;
            }
            
            fetch(`get_ph_info.php?ph=${currentPh}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Response dari server:", data);
                    infoTabel.innerHTML = "";
                    if (data && data.Nilai_ph) {
                        infoTabel.innerHTML = `
                            <tr class="hover:bg-gray-200">
                                <td class="border border-gray-300 px-4 py-2">${data.Status}</td>
                                <td class="border border-gray-300 px-4 py-2">${data.Penyebab}</td>
                                <td class="border border-gray-300 px-4 py-2">${data.Penyakit}</td>
                                <td class="border border-gray-300 px-4 py-2">${data.Penyaranan}</td>
                            </tr>`;
                        infoTabel.classList.remove("hidden");
                    } else {
                        infoTabel.innerHTML = `<tr><td colspan='4' class='border border-gray-300 px-4 py-2'>Informasi tidak tersedia</td></tr>`;
                        infoTabel.classList.remove("hidden");
                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
