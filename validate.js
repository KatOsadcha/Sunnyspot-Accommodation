const form = document.getElementById("myForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const pricePerNight = document.getElementById("price_per_night");
  const pricePerWeek = document.getElementById("price_per_week");

  if (pricePerNight.value * 5 < pricePerWeek.value) {
    alert(
      "The value of pricePerWeek should be at most 5 times the value of pricePerNight"
    );

    pricePerNight.value = 0;
    pricePerWeek.value = 0;

    return false;
  } else {
    document.forms["myForm"].submit();
  }
});
