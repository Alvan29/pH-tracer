<?php
include "backend/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/stye.css">
    <script src="../finisher-header.es5.min.js"></script>
    <title>Document</title>
</head>

<body class="bg-[#371f9f]">
    <!-- Navbar -->
    <nav class="my-10 sticky top-5">
        <div class="container backdrop-blur-sm bg-white/30 mx-auto flex justify-center">
            <ul class="flex space-x-7">
                <li><a href="#Hero" class="text-white hover:underline md:text">Home</a></li>
                <li><a href="#Camera" class="text-white hover:underline">Camera</a></li>
                <li><a href="#Information" class="text-white hover:underline">Information</a></li>
                <li><a href="#Gallery" class="text-white hover:underline">Gallery</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Hero Page -->
    <div class="header finisher-header container min-h-screen" id="Hero">
        <div class="grid">
            <h1 class="text-[72px] md:text-[50px] font-semibold lg:mt-20 mt-10 text-white text-center font-DmSans">Putri Indonesia</h1>
            <p class="text-[22px] md:text-lg mt-5 text-white text-center font-DmSans">"Menjaga kesehatan dengan memahami pH tubuh. Dapatkan informasi lengkap dan solusi terbaik untukmu."</p>
            <button class="bg-[#B52BE7] lg:text-[22px] text-white justify-self-center rounded-md mt-20 py-3 px-4 tracking-widest font-DmSans ">Get Started</button>
        </div>
    </div>
    
    <!-- Camera -->
    <div class="container min-h-screen" id="Camera">
        <div class="flex justify-between lg:px-64 pt-20 px-4">
            <p class="lg:text-4xl text-2xl text-white font-bold font-DmSans">Cam Scanner</p>
            <button onclick="enableCamera(); toggleCamera();" class="border-2 border-green-500 rounded-full px-3 lg:mr-14 scale-95 text-lg" id="enCamera">
                <p class="text-white font-DmSans">Enable Camera</p>
            </button>
        </div>
        <div class="lg:max-w-96 max-w-64 mx-auto pt-5 hidden" id="canvas-container">
            <video autoplay class="lg:max-w-96 max-w-64 mx auto video" id="video"></video>
            <canvas class="lg:max-w-96 max-w-64 mx auto" id="canvas"></canvas>
        </div>
        <div class="lg:max-w-96 max-w-64 mx-auto pt-10" id="frame">
            <img src="../src/img/frame.png" alt="">
        </div>
        <p class="text-center text-white text-[22px] font-DmSans mt-3">Your pH : <span id="ph-value">-</span></p>
        <div class="mt-7 mx-auto w-fit">
            <button onclick="detectColor()" class="bg-[#e7de2b] text-white text-[22px] rounded-full py-1 px-16">Scan</button>
        </div>

        <div class="rotate-180"><div class="mx-auto w-28 h-28 bg-cover animate-bounce" style="background-image: url(../src/img/arrow.svg)"></div></div>
    </div>

    <!-- Information -->
    <div class="container lg:pt-40 pt-20 mx-auto px-6 md:px-12 lg:px-20 min-h-screen" id="Information">
        <div class="mt-7 mb-6 mx-auto w-fit">
            <button onclick="getPhInfo()" class="bg-[#2be76a] text-white text-[22px] rounded-full py-1 px-16">Check</button>
        </div>
        <div class="border border-slate-600 bg-slate-500 text-center text-white font-DmSans text-2xl">Detail Information</div>
        <div class="grid mb-8 border border-gray-200 rounded-b-lg shadow-xs dark:border-gray-700 md:mb-12 md:grid-cols-2 bg-white dark:bg-gray-800">
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-ss-lg md:border-e dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Status</h3>
                    <p class="my-4" id="status">-</p>
                </blockquote>    
            </figure>
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 md:rounded-se-lg dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Penyebab</h3>
                    <p class="my-4 " id="penyebab">-</p>
                </blockquote>   
            </figure>
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 md:rounded-es-lg md:border-b-0 md:border-e dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Penyakit</h3>
                    <p class="my-4" id="penyakit">-</p>
                </blockquote>  
            </figure>
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-gray-200 rounded-b-lg md:rounded-se-lg dark:bg-gray-800 dark:border-gray-700">
                <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Penyaranan</h3>
                    <p class="my-4" id="penyaranan">-</p>
                </blockquote>   
            </figure>
        </div>
    </div>

    <!-- Gallery -->
    <div class="container min-h-screen" id="Gallery">
        <div class="text-white text-4xl font-bold font-DmSans lg:ml-20 ml-5 pb-5 pt-24">Gallery</div>
        <a href="../src/img/image2.jpg" class="flex flex-col lg:mx-20 mx-5 mb-5 items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="../src/img/image2.jpg" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            </div>
        </a>
        <a href="../src/img/image2.jpg" class="flex flex-col lg:mx-20 mx-5 mb-5 items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="../src/img/image2.jpg" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            </div>
        </a>
        <a href="../src/img/image2.jpg" class="flex flex-col lg:mx-20 mx-5 mb-5 items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="../src/img/image2.jpg" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            </div>
        </a>
    </div>
    <script>
        new FinisherHeader({
            "count": 12,
            "size": {
                "min": 2,
                "max": 77,
                "pulse": 0
            },
            "speed": {
                "x": {
                "min": 0,
                "max": 0.8
                },
                "y": {
                "min": 0,
                "max": 0.2
                }
            },
            "colors": {
                "background": "#15182e",
                "particles": [
                "#ff926b",
                "#87ddfe",
                "#acaaff",
                "#1bffc2",
                "#f9a5fe"
                ]
            },
            "blending": "screen",
            "opacity": {
                "center": 1,
                "edge": 1
            },
            "skew": 0,
            "shapes": [
                "c",
                "s",
                "t"
            ]
            });
    </script>

    
</body>
</html>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });

    const video = document.getElementById("video");
    const ctx = canvas.getContext("2d", { willReadFrequently: true });
    const phValue = document.getElementById("ph-value");
    const status = document.getElementById("status");
    const penyebab = document.getElementById("penyebab");
    const penyakit = document.getElementById("penyakit");
    const penyaranan = document.getElementById("penyaranan");
    const enCamera = document.getElementById("enCamera");

    function detectColor() {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        const x = canvas.width / 2;
        const y = canvas.height / 2;
        const pixel = ctx.getImageData(x, y, 1, 1).data;
        const detectedPh = Math.floor((pixel[0] + pixel[1] + pixel[2]) / 100); // Estimasi pH sederhana
        phValue.innerText = detectedPh;
        phValue.dataset.ph = detectedPh;
    }

    let stream = null; // Simpan stream global

    async function requestCameraPermission() {
    try {
        // Minta izin kamera sebelum digunakan
        const permission = await navigator.permissions.query({ name: "camera" });

        if (permission.state === "denied") {
            alert("Izin kamera ditolak. Harap aktifkan izin kamera di pengaturan browser.");
            return false;
        }
    } catch (error) {
        console.warn("Tidak dapat memeriksa izin kamera:", error);
    }
    return true;
}

    async function toggleCamera() {
        const hasPermission = await requestCameraPermission();
        if (!hasPermission) return;
        if (stream) {
            // Jika kamera aktif, matikan
            stream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
            stream = null;

            console.log("Kamera dimatikan");
            enCamera.innerText = "Enable Camera";
            enCamera.classList.add("border-green-500");
            enCamera.classList.remove("border-red-500");
            enCamera.style.color = "white";
        } else {
            // Jika kamera mati, nyalakan
            enCamera.innerText = "Disable Camera";
            enCamera.classList.remove("border-green-500");
            enCamera.classList.add("border-red-500");

            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: "environment" } // "user" untuk depan, "environment" untuk belakang
                });

                video.srcObject = stream;
                console.log("Kamera dinyalakan");
            } catch (error) {
                console.error("Error accessing camera:", error);
            }
        }
    }


    function enableCamera() {
        const container = document.getElementById("canvas-container");
        const frame = document.getElementById("frame");
        const video = document.getElementById("video");
        // console.log("Click");

        if (frame.classList.contains("hidden")){
            frame.classList.toggle("hidden");
        }else{
            frame.classList.add("hidden");
        }
        container.classList.toggle("hidden");

    }

    function getPhInfo() {
        let currentPh = phValue.dataset.ph;
        if (!currentPh) {
            console.error("Nilai pH tidak tersedia!");
            return;
        }
        
        fetch(`backend/get_ph_info.php?ph=${currentPh}`)
            .then(response => response.json())
            .then(data => {
                console.log("Response dari server:", data);
                if (data && data.Nilai_ph) {
                    status.innerText = data.Status;
                    penyebab.innerText = data.Penyebab;
                    penyakit.innerText = data.Penyakit;
                    penyaranan.innerText = data.Penyaranan;
                } else {
                    
                }
            })
            .catch(error => console.error("Error fetching data:", error));
    }
</script>
<?php $conn->close(); ?>
