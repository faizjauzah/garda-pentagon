const uploadArea = document.getElementById("upload-area");
const fileInput = document.getElementById("foto");
const uploadText = document.getElementById("upload-text");
const previewImage = document.getElementById("preview-image");

uploadArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  uploadArea.classList.add("bg-gray-100");
});

uploadArea.addEventListener("dragleave", () => {
  uploadArea.classList.remove("bg-gray-100");
});

uploadArea.addEventListener("drop", (e) => {
  e.preventDefault();
  uploadArea.classList.remove("bg-gray-100");
  fileInput.files = e.dataTransfer.files;
  updatePreview();
});

fileInput.addEventListener("change", updatePreview);

function updatePreview() {
  const uploadIcon = document.getElementById("upload-icon");
  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];

    const validTypes = ["image/jpeg", "image/png", "image/jpg"];
    if (!validTypes.includes(file.type)) {
      alert("File yang diunggah harus berupa gambar (JPG atau PNG).");
      fileInput.value = "";
      uploadText.textContent = "Klik atau seret file ke area ini untuk mengunggah gambar";
      previewImage.src = "";
      previewImage.classList.add("hidden");
      uploadIcon.classList.remove("hidden");
      return;
    }

    uploadText.textContent = "File terpilih: " + file.name;
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      previewImage.classList.remove("hidden");
      uploadIcon.classList.add("hidden");
      showAlert("Berhasil mengunggah gambar.", "success");
    };
    reader.readAsDataURL(file);
  } else {
    uploadText.textContent = "Klik atau seret file ke area ini untuk mengunggah gambar";
    previewImage.src = "";
    previewImage.classList.add("hidden");
    document.getElementById("upload-icon").classList.remove("hidden");
  }
}

function openCamera() {
  const modal = document.getElementById("modalCamera");
  modal.classList.remove("hidden");

  Webcam.set({
    image_format: "jpeg",
    jpeg_quality: 90,
  });
  Webcam.attach("#my_camera");
}

function closeCamera() {
  const modal = document.getElementById("modalCamera");
  modal.classList.add("hidden");
  Webcam.reset();
}

function takeSnapshot() {
  Webcam.snap(function (data_uri) {
    const preview = document.getElementById("preview-image");
    const uploadIcon = document.getElementById("upload-icon");
    const uploadText = document.getElementById("upload-text");

    preview.src = data_uri;
    preview.classList.remove("hidden");
    uploadIcon.classList.add("hidden");
    uploadText.textContent = "Foto berhasil diambil dari kamera.";

    document.getElementById("base64_foto").value = data_uri;
    showAlert("Berhasil mengunggah gambar.", "success");

    closeCamera();
  });
}

// Validasi form sebelum submit
document.getElementById("formtamu").addEventListener("submit", function (e) {
  const nama = document.getElementById("nama").value.trim();
  const telepon = document.getElementById("telepon").value.trim();
  const instansi = document.getElementById("instansi").value.trim();
  const alamat = document.getElementById("alamat").value.trim();
  const tujuan = document.getElementById("tujuan").value;
  const keperluan = document.getElementById("keperluan").value.trim();
  const tanggalJanji = document.getElementById("tanggal_janji").value.trim();
  const metodePertemuan = document.querySelector("input[name='metode_pertemuan']:checked");
  const fileInput = document.getElementById("foto");
  const base64Foto = document.getElementById("base64_foto").value;

  // Cek input kosong satu per satu
  if (!nama || !telepon || !instansi || !alamat || !tujuan || !keperluan || !tanggalJanji || !metodePertemuan) {
    e.preventDefault();
    showAlert("Harap isi semua bidang form sebelum mengirim!", "error");
    return;
  }

  // Cek apakah foto sudah diupload atau diambil dari kamera
  if (fileInput.files.length === 0 && !base64Foto) {
    e.preventDefault();
    showAlert("Harap unggah foto diri atau ambil foto dari kamera!", "error");
    return;
  }
});

function showAlert(message, type = "success") {
  const alertContainer = document.getElementById("alert-container");
  if (!alertContainer) return;

  const bgClass = type === "success" ? "bg-green-100 text-green-800 border-green-300" : "bg-red-100 text-red-800 border-red-300";

  const alertBox = document.createElement("div");
  alertBox.className = `flex items-center gap-3 px-5 py-3 rounded-md border ${bgClass} shadow-md transition-all duration-300`;
  alertBox.innerHTML = `
    <span class="font-medium">${message}</span>
  `;

  alertContainer.innerHTML = ""; // hapus alert lama
  alertContainer.appendChild(alertBox);
  alertContainer.classList.remove("hidden");

  // Hilangkan otomatis setelah 3 detik
  setTimeout(() => {
    alertBox.classList.add("opacity-0", "translate-y-[-10px]");
    setTimeout(() => {
      alertBox.remove();
      alertContainer.classList.add("hidden");
    }, 300);
  }, 3000);
}
