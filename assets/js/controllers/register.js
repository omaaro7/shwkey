let form = document.querySelector(".form");
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  let pass = document.querySelector(".pass");
  let repass = document.querySelector(".repass");

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
  let data = {
    name: inputs[0].value,
    date_birth: inputs[1].value,
    type: inputs[2].value,
    parent_name: inputs[3].value,
    parent_data_birth: inputs[4].value,
    parent_type: inputs[5].value,
    parent_phonenumber: inputs[8].value,
    user_name: inputs[6].value,
    password: inputs[7].value,
    stat: 0,
    coins: 0,
    level: 0,
    finshed_games:"[]"
  };

  try {
    const res = await fetch(`../../handlers/signUp.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
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
      })
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
