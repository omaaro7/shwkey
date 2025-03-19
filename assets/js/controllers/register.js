let form = document.querySelector(".form");
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  let pass = document.querySelector(".pass");
  let repass = document.querySelector(".repass");
  let photo = document.querySelector("#upload");

  if (!photo.files.length) {
    Swal.fire({
      title: "Error",
      text: "Please upload a photo",
    });
    return;
  }

  if (pass.value.length < 8) {
    Swal.fire({
      title: "Error",
      text: "Password must be at least 8 characters",
    });
    return;
  }

  if (pass.value !== repass.value) {
    Swal.fire({
      title: "Error",
      text: "Passwords do not match",
    });
    return;
  }

  let inputs = document.querySelectorAll(".val");
  let formData = new FormData();
  formData.append("name", inputs[0].value);
  formData.append("date_birth", inputs[1].value);
  formData.append("type", inputs[2].value);
  formData.append("parent_name", inputs[3].value);
  formData.append("parent_data_birth", inputs[4].value);
  formData.append("parent_type", inputs[5].value);
  formData.append("parent_phonenumber", inputs[8].value);
  formData.append("user_name", inputs[6].value);
  formData.append("password", inputs[7].value);
  formData.append("stat", 0);
  formData.append("coins", 0);
  formData.append("level", 0);
  formData.append("finshed_games", "[]");
  formData.append("photo", photo.files[0]);

  try {
    const res = await fetch(`../../handlers/signUp.php`, {
      method: "POST",
      body: formData,
    });

    if (!res.ok) {
      const errorResponse = await res.json();
      Swal.fire({
        title: "Error",
        text: errorResponse.message || "An error occurred.",
      });
      return;
    }

    let responseData = await res.json();

    if (responseData.token) {
      let expiryDate = new Date();
      expiryDate.setFullYear(expiryDate.getFullYear() + 10);

      document.cookie = `token=${responseData.token}; path=/; expires=${expiryDate.toUTCString()}; SameSite=Strict`;
      console.log("Cookie set:", document.cookie);

      Swal.fire({
        title: "Success",
        text: "User registered successfully!",
      }).then(() => {
        window.location.href = "../main/home.php";
      });
    } else {
      Swal.fire({
        title: "Error",
        text: "Token not received.",
      });
    }
  } catch (error) {
    console.error("Error during fetch:", error);
    Swal.fire({
      title: "Error",
      text: "An error occurred while signing up.",
    });
  }
});
