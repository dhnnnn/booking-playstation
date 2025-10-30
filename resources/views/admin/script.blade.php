<script>
    const selectedTags = document.getElementById("selected-tags");
    const dropdown = document.getElementById("dropdown");
    const items = dropdown.querySelectorAll(".dropdown-item");
    const fasilitasInput = document.getElementById("fasilitas-input");

    selectedTags.addEventListener("click", () => {
      dropdown.classList.toggle("active");
    });

    function updateFasilitasInput() {
      const selectedValues = [];
      const tags = selectedTags.querySelectorAll(".tag");
      tags.forEach(tag => {
        selectedValues.push(tag.getAttribute("data-value"));
      });
      fasilitasInput.value = selectedValues.join(",");
    }

    items.forEach(item => {
      item.addEventListener("click", () => {
        const value = item.getAttribute("data-value");
        const text = item.textContent;

        if (selectedTags.textContent.trim() === "Pilih fasilitas...") {
          selectedTags.textContent = "";
        }

        if (!selectedTags.querySelector(`[data-value="${value}"]`)) {
          const tag = document.createElement("span");
          tag.classList.add("tag");
          tag.setAttribute("data-value", value);
          tag.innerHTML = `${text} <button class="remove-tag" type="button">&times;</button>`;
          selectedTags.appendChild(tag);

          item.classList.add("selected");

          tag.querySelector(".remove-tag").addEventListener("click", () => {
            tag.remove();
            item.classList.remove("selected");
            updateFasilitasInput();
            if (selectedTags.childElementCount === 0) {
              selectedTags.textContent = "Pilih fasilitas...";
            }
          });
        }

        updateFasilitasInput();
        dropdown.classList.remove("active");
      });
    });

    document.addEventListener("click", (e) => {
      if (!e.target.closest(".multi-select-container")) {
        dropdown.classList.remove("active");
      }
    });

    // 🟢 Tambahan: Auto-select fasilitas yang sudah dipilih dari backend (saat edit)
    document.addEventListener("DOMContentLoaded", () => {
      // Ambil item yang punya class "selected" (dari Blade)
      const preselectedItems = dropdown.querySelectorAll(".dropdown-item.selected");

      preselectedItems.forEach(item => {
        const value = item.getAttribute("data-value");
        const text = item.textContent;

        // Hapus teks default jika masih ada
        if (selectedTags.textContent.trim() === "Pilih fasilitas...") {
          selectedTags.textContent = "";
        }

        // Buat tag-nya di bagian atas
        const tag = document.createElement("span");
        tag.classList.add("tag");
        tag.setAttribute("data-value", value);
        tag.innerHTML = `${text} <button class="remove-tag" type="button">&times;</button>`;
        selectedTags.appendChild(tag);

        // Pastikan item di dropdown diberi tanda selected
        item.classList.add("selected");

        // Tambahkan event untuk tombol hapus
        tag.querySelector(".remove-tag").addEventListener("click", () => {
          tag.remove();
          item.classList.remove("selected");
          updateFasilitasInput();
          if (selectedTags.childElementCount === 0) {
            selectedTags.textContent = "Pilih fasilitas...";
          }
        });
      });

      // Update input hidden dengan nilai awal
      updateFasilitasInput();
    });
</script>
