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
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
}

function closeCamera() {
  const modal = document.getElementById("modalCamera");
  modal.classList.add("hidden");
  Webcam.reset();
}

function takeSnapshot() {
  Webcam.snap(function(data_uri) {
    const preview = document.getElementById("preview-image");
    const uploadIcon = document.getElementById("upload-icon");
    const uploadText = document.getElementById("upload-text");

    preview.src = data_uri;
    preview.classList.remove("hidden");
    uploadIcon.classList.add("hidden");
    uploadText.textContent = "Foto berhasil diambil dari kamera.";

    document.getElementById("base64_foto").value = data_uri;

    closeCamera();
  });
}

