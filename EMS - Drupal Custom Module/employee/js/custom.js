const checkboxes = document.querySelectorAll(".employee-checkbox");
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    const hikePercentageContainer = this.parentNode.querySelector(
      ".hike-percentage-container"
    );
    hikePercentageContainer.style.display = this.checked ? "block" : "none";
  });
});
