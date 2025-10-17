function showAlert(message, type = "success") {
  const alertContainer = document.getElementById("alert-container");
  if (!alertContainer) return;

  alertContainer.innerHTML = "";

  // Konfigurasi warna dan ikon statis agar Tailwind tidak hilangkan class-nya
  const config = {
    success: {
      classes: "border border-green-400 bg-green-50 text-green-700",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
             </svg>`
    },
    error: {
      classes: "border border-red-400 bg-red-50 text-red-700",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
             </svg>`
    },
    warning: {
      classes: "border border-yellow-400 bg-yellow-50 text-yellow-700",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
             </svg>`
    },
    info: {
      classes: "border border-blue-400 bg-blue-50 text-blue-700",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
             </svg>`
    }
  };

  const { classes, icon } = config[type] || config.success;

  const alertBox = document.createElement("div");
alertBox.className = `
  flex items-center justify-between gap-4 px-5 py-4 
  rounded-md border shadow-sm transition-all duration-300 ${classes}
`;

alertBox.innerHTML = `
  <div class="flex items-center gap-3">
    ${icon}
    <div class="flex flex-col">
      <span class="font-semibold text-sm sm:text-base capitalize">${type} Message</span>
      <span class="text-sm sm:text-[15px] text-current">${message}</span>
    </div>
  </div>
  <button 
    class="text-gray-400 hover:text-gray-600 text-xl font-semibold leading-none 
           focus:outline-none transition"
    onclick="this.parentElement.remove()"
    aria-label="Close alert"
  >×</button>
`;


  alertContainer.appendChild(alertBox);
  alertContainer.classList.remove("hidden");

  // Animasi masuk (fade + slide dari kanan)
  alertBox.style.opacity = 0;
  alertBox.style.transform = "translateX(20px)";
  setTimeout(() => {
    alertBox.style.opacity = 1;
    alertBox.style.transform = "translateX(0)";
  }, 10);
}
