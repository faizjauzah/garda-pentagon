const uploadArea = document.getElementById("upload-area");
  const fileInput = document.getElementById("foto");
  const uploadText = document.getElementById("upload-text");
  const previewImage = document.getElementById("preview-image");

  // Warna area saat drag file
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

  // Saat file dipilih lewat klik
  fileInput.addEventListener("change", updatePreview);

  function updatePreview() {
    const uploadIcon = document.getElementById("upload-icon");
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];

      // 🔒 Validasi tipe file
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

      // ✅ Jika valid, tampilkan nama file & preview
      uploadText.textContent = "File terpilih: " + file.name;
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewImage.classList.remove("hidden");
        uploadIcon.classList.add("hidden");
      };
      reader.readAsDataURL(file);

    } else {
      // Reset jika tidak ada file
      uploadText.textContent = "Klik atau seret file ke area ini untuk mengunggah gambar";
      previewImage.src = "";
      previewImage.classList.add("hidden");
      document.getElementById("upload-icon").classList.remove("hidden");
    }
  }
